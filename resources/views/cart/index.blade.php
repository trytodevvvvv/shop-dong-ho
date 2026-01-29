@extends('layouts.main')

@section('title', 'Giỏ Hàng - WatchKing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-2">
        <span>🛒</span> Giỏ Hàng Của Bạn
    </h1>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    @foreach($cart as $id => $item)
                        <div class="flex items-center gap-4 p-6 border-b last:border-b-0 hover:bg-gray-50 transition">
                            <!-- Product Image -->
                            <a href="{{ route('products.show', $item['slug']) }}" class="flex-shrink-0">
                                <div class="w-28 h-28 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-16 h-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </a>

                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('products.show', $item['slug']) }}" class="text-lg font-bold text-gray-900 hover:text-red-600 transition block mb-1">
                                    {{ $item['name'] }}
                                </a>
                                <p class="text-2xl font-bold text-red-600">{{ number_format($item['price'], 0, ',', '.') }}đ</p>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="flex items-center gap-3">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" onclick="this.nextElementSibling.stepDown(); this.form.submit();" 
                                            class="w-10 h-10 cellphones-red text-white rounded-lg hover:bg-red-700 transition font-bold">-</button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                           class="w-16 px-3 py-2 border-2 border-gray-300 rounded-lg text-center font-bold focus:border-red-500 focus:outline-none"
                                           onchange="this.form.submit()">
                                    <button type="button" onclick="this.previousElementSibling.stepUp(); this.form.submit();" 
                                            class="w-10 h-10 cellphones-red text-white rounded-lg hover:bg-red-700 transition font-bold">+</button>
                                </form>
                            </div>

                            <!-- Subtotal -->
                            <div class="text-right min-w-[120px]">
                                <p class="text-sm text-gray-600 mb-1">Thành tiền</p>
                                <p class="text-xl font-bold text-gray-900">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</p>
                            </div>

                            <!-- Remove Button -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Clear Cart -->
                <div class="mt-4 flex justify-between items-center">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Xóa toàn bộ giỏ hàng
                        </button>
                    </form>
                    <a href="{{ route('products.index') }}" class="text-red-600 hover:text-red-800 font-semibold flex items-center gap-2">
                        ← Tiếp tục mua hàng
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b">💰 Tổng Đơn Hàng</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Tạm tính ({{ count($cart) }} sản phẩm):</span>
                            <span class="font-semibold">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Phí vận chuyển:</span>
                            <span class="font-semibold text-green-600">Miễn phí</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Tổng cộng:</span>
                            <span class="text-3xl font-bold text-red-600">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full cellphones-red text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-red-700 transition transform hover:scale-105 mb-3">
                        THANH TOÁN NGAY
                    </a>

                    <!-- Promotions -->
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mt-4">
                        <p class="text-sm font-semibold text-red-600 mb-2">🎁 Ưu đãi thêm:</p>
                        <ul class="text-xs text-gray-700 space-y-1">
                            <li>✓ Trả góp 0% lãi suất</li>
                            <li>✓ Bảo hành chính hãng 12 tháng</li>
                            <li>✓ Đổi trả trong 7 ngày</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
            <div class="bg-gradient-to-br from-red-50 to-pink-50 w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-16 h-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Giỏ hàng trống</h2>
            <p class="text-gray-600 mb-8 text-lg">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
            <a href="{{ route('products.index') }}" class="inline-block cellphones-red text-white px-12 py-4 rounded-xl font-bold text-lg hover:bg-red-700 transition transform hover:scale-105">
                🛍️ KHÁM PHÁ SẢN PHẨM
            </a>
        </div>
    @endif
</div>
@endsection

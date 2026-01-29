@extends('layouts.main')

@section('title', 'Thanh Toán - WatchKing')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-2">
        <span>💳</span> Thanh Toán Đơn Hàng
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <span>📍</span> Thông Tin Giao Hàng
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên *</label>
                            <input type="text" value="{{ auth()->user()->name }}" readonly
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl bg-gray-50 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                                <input type="email" value="{{ auth()->user()->email }}" readonly
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl bg-gray-50 font-medium">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại *</label>
                                <input type="tel" name="phone" required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none"
                                       placeholder="0123456789">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ giao hàng *</label>
                            <textarea name="address" rows="3" required
                                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none"
                                      placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ghi chú đơn hàng</label>
                            <textarea name="note" rows="2"
                                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none"
                                      placeholder="Ghi chú về đơn hàng (tùy chọn)"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <span>💰</span> Phương Thức Thanh Toán
                    </h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-start p-5 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-red-500 hover:bg-red-50 transition has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                            <input type="radio" name="payment_method" value="cod" checked class="mt-1 mr-4 text-red-600 w-5 h-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg mb-1">💵 Thanh toán khi nhận hàng (COD)</p>
                                <p class="text-sm text-gray-600">Thanh toán bằng tiền mặt khi nhận hàng</p>
                            </div>
                        </label>

                        <label class="flex items-start p-5 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-red-500 hover:bg-red-50 transition has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                            <input type="radio" name="payment_method" value="bank" class="mt-1 mr-4 text-red-600 w-5 h-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg mb-1">🏦 Chuyển khoản ngân hàng</p>
                                <p class="text-sm text-gray-600">Chuyển khoản trước, giao hàng sau khi xác nhận</p>
                            </div>
                        </label>

                        <label class="flex items-start p-5 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-red-500 hover:bg-red-50 transition has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                            <input type="radio" name="payment_method" value="installment" class="mt-1 mr-4 text-red-600 w-5 h-5">
                            <div class="flex-1">
                                <p class="font-bold text-lg mb-1">💳 Trả góp 0% lãi suất</p>
                                <p class="text-sm text-gray-600">Trả góp qua thẻ tín dụng, duyệt nhanh</p>
                            </div>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 cellphones-red text-white py-5 rounded-2xl font-bold text-xl hover:bg-red-700 transition transform hover:scale-105">
                    🛒 ĐẶT HÀNG NGAY
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b">📦 Đơn Hàng ({{ count($cart) }} SP)</h2>
                
                <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                    @foreach($cart as $item)
                        <div class="flex justify-between text-sm pb-3 border-b">
                            <div class="flex-1 pr-2">
                                <p class="font-medium text-gray-900 line-clamp-2">{{ $item['name'] }}</p>
                                <p class="text-gray-500 text-xs mt-1">SL: {{ $item['quantity'] }}</p>
                            </div>
                            <span class="font-bold text-red-600 whitespace-nowrap">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-3 pt-4 border-t">
                    <div class="flex justify-between text-gray-700">
                        <span>Tạm tính:</span>
                        <span class="font-semibold">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Phí vận chuyển:</span>
                        <span class="font-semibold text-green-600">Miễn phí</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Giảm giá:</span>
                        <span class="font-semibold text-red-600">0đ</span>
                    </div>
                    <div class="border-t pt-4 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Tổng cộng:</span>
                        <span class="text-3xl font-bold text-red-600">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>
                </div>

                <!-- Benefits -->
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-xl p-4 mt-6">
                    <p class="text-sm font-bold text-red-600 mb-3">🎁 Quyền lợi của bạn:</p>
                    <ul class="text-xs text-gray-700 space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Bảo hành chính hãng 12 tháng</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Đổi trả miễn phí trong 7 ngày</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Miễn phí vận chuyển toàn quốc</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Hỗ trợ trả góp 0% lãi suất</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

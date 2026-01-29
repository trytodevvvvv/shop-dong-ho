@extends('layouts.main')

@section('title', 'WatchKing - Đồng Hồ Cao Cấp Chính Hãng')

@section('content')
<!-- Hero Slider -->
<div class="cellphones-gradient py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="inline-block cellphones-red text-white px-4 py-1 rounded-full text-sm font-semibold mb-4">
                        🔥 HOT DEAL
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Đồng Hồ Cao Cấp
                    </h1>
                    <p class="text-xl text-gray-600 mb-6">
                        Giảm đến <span class="text-red-600 font-bold text-3xl">50%</span> + Trả góp 0%
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('products.index') }}" class="cellphones-red text-white px-8 py-4 rounded-lg font-semibold hover:bg-red-700 transition text-lg">
                            Mua Ngay
                        </a>
                        <a href="{{ route('products.index') }}" class="border-2 border-red-600 text-red-600 px-8 py-4 rounded-lg font-semibold hover:bg-red-50 transition text-lg">
                            Xem Thêm
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-200 to-pink-200 rounded-full blur-3xl opacity-50"></div>
                        <svg class="w-80 h-80 text-red-600 relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hot Sale Section -->
<div class="hot-sale-gradient py-8 mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <h2 class="text-3xl font-bold text-white">⚡ HOT SALE CUỐI TUẦN</h2>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-white font-semibold">BẮT ĐẦU SAU:</span>
                <div class="flex gap-2">
                    <div class="countdown-box text-white px-4 py-2 rounded-lg text-center">
                        <div class="text-2xl font-bold" id="hours">00</div>
                        <div class="text-xs">Giờ</div>
                    </div>
                    <div class="countdown-box text-white px-4 py-2 rounded-lg text-center">
                        <div class="text-2xl font-bold" id="minutes">07</div>
                        <div class="text-xs">Phút</div>
                    </div>
                    <div class="countdown-box text-white px-4 py-2 rounded-lg text-center">
                        <div class="text-2xl font-bold" id="seconds">55</div>
                        <div class="text-xs">Giây</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale relative group">
                <!-- Discount Badge -->
                @if($product->sale_price)
                    <div class="absolute top-2 left-2 discount-badge text-white px-3 py-1 rounded-full text-sm font-bold z-10">
                        Giảm {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                    </div>
                @endif

                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="aspect-square bg-gradient-to-br from-red-50 to-pink-50 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-100/50 to-pink-100/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg class="w-40 h-40 text-red-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-red-600 font-semibold mb-1">{{ $product->brand }}</p>
                        <h3 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3rem]">{{ $product->name }}</h3>
                        
                        <div class="mb-3">
                            @if($product->sale_price)
                                <div class="flex items-center gap-2">
                                    <p class="text-xl font-bold text-red-600">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                                </div>
                                <p class="text-sm text-gray-500 line-through">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                            @else
                                <p class="text-xl font-bold text-gray-900">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                            @endif
                        </div>

                        <!-- Features -->
                        <div class="space-y-1 mb-3">
                            <div class="flex items-center gap-2 text-xs text-gray-600">
                                <span class="bg-gray-100 px-2 py-1 rounded">{{ $product->movement_type }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs">
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded font-semibold">Trả góp 0%</span>
                            </div>
                        </div>

                        @if($product->stock > 0)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-green-600 font-medium">✓ Còn hàng</span>
                                <span class="text-gray-500">{{ $product->stock }} sản phẩm</span>
                            </div>
                        @else
                            <span class="text-red-600 font-medium text-sm">✗ Hết hàng</span>
                        @endif
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('products.index') }}" class="inline-block cellphones-red text-white px-12 py-4 rounded-lg font-semibold hover:bg-red-700 transition text-lg">
            Xem Tất Cả {{ \App\Models\Product::count() }} Sản Phẩm →
        </a>
    </div>
</div>

<!-- Features Section -->
<div class="bg-gradient-to-r from-gray-50 to-gray-100 py-12 mt-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="cellphones-red w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Chính Hãng 100%</h3>
                <p class="text-gray-600 text-sm">Cam kết sản phẩm chính hãng</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="cellphones-red w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Trả Góp 0%</h3>
                <p class="text-gray-600 text-sm">Hỗ trợ trả góp lãi suất 0%</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="cellphones-red w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Bảo Hành Chính Hãng</h3>
                <p class="text-gray-600 text-sm">Bảo hành toàn quốc</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md">
                <div class="cellphones-red w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Miễn Phí Vận Chuyển</h3>
                <p class="text-gray-600 text-sm">Giao hàng toàn quốc</p>
            </div>
        </div>
    </div>
</div>

<!-- Countdown Timer Script -->
<script>
    function updateCountdown() {
        const now = new Date();
        const endOfWeek = new Date();
        endOfWeek.setDate(endOfWeek.getDate() + (7 - endOfWeek.getDay()));
        endOfWeek.setHours(23, 59, 59, 999);
        
        const diff = endOfWeek - now;
        
        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
</script>
@endsection

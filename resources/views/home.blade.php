@extends('layouts.main')

@section('title', 'WatchKing - Đồng Hồ Cao Cấp Chính Hãng')

@section('content')
<!-- Hero Slider -->
<div class="cellphones-gradient py-16 relative overflow-hidden">
    <!-- Floating Background Particles -->
    <div class="floating-particle text-white/40" style="left: 10%; top: 80%; animation-duration: 15s; font-size: 24px;">✨</div>
    <div class="floating-particle text-yellow-300/30" style="left: 25%; top: 90%; animation-duration: 20s; animation-delay: 2s; font-size: 16px;">✦</div>
    <div class="floating-particle text-white/20" style="left: 85%; top: 70%; animation-duration: 12s; font-size: 32px;">⌚</div>
    <div class="floating-particle text-red-200/40" style="left: 70%; top: 95%; animation-duration: 18s; animation-delay: 5s; font-size: 20px;">✦</div>
    <div class="floating-particle text-white/30" style="left: 45%; top: 85%; animation-duration: 14s; font-size: 18px;">✨</div>
    <div class="floating-particle text-yellow-100/20" style="left: 5%; top: 40%; animation-duration: 25s; animation-delay: 1s; font-size: 40px;">◆</div>
    <div class="floating-particle text-white/20" style="left: 95%; top: 60%; animation-duration: 16s; font-size: 12px;">✦</div>
    <div class="floating-particle text-pink-200/30" style="left: 55%; top: 90%; animation-duration: 22s; animation-delay: 3s; font-size: 28px;">✨</div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 relative overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative z-10">
                <div data-aos="fade-right" data-aos-delay="300">
                    <div class="inline-block cellphones-red text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 animate-pulse">
                        🔥 HOT DEAL
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                        Đồng Hồ Cao Cấp<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-pink-500">Chính Hãng 100%</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-6 font-medium">
                        Giảm đến <span class="text-red-600 font-bold text-3xl">50%</span> + Trả góp 0%
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products.index') }}" class="cellphones-red text-white px-8 py-4 rounded-xl font-bold hover:bg-red-700 transition-all text-lg shadow-lg hover:shadow-red-500/50 hover:-translate-y-1 flex items-center gap-2">
                            <span>Mua Ngay</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="{{ route('products.index') }}" class="border-2 border-red-600 text-red-600 px-8 py-4 rounded-xl font-bold hover:bg-red-50 transition-all text-lg hover:-translate-y-1">
                            Xem Thêm
                        </a>
                    </div>
                </div>
                <div class="flex justify-center" data-aos="fade-left" data-aos-delay="500">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-300 to-purple-300 rounded-full blur-3xl opacity-60 group-hover:opacity-80 transition-opacity duration-500 animate-pulse"></div>
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80"
                             alt="Đồng hồ cao cấp"
                             class="w-80 h-80 object-cover rounded-2xl shadow-2xl relative z-10 transform group-hover:scale-105 group-hover:rotate-2 transition-all duration-500">
                        
                        <!-- Floating badges -->
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-red-700 font-bold w-16 h-16 rounded-full flex items-center justify-center border-4 border-white shadow-lg z-20 animate-bounce" style="animation-duration: 3s;">
                            -50%
                        </div>
                        <div class="absolute -bottom-6 -left-6 bg-white px-4 py-2 rounded-xl font-bold text-sm shadow-xl z-20 border border-gray-100 flex items-center gap-2 animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
                            <span class="text-green-500 text-xl">✓</span> Bảo hành 5 năm
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-red-100 rounded-full blur-2xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-pink-100 rounded-full blur-2xl opacity-50"></div>
        </div>
    </div>
</div>

<!-- Hot Sale Section -->
<div class="hot-sale-gradient py-8" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <span class="text-4xl animate-bounce">⚡</span>
                <h2 class="text-3xl font-black text-white tracking-widest uppercase" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">HOT SALE CUỐI TUẦN</h2>
            </div>
            <div class="flex items-center gap-4 bg-white/20 px-6 py-3 rounded-2xl backdrop-blur-md border border-white/30 shadow-xl">
                <span class="text-white font-bold uppercase tracking-wider text-sm">BẮT ĐẦU SAU:</span>
                <div class="flex gap-3">
                    <div class="countdown-box text-white px-4 py-2 rounded-xl text-center shadow-inner">
                        <div class="text-3xl font-black tracking-wider" id="hours">00</div>
                        <div class="text-[10px] uppercase font-bold text-white/80 tracking-widest mt-1">Giờ</div>
                    </div>
                    <div class="text-2xl font-bold text-white self-center -mt-4">:</div>
                    <div class="countdown-box text-white px-4 py-2 rounded-xl text-center shadow-inner">
                        <div class="text-3xl font-black tracking-wider" id="minutes">07</div>
                        <div class="text-[10px] uppercase font-bold text-white/80 tracking-widest mt-1">Phút</div>
                    </div>
                    <div class="text-2xl font-bold text-white self-center -mt-4">:</div>
                    <div class="countdown-box text-white px-4 py-2 rounded-xl text-center shadow-inner bg-white/30">
                        <div class="text-3xl font-black tracking-wider" id="seconds">55</div>
                        <div class="text-[10px] uppercase font-bold text-white/80 tracking-widest mt-1">Giây</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-end justify-between mb-8" data-aos="fade-right">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-2">
                <span class="text-[#d70018]">🔥</span> Sản Phẩm Bán Chạy
            </h2>
            <div class="h-1 w-24 bg-[#d70018] mt-2 rounded"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts as $index => $product)
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-1 border border-white/40 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(215,0,24,0.1)] transition-all duration-300 relative group overflow-hidden"
                 data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <!-- Discount Badge -->
                @if($product->sale_price)
                    <div class="absolute top-4 left-4 bg-gradient-to-br from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-xs font-black tracking-widest z-10 shadow-lg shadow-red-500/30 transform group-hover:scale-110 transition-transform duration-300">
                        GIẢM {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                    </div>
                @endif

                <div class="bg-white rounded-[22px] h-full flex flex-col relative overflow-hidden">
                    <a href="{{ route('products.show', $product->slug) }}" class="flex-grow flex flex-col">
                        <!-- Image Container with soft background -->
                        <div class="aspect-square bg-gradient-to-b from-gray-50 to-white flex items-center justify-center p-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-red-500/0 group-hover:bg-red-500/5 transition-colors duration-500 z-10 rounded-t-[22px]"></div>
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('images/products/' . $product->image) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-contain filter drop-shadow-xl transform group-hover:scale-110 group-hover:-translate-y-2 group-hover:rotate-2 transition-all duration-500 z-0">
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-5 flex flex-col flex-grow">
                            <!-- Brand -->
                            <p class="text-[11px] font-black text-red-600 uppercase tracking-widest mb-2 opacity-80">{{ $product->brand }}</p>
                            
                            <!-- Name -->
                            <h3 class="text-base font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3rem] leading-snug group-hover:text-red-600 transition-colors">{{ $product->name }}</h3>
                            
                            <!-- Price -->
                            <div class="mb-4 min-h-[3.5rem] flex flex-col justify-end">
                                @if($product->sale_price)
                                    <div class="flex items-center gap-2 mb-1">
                                        <p class="text-xl font-black text-red-600 tracking-tight">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                                    </div>
                                    <p class="text-xs font-semibold text-gray-400 line-through decoration-gray-300">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                @else
                                    <div class="flex items-center gap-2 mb-1">
                                        <p class="text-xl font-black text-gray-900 tracking-tight">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                    </div>
                                    <p class="text-xs invisible">0đ</p>
                                @endif
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="bg-gray-100 text-gray-600 text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full border border-gray-200">{{ $product->movement_type }}</span>
                                <span class="bg-blue-50 text-blue-600 text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full border border-blue-100">Trả góp 0%</span>
                            </div>

                            <!-- Stock -->
                            <div class="mt-auto">
                                @if($product->stock > 0)
                                    <div class="flex items-center justify-between text-[11px] font-bold">
                                        <span class="text-green-500 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Còn hàng
                                        </span>
                                        <span class="text-gray-400">{{ $product->stock }} sản phẩm</span>
                                    </div>
                                @else
                                    <span class="text-red-500 font-bold text-[11px] flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Hết hàng
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>

                    <!-- Action Button -->
                    <div class="p-5 pt-0 mt-auto">
                        @if($product->stock > 0)
                            <form action="{{ route('cart.buyNow', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-600 to-[#d70018] text-white py-3 rounded-xl font-bold text-sm tracking-wide shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:from-red-500 hover:to-red-600 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                                    <span>Mua Ngay</span>
                                    <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </form>
                        @else
                            <button disabled
                                class="w-full bg-gray-100 text-gray-400 py-3 rounded-xl font-bold text-sm tracking-wide border border-gray-200 cursor-not-allowed flex items-center justify-center gap-2">
                                Hết hàng
                            </button>
                        @endif
                    </div>
                </div>
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
<div class="py-12 mb-12" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Box 1 -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white/40 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(215,0,24,0.1)] transition-all duration-300 relative group text-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300 shadow-lg shadow-red-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-3 text-gray-900 group-hover:text-red-600 transition-colors">Chính Hãng 100%</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Cam kết sản phẩm chính hãng, đền gấp 10 nếu phát hiện giả</p>
            </div>
            <!-- Box 2 -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white/40 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(215,0,24,0.1)] transition-all duration-300 relative group text-center" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300 shadow-lg shadow-red-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-3 text-gray-900 group-hover:text-red-600 transition-colors">Trả Góp 0%</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Hỗ trợ trả góp lãi suất 0% qua thẻ tín dụng và công ty tài chính</p>
            </div>
            <!-- Box 3 -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white/40 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(215,0,24,0.1)] transition-all duration-300 relative group text-center" data-aos="zoom-in" data-aos-delay="300">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300 shadow-lg shadow-red-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-3 text-gray-900 group-hover:text-red-600 transition-colors">Bảo Hành 5 Năm</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Bảo hành chính hãng 1 năm, WatchKing hỗ trợ thêm 4 năm</p>
            </div>
            <!-- Box 4 -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white/40 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(215,0,24,0.1)] transition-all duration-300 relative group text-center" data-aos="zoom-in" data-aos-delay="400">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 to-pink-500 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300 shadow-lg shadow-red-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-3 text-gray-900 group-hover:text-red-600 transition-colors">Miễn Phí Vận Chuyển</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Giao hàng miễn phí toàn quốc, kiểm tra hàng trước khi thanh toán</p>
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

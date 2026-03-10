<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WatchKing - Đồng Hồ Chính Hãng')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .cellphones-red { background: #d70018; }
        .cellphones-gradient { background: linear-gradient(135deg, #ff6b9d 0%, #d70018 100%); }
        .hot-sale-gradient { background: linear-gradient(90deg, #ff1744 0%, #ff6b9d 50%, #ff1744 100%); }
        .discount-badge { background: linear-gradient(135deg, #ff6600 0%, #ff3d00 100%); }
        .hover-scale { transition: transform 0.3s ease; }
        .hover-scale:hover { transform: translateY(-5px); }
        .countdown-box { background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); }
        
        /* Floating Animation */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); opacity: 0; }
            20% { opacity: 0.8; }
            80% { opacity: 0.8; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }
        .floating-particle {
            position: absolute;
            animation: float 10s linear infinite;
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Promotional Banner -->
    <div class="cellphones-red text-white text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-6" data-aos="fade-right" data-aos-duration="800">
                <span>📞 Hotline: <strong>1900 2099</strong></span>
                <span>🚚 Miễn phí vận chuyển toàn quốc</span>
                <span>✓ Bảo hành chính hãng</span>
            </div>
            <div class="flex items-center gap-4" data-aos="fade-left" data-aos-duration="800">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-yellow-300">⚙️ Quản trị</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-gradient-to-r from-[#d70018] to-[#e45464] shadow-md sticky top-0 z-50" data-aos="fade-down" data-aos-duration="500">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0 hover:opacity-90 transition">
                    <div class="bg-white text-[#d70018] w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl shadow-inner">
                        W
                    </div>
                    <div>
                        <div class="font-bold text-xl text-white tracking-wide">WatchKing</div>
                        <div class="text-[10px] uppercase tracking-wider text-white/90 font-medium">Đồng hồ chính hãng</div>
                    </div>
                </a>

                <!-- Category Dropdown -->
                <div class="relative group z-50">
                    <button class="flex items-center gap-2 bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="font-medium hidden sm:inline">Danh mục</span>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute top-full left-0 w-64 pt-3 hidden group-hover:block z-50">
                        <div class="bg-white shadow-2xl rounded-xl border border-gray-100 py-2 overflow-hidden transform origin-top transition-all duration-300">
                        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 hover:text-red-600 transition text-gray-700 font-medium border-b border-gray-50 last:border-0">
                            <span class="text-xl">⌚</span> Tất cả đồng hồ
                        </a>
                        <a href="{{ route('products.index', ['category' => 1]) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 hover:text-red-600 transition text-gray-700 font-medium border-b border-gray-50 last:border-0">
                            <span class="text-xl">👨</span> Đồng hồ Nam
                        </a>
                        <a href="{{ route('products.index', ['category' => 2]) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 hover:text-red-600 transition text-gray-700 font-medium border-b border-gray-50 last:border-0">
                            <span class="text-xl">👩</span> Đồng hồ Nữ
                        </a>
                        <a href="{{ route('products.index', ['category' => 3]) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 hover:text-red-600 transition text-gray-700 font-medium border-b border-gray-50 last:border-0">
                            <span class="text-xl">⚙️</span> Đồng hồ Cơ
                        </a>
                        <a href="{{ route('products.index', ['category' => 4]) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 hover:text-red-600 transition text-gray-700 font-medium border-b border-gray-50 last:border-0">
                            <span class="text-xl">📱</span> Smartwatch
                        </a>
                        <a href="{{ route('products.index', ['category' => 5]) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-red-50 hover:text-red-600 transition text-gray-700 font-medium border-b border-gray-50 last:border-0">
                            <span class="text-xl">⚽</span> Đồng hồ Thể thao
                        </a>
                    </div>
                </div>
            </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-xl">
                    <form action="{{ route('products.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" placeholder="Bạn cần tìm đồng hồ gì..." 
                               class="w-full px-5 py-2.5 rounded-xl border-2 border-transparent focus:border-red-300 focus:ring-2 focus:ring-red-100 focus:outline-none text-sm text-gray-900 transition-all shadow-inner"
                               value="{{ request('search') }}">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 bg-white p-1.5 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Cart & User -->
                <div class="flex items-center gap-5">
                    <!-- Cart -->
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{ route('cart.index') }}" class="relative flex items-center gap-3 text-white hover:text-yellow-200 transition group">
                                <div class="relative w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition shadow-inner">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    @if(session('cart') && count(session('cart')) > 0)
                                        <span class="absolute -top-1 -right-1 bg-yellow-400 text-red-700 text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold border-2 border-[#d70018] shadow-sm animate-bounce">
                                            {{ count(session('cart')) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="text-left hidden lg:block">
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-white/90">Giỏ hàng</div>
                                    <div class="font-extrabold text-base">{{ session('cart') ? count(session('cart')) : 0 }} sản phẩm</div>
                                </div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('cart.index') }}" class="relative flex items-center gap-3 text-white hover:text-yellow-200 transition group">
                            <div class="relative w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition shadow-inner">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                @if(session('cart') && count(session('cart')) > 0)
                                    <span class="absolute -top-1 -right-1 bg-yellow-400 text-red-700 text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold border-2 border-[#d70018] shadow-sm animate-bounce">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-left hidden lg:block">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-white/90">Giỏ hàng</div>
                                <div class="font-extrabold text-base">{{ session('cart') ? count(session('cart')) : 0 }} sản phẩm</div>
                            </div>
                        </a>
                    @endauth

                    <!-- User Menu -->
                    @auth
                        <div class="flex items-center gap-2 text-white">
                            <div class="p-2 bg-white/10 rounded-full">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="text-left hidden lg:block">
                                <div class="text-[10px] uppercase tracking-wider text-white/80 font-medium">Xin chào</div>
                                <div class="font-bold text-sm tracking-tight truncate max-w-[100px]">
                                    {{ auth()->user()->name }}
                                </div>
                            </div>
                        </div>
                        
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="bg-white text-[#d70018] px-3 py-1.5 rounded-lg hover:bg-gray-50 transition font-bold text-sm flex items-center gap-1.5 shadow-sm ml-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Panel</span>
                            </a>
                        @elseif(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.orders.index') }}" class="text-sm text-white hover:text-yellow-200 font-medium flex items-center gap-1.5 bg-white/10 px-3 py-1.5 rounded-lg ml-2 hover:bg-white/20 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Đơn mua
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                            @csrf
                            <button type="submit" class="p-2 text-white/80 hover:text-white hover:bg-white/10 rounded-full transition" title="Đăng xuất">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-[#d70018] px-5 py-2.5 rounded-xl hover:bg-gray-50 transition font-bold text-sm flex items-center gap-2 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Đăng nhập
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>


    <!-- Toast Notifications -->
    @include('components.toast')

    <!-- Main Content -->
    <main class="overflow-hidden">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16 rounded-t-3xl border-t border-gray-800 shadow-2xl relative" data-aos="fade-up">
        <!-- Footer decoration -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#ff1744] via-[#ff6b9d] to-[#ff1744]"></div>
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6 inline-block">
                        <div class="bg-[#d70018] text-white w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl shadow-lg">
                            W
                        </div>
                        <span class="font-bold text-2xl tracking-wide">WatchKing</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed">Hệ thống bán lẻ đồng hồ chính hãng uy tín hàng đầu Việt Nam. Cam kết chất lượng và dịch vụ hậu mãi tốt nhất.</p>
                    <div class="flex gap-4 mt-6">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-[#d70018] hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-[#d70018] hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-[#d70018] hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider">Hỗ trợ khách hàng</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <span class="text-[#d70018] mt-1">📞</span>
                            <div>
                                <div class="font-medium text-white">Hotline: 1900 2099</div>
                                <div class="text-xs mt-1">8:00 - 21:00 (Kể cả CN & Lễ)</div>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-[#d70018] mt-0.5">✉️</span>
                            <a href="mailto:support@watchking.vn" class="hover:text-white transition-colors">support@watchking.vn</a>
                        </li>
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">✓ Chính sách bảo hành</a></li>
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">✓ Hướng dẫn mua hàng</a></li>
                    </ul>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider">Về WatchKing</h3>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Giới thiệu công ty</a></li>
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Hệ thống cửa hàng</a></li>
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Tuyển dụng</a></li>
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Tin tức công nghệ</a></li>
                        <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Liên hệ</a></li>
                    </ul>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider">Đăng ký nhận tin</h3>
                    <p class="text-gray-400 text-sm mb-4">Nhận thông tin ưu đãi mới nhất và các sản phẩm hot sớm nhất.</p>
                    <form class="flex mb-6">
                        <input type="email" placeholder="Email của bạn" class="bg-gray-800 text-white px-4 py-2.5 rounded-l-lg focus:outline-none focus:ring-1 focus:ring-[#d70018] w-full text-sm">
                        <button type="submit" class="bg-[#d70018] px-4 py-2.5 rounded-r-lg hover:bg-red-700 transition-colors font-medium text-sm whitespace-nowrap">Đăng ký</button>
                    </form>
                    <h3 class="font-bold text-sm mb-4 uppercase tracking-wider text-gray-300">Phương thức thanh toán</h3>
                    <div class="flex gap-2">
                        <div class="w-10 h-6 bg-white rounded flex items-center justify-center text-[10px] font-bold text-blue-900">VISA</div>
                        <div class="w-10 h-6 bg-white rounded flex items-center justify-center text-[10px] font-bold text-red-600">MC</div>
                        <div class="w-12 h-6 bg-white rounded flex items-center justify-center text-[10px] font-bold text-blue-500">ATM</div>
                        <div class="w-10 h-6 bg-white rounded flex items-center justify-center text-[10px] font-bold text-green-600">COD</div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-sm text-gray-500 flex flex-col md:flex-row justify-between items-center gap-4">
                <p>&copy; 2026 WatchKing. All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition">Điều khoản sử dụng</a>
                    <a href="#" class="hover:text-white transition">Chính sách bảo mật</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS JS for scroll animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // whether animation should happen only once - while scrolling down
            offset: 50, // offset (in px) from the original trigger point
            duration: 600, // values from 0 to 3000, with step 50ms
        });
    </script>
</body>
</html>

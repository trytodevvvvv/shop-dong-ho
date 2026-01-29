<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WatchKing - Đồng Hồ Chính Hãng')</title>
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Promotional Banner -->
    <div class="cellphones-red text-white text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span>📞 Hotline: <strong>1900 2099</strong></span>
                <span>🚚 Miễn phí vận chuyển toàn quốc</span>
                <span>✓ Bảo hành chính hãng</span>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-yellow-300">⚙️ Quản trị</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between gap-6">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                    <div class="cellphones-red text-white w-12 h-12 rounded-lg flex items-center justify-center font-bold text-xl">
                        W
                    </div>
                    <div>
                        <div class="font-bold text-xl text-gray-900">WatchKing</div>
                        <div class="text-xs text-gray-500">Đồng hồ chính hãng</div>
                    </div>
                </a>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl">
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Bạn cần tìm đồng hồ gì..." 
                               class="w-full px-4 py-3 border-2 border-red-500 rounded-lg focus:outline-none focus:border-red-600"
                               value="{{ request('search') }}">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 cellphones-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                            Tìm kiếm
                        </button>
                    </form>
                </div>

                <!-- Cart & User -->
                <div class="flex items-center gap-4">
                    <!-- Cart (Hidden for Admin) -->
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2 hover:text-red-600 transition">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                @if(session('cart') && count(session('cart')) > 0)
                                    <span class="absolute -top-2 -right-2 cellphones-red text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                                <div class="text-left hidden lg:block">
                                    <div class="text-xs text-gray-500">Giỏ hàng</div>
                                    <div class="font-semibold text-sm">{{ session('cart') ? count(session('cart')) : 0 }} sản phẩm</div>
                                </div>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('cart.index') }}" class="relative flex items-center gap-2 hover:text-red-600 transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="absolute -top-2 -right-2 cellphones-red text-white text-xs w-6 h-6 rounded-full flex items-center justify-center font-bold">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                            <div class="text-left hidden lg:block">
                                <div class="text-xs text-gray-500">Giỏ hàng</div>
                                <div class="font-semibold text-sm">{{ session('cart') ? count(session('cart')) : 0 }} sản phẩm</div>
                            </div>
                        </a>
                    @endauth

                    <!-- User Menu -->
                    @auth
                        <div class="flex items-center gap-2">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div class="text-left hidden lg:block">
                                <div class="text-xs text-gray-500">Xin chào</div>
                                <div class="font-semibold text-sm">{{ auth()->user()->name }}</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="cellphones-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                            Đăng nhập
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Category Navigation -->
        <div class="border-t">
            <div class="max-w-7xl mx-auto px-4">
                <nav class="flex items-center gap-8 py-3 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-red-600 transition">🏠 Trang chủ</a>
                    <a href="{{ route('products.index') }}" class="hover:text-red-600 transition">⌚ Tất cả đồng hồ</a>
                    <a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-red-600 transition">👨 Đồng hồ Nam</a>
                    <a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-red-600 transition">👩 Đồng hồ Nữ</a>
                    <a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-red-600 transition">⚙️ Đồng hồ Cơ</a>
                    <a href="{{ route('products.index', ['category' => 4]) }}" class="hover:text-red-600 transition">📱 Smartwatch</a>
                    <a href="{{ route('products.index', ['category' => 5]) }}" class="hover:text-red-600 transition">⚽ Đồng hồ Thể thao</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">WatchKing</h3>
                    <p class="text-gray-400 text-sm">Hệ thống bán lẻ đồng hồ chính hãng uy tín hàng đầu Việt Nam</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Hỗ trợ khách hàng</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Hotline: 1900 2099</li>
                        <li>Email: support@watchking.vn</li>
                        <li>Chính sách bảo hành</li>
                        <li>Hướng dẫn mua hàng</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Về WatchKing</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Giới thiệu công ty</li>
                        <li>Hệ thống cửa hàng</li>
                        <li>Tuyển dụng</li>
                        <li>Liên hệ</li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Thanh toán</h3>
                    <p class="text-gray-400 text-sm">Hỗ trợ thanh toán COD, chuyển khoản, trả góp 0%</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2026 WatchKing. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

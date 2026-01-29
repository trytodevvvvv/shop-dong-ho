@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Tổng quan hệ thống WatchKing')

@section('content')
<!-- Revenue Statistics by Period -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    @php
        use Carbon\Carbon;
        
        // 6 months revenue
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $revenue6Months = \App\Models\Order::where('created_at', '>=', $sixMonthsAgo)->sum('total');
        $orders6Months = \App\Models\Order::where('created_at', '>=', $sixMonthsAgo)->count();
        
        // This year revenue
        $yearStart = Carbon::now()->startOfYear();
        $revenueThisYear = \App\Models\Order::where('created_at', '>=', $yearStart)->sum('total');
        $ordersThisYear = \App\Models\Order::where('created_at', '>=', $yearStart)->count();
        
        // All time revenue
        $revenueAllTime = \App\Models\Order::sum('total');
        $ordersAllTime = \App\Models\Order::count();
    @endphp

    <!-- 6 Months Revenue -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-white/20 w-14 h-14 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">6 tháng</span>
        </div>
        <h3 class="text-3xl font-bold mb-2">{{ number_format($revenue6Months, 0, ',', '.') }}đ</h3>
        <p class="text-blue-100 font-medium mb-4">Doanh thu 6 tháng</p>
        <div class="pt-4 border-t border-white/20 text-sm">
            <span class="text-blue-100">{{ $orders6Months }} đơn hàng</span>
        </div>
    </div>

    <!-- This Year Revenue -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-white/20 w-14 h-14 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">{{ now()->year }}</span>
        </div>
        <h3 class="text-3xl font-bold mb-2">{{ number_format($revenueThisYear, 0, ',', '.') }}đ</h3>
        <p class="text-green-100 font-medium mb-4">Doanh thu năm nay</p>
        <div class="pt-4 border-t border-white/20 text-sm">
            <span class="text-green-100">{{ $ordersThisYear }} đơn hàng</span>
        </div>
    </div>

    <!-- All Time Revenue -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-white/20 w-14 h-14 rounded-xl flex items-center justify-center backdrop-blur-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="text-sm font-semibold bg-white/20 px-3 py-1 rounded-full">Tổng</span>
        </div>
        <h3 class="text-3xl font-bold mb-2">{{ number_format($revenueAllTime, 0, ',', '.') }}đ</h3>
        <p class="text-purple-100 font-medium mb-4">Tổng doanh thu</p>
        <div class="pt-4 border-t border-white/20 text-sm">
            <span class="text-purple-100">{{ $ordersAllTime }} đơn hàng</span>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ \App\Models\Product::count() }}</h3>
        <p class="text-sm text-gray-600">Tổng sản phẩm</p>
        <div class="mt-3 text-xs text-gray-500">
            Còn hàng: {{ \App\Models\Product::where('stock', '>', 0)->count() }}
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ \App\Models\Order::count() }}</h3>
        <p class="text-sm text-gray-600">Tổng đơn hàng</p>
        <div class="mt-3 text-xs text-gray-500">
            Chờ xử lý: {{ \App\Models\Order::where('status', 'pending')->count() }}
        </div>
    </div>

    <!-- Total Customers -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ \App\Models\User::where('role', 'customer')->count() }}</h3>
        <p class="text-sm text-gray-600">Khách hàng</p>
        <div class="mt-3 text-xs text-gray-500">
            Tổng users: {{ \App\Models\User::count() }}
        </div>
    </div>

    <!-- Average Order Value -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-red-100 w-12 h-12 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">
            {{ \App\Models\Order::count() > 0 ? number_format(\App\Models\Order::sum('total') / \App\Models\Order::count(), 0, ',', '.') : 0 }}đ
        </h3>
        <p class="text-sm text-gray-600">Giá trị TB/đơn</p>
        <div class="mt-3 text-xs text-gray-500">
            Trung bình mỗi đơn hàng
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">📦 Đơn Hàng Gần Đây</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-purple-600 hover:text-purple-800 font-semibold text-sm">
                Xem tất cả →
            </a>
        </div>
        
        @php
            $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
        @endphp
        
        @if($recentOrders->count() > 0)
            <div class="space-y-4">
                @foreach($recentOrders as $order)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="flex items-center gap-4">
                            <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center">
                                <span class="text-purple-600 font-bold">#{{ $order->id }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900">{{ number_format($order->total, 0, ',', '.') }}đ</p>
                            <span class="text-xs px-2 py-1 rounded-full {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($order->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                {{ $order->status === 'pending' ? 'Chờ xử lý' : ($order->status === 'completed' ? 'Hoàn thành' : 'Đã hủy') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-12">Chưa có đơn hàng nào</p>
        @endif
    </div>

    <!-- Top Products -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">⭐ Sản Phẩm Nổi Bật</h3>
            <a href="{{ route('admin.products.index') }}" class="text-purple-600 hover:text-purple-800 font-semibold text-sm">
                Xem tất cả →
            </a>
        </div>
        
        @php
            $topProducts = \App\Models\Product::latest()->take(5)->get();
        @endphp
        
        <div class="space-y-4">
            @foreach($topProducts as $product)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <div class="bg-gradient-to-br from-purple-100 to-purple-50 w-12 h-12 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ Str::limit($product->name, 30) }}</p>
                            <p class="text-sm text-gray-500">{{ $product->brand }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                        <p class="text-xs text-gray-500">Tồn: {{ $product->stock }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-2xl shadow-lg p-6">
    <h3 class="text-xl font-bold text-gray-900 mb-6">⚡ Thao Tác Nhanh</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.products.create') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl p-6 transition border-2 border-blue-200">
            <div class="flex items-center gap-4">
                <div class="bg-blue-500 w-12 h-12 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-blue-900">Thêm sản phẩm</p>
                    <p class="text-sm text-blue-700">Tạo sản phẩm mới</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl p-6 transition border-2 border-green-200">
            <div class="flex items-center gap-4">
                <div class="bg-green-500 w-12 h-12 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-green-900">Quản lý đơn hàng</p>
                    <p class="text-sm text-green-700">Xử lý đơn hàng</p>
                </div>
            </div>
        </a>

        <a href="{{ route('home') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl p-6 transition border-2 border-purple-200">
            <div class="flex items-center gap-4">
                <div class="bg-purple-500 w-12 h-12 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-purple-900">Xem website</p>
                    <p class="text-sm text-purple-700">Trang chủ</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

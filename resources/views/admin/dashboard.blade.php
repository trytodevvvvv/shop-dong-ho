@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Tổng quan hệ thống WatchKing')

@section('content')
@php
    use Carbon\Carbon;
    
    // Get filter parameter for chart
    $period = request('period', '6months');
    
    // Calculate revenue for stats card (always show all time)
    $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total');
    $totalCompletedOrders = \App\Models\Order::where('status', 'completed')->count();
    
    // Get revenue data based on selected period for chart
    $monthlyRevenue = [];
    $monthlyLabels = [];
    
    if ($period === '6months') {
        $monthsToShow = 6;
        $chartTitle = 'Doanh thu 6 tháng gần nhất';
    } elseif ($period === 'year') {
        $monthsToShow = 12;
        $chartTitle = 'Doanh thu năm ' . date('Y');
    } else {
        $monthsToShow = 12;
        $chartTitle = 'Doanh thu 12 tháng gần nhất';
    }
    
    for ($i = $monthsToShow - 1; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);
        $monthStart = $date->copy()->startOfMonth();
        $monthEnd = $date->copy()->endOfMonth();
        
        $monthRevenue = \App\Models\Order::whereBetween('created_at', [$monthStart, $monthEnd])
            ->where('status', 'completed')
            ->sum('total');
        
        $monthlyRevenue[] = $monthRevenue;
        $monthlyLabels[] = $date->format('m/Y');
    }
    
    $chartTotal = array_sum($monthlyRevenue);
@endphp

<!-- Stats Grid - 5 Cards in One Row -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    <!-- Total Revenue -->
    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-purple-500">
        <div class="bg-purple-100 w-10 h-10 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($totalRevenue, 0, ',', '.') }}đ</h3>
        <p class="text-xs text-gray-600 mb-2">Tổng doanh thu</p>
        <div class="text-xs text-gray-500">
            {{ $totalCompletedOrders }} đơn
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-blue-500">
        <div class="bg-blue-100 w-10 h-10 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Models\Product::count() }}</h3>
        <p class="text-xs text-gray-600 mb-2">Sản phẩm</p>
        <div class="text-xs text-gray-500">
            Còn: {{ \App\Models\Product::where('stock', '>', 0)->count() }}
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-green-500">
        <div class="bg-green-100 w-10 h-10 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Models\Order::count() }}</h3>
        <p class="text-xs text-gray-600 mb-2">Đơn hàng</p>
        <div class="text-xs text-gray-500">
            Chờ: {{ \App\Models\Order::where('status', 'pending')->count() }}
        </div>
    </div>

    <!-- Total Customers -->
    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-orange-500">
        <div class="bg-orange-100 w-10 h-10 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ \App\Models\User::where('role', 'customer')->count() }}</h3>
        <p class="text-xs text-gray-600 mb-2">Khách hàng</p>
        <div class="text-xs text-gray-500">
            Users: {{ \App\Models\User::count() }}
        </div>
    </div>

    <!-- Average Order Value -->
    <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-red-500">
        <div class="bg-red-100 w-10 h-10 rounded-lg flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-1">
            {{ $totalCompletedOrders > 0 ? number_format($totalRevenue / $totalCompletedOrders, 0, ',', '.') : 0 }}đ
        </h3>
        <p class="text-xs text-gray-600 mb-2">TB/đơn</p>
        <div class="text-xs text-gray-500">
            Giá trị TB
        </div>
    </div>
</div>

<!-- Chart Row with Filter Tabs -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Revenue Chart with Tabs - Takes 2 columns -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Filter Tabs -->
        <div class="flex border-b border-gray-200">
            <a href="?period=6months" 
               class="flex-1 px-4 py-3 text-center text-sm font-semibold transition {{ $period === '6months' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">
                📊 6 Tháng
            </a>
            <a href="?period=year" 
               class="flex-1 px-4 py-3 text-center text-sm font-semibold transition {{ $period === 'year' ? 'text-green-600 border-b-2 border-green-600 bg-green-50' : 'text-gray-600 hover:bg-gray-50' }}">
                📅 Năm {{ date('Y') }}
            </a>
            <a href="?period=all" 
               class="flex-1 px-4 py-3 text-center text-sm font-semibold transition {{ $period === 'all' ? 'text-purple-600 border-b-2 border-purple-600 bg-purple-50' : 'text-gray-600 hover:bg-gray-50' }}">
                💰 12 Tháng
            </a>
        </div>

        <!-- Chart Content -->
        <div class="p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">📊 Biểu Đồ Doanh Thu</h3>
                    <p class="text-xs text-gray-600">{{ $chartTitle }}</p>
                </div>
                <span class="bg-purple-100 text-purple-700 px-3 py-1.5 rounded-lg font-semibold text-xs">
                    💰 {{ number_format($chartTotal, 0, ',', '.') }}đ
                </span>
            </div>
            
            <div class="relative h-72">
                <canvas id="revenueChart" 
                        data-labels="{{ json_encode($monthlyLabels) }}"
                        data-revenue="{{ json_encode($monthlyRevenue) }}"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders - Takes 1 column -->
    <div class="bg-white rounded-xl shadow-md p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-900">📦 Đơn Gần Đây</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-purple-600 hover:text-purple-800 font-semibold text-xs">
                Xem tất cả →
            </a>
        </div>
        
        <div class="space-y-2">
            @php
                $recentOrders = \App\Models\Order::latest()->take(6)->get();
            @endphp
            @foreach($recentOrders as $order)
                <div class="flex items-center justify-between p-2.5 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-900 truncate">Đơn #{{ $order->id }}</p>
                        <p class="text-xs text-gray-500">{{ $order->created_at->format('d/m H:i') }}</p>
                    </div>
                    <div class="text-right ml-2">
                        <p class="text-xs font-bold text-gray-900">{{ number_format($order->total, 0, ',', '.') }}đ</p>
                        <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $order->status === 'shipping' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                            @if($order->status === 'pending') Chờ
                            @elseif($order->status === 'shipping') Giao
                            @elseif($order->status === 'completed') Xong
                            @else Hủy
                            @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Bottom Row: Low Stock + Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Low Stock Products - Takes 2 columns -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-900">⚠️ Sản Phẩm Sắp Hết Hàng</h3>
            <a href="{{ route('admin.products.index') }}" class="text-purple-600 hover:text-purple-800 font-semibold text-xs">
                Xem tất cả →
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @php
                $lowStockProducts = \App\Models\Product::where('stock', '<=', 5)->orderBy('stock')->take(6)->get();
            @endphp
            @forelse($lowStockProducts as $product)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $product->name }}</p>
                        <p class="text-xs text-gray-600">{{ $product->brand }}</p>
                    </div>
                    <div class="text-right ml-3">
                        <span class="inline-block px-3 py-1 text-sm font-bold rounded-full
                            {{ $product->stock === 0 ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $product->stock }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-2">
                    <p class="text-sm text-gray-500 text-center py-6">Tất cả sản phẩm đều còn hàng đầy đủ!</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions - Takes 1 column -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-md p-5 text-white">
        <h3 class="text-base font-bold mb-4">⚡ Thao Tác Nhanh</h3>
        <div class="space-y-2">
            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-sm font-semibold">Thêm Sản Phẩm</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="text-sm font-semibold">Quản Lý Đơn Hàng</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="text-sm font-semibold">Quản Lý Users</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-3 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-sm font-semibold">Danh Sách Sản Phẩm</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
/* eslint-disable */
// @ts-nocheck
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('revenueChart');
    
    if (!ctx) return;
    
    // Get data from canvas attributes
    var labelsJson = ctx.getAttribute('data-labels');
    var revenueJson = ctx.getAttribute('data-revenue');
    
    var chartLabels = [];
    var chartData = [];
    
    try {
        chartLabels = JSON.parse(labelsJson);
        chartData = JSON.parse(revenueJson);
    } catch (e) {
        console.error('Error parsing chart data:', e);
        return;
    }
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: chartData,
                borderColor: 'rgb(147, 51, 234)',
                backgroundColor: 'rgba(147, 51, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: 'rgb(147, 51, 234)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverBackgroundColor: 'rgb(126, 34, 206)',
                pointHoverBorderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        color: '#1f2937',
                        usePointStyle: true,
                        padding: 15
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 13,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(context.parsed.y);
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                notation: 'compact',
                                compactDisplay: 'short'
                            }).format(value) + 'đ';
                        },
                        font: {
                            size: 11
                        },
                        color: '#6b7280'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10,
                            weight: '500'
                        },
                        color: '#6b7280'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
});
</script>
@endpush
@endsection

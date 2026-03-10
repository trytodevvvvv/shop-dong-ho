@extends('layouts.main')

@section('title', 'Đơn Hàng Của Tôi - WatchKing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-red-600">Trang chủ</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">Đơn hàng của tôi</li>
        </ol>
    </nav>

    <h1 class="text-3xl font-bold text-gray-900 mb-6">📦 Đơn Hàng Của Tôi</h1>

    <!-- Spending Statistics -->
    @php
        $totalSpent = auth()->user()->orders()->where('status', 'completed')->sum('total');
        $totalOrders = auth()->user()->orders()->where('status', 'completed')->count();
        $averageOrder = $totalOrders > 0 ? $totalSpent / $totalOrders : 0;
    @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Spent -->
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-white/20 w-12 h-12 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold bg-white/20 px-3 py-1 rounded-full">💰</span>
            </div>
            <h3 class="text-2xl font-bold mb-1">{{ number_format($totalSpent, 0, ',', '.') }}đ</h3>
            <p class="text-red-100 text-sm font-medium">Tổng tiền đã tiêu</p>
        </div>

        <!-- Total Completed Orders -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-white/20 w-12 h-12 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold bg-white/20 px-3 py-1 rounded-full">✅</span>
            </div>
            <h3 class="text-2xl font-bold mb-1">{{ $totalOrders }}</h3>
            <p class="text-green-100 text-sm font-medium">Đơn hàng hoàn thành</p>
        </div>

        <!-- Average Order Value -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-white/20 w-12 h-12 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold bg-white/20 px-3 py-1 rounded-full">📊</span>
            </div>
            <h3 class="text-2xl font-bold mb-1">{{ number_format($averageOrder, 0, ',', '.') }}đ</h3>
            <p class="text-blue-100 text-sm font-medium">Trung bình mỗi đơn</p>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden">
        <div class="flex overflow-x-auto">
            <a href="{{ route('customer.orders.index') }}" 
               class="flex-1 min-w-[120px] px-6 py-4 text-center font-semibold transition {{ !request('status') ? 'text-red-600 border-b-2 border-red-600 bg-red-50' : 'text-gray-600 hover:bg-gray-50' }}">
                📋 Tất cả ({{ $statusCounts['all'] }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'pending']) }}" 
               class="flex-1 min-w-[120px] px-6 py-4 text-center font-semibold transition {{ request('status') === 'pending' ? 'text-red-600 border-b-2 border-red-600 bg-red-50' : 'text-gray-600 hover:bg-gray-50' }}">
                ⏳ Chờ xử lý ({{ $statusCounts['pending'] }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'shipping']) }}" 
               class="flex-1 min-w-[120px] px-6 py-4 text-center font-semibold transition {{ request('status') === 'shipping' ? 'text-red-600 border-b-2 border-red-600 bg-red-50' : 'text-gray-600 hover:bg-gray-50' }}">
                🔄 Đang xử lý ({{ $statusCounts['shipping'] }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'completed']) }}" 
               class="flex-1 min-w-[120px] px-6 py-4 text-center font-semibold transition {{ request('status') === 'completed' ? 'text-red-600 border-b-2 border-red-600 bg-red-50' : 'text-gray-600 hover:bg-gray-50' }}">
                ✅ Đã giao ({{ $statusCounts['completed'] }})
            </a>
            <a href="{{ route('customer.orders.index', ['status' => 'cancelled']) }}" 
               class="flex-1 min-w-[120px] px-6 py-4 text-center font-semibold transition {{ request('status') === 'cancelled' ? 'text-red-600 border-b-2 border-red-600 bg-red-50' : 'text-gray-600 hover:bg-gray-50' }}">
                ❌ Đã hủy ({{ $statusCounts['cancelled'] }})
            </a>
        </div>
    </div>

    <!-- Orders List -->
    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <!-- Order Header -->
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-gray-900">Đơn hàng #{{ $order->id }}</span>
                            <span class="text-sm text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <span class="px-4 py-2 rounded-full font-semibold text-sm
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $order->status === 'shipping' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                            @if($order->status === 'pending') ⏳ Chờ xử lý
                            @elseif($order->status === 'shipping') 🔄 Đang xử lý
                            @elseif($order->status === 'completed') ✅ Đã giao hàng
                            @else ❌ Đã hủy
                            @endif
                        </span>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        <div class="space-y-3 mb-4">
                            @foreach($order->orderItems->take(3) as $item)
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-red-50 to-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->product->brand }} • x{{ $item->quantity }}</p>
                                    </div>
                                    <p class="font-bold text-gray-900">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</p>
                                </div>
                            @endforeach
                            
                            @if($order->orderItems->count() > 3)
                                <p class="text-sm text-gray-500 text-center">+ {{ $order->orderItems->count() - 3 }} sản phẩm khác</p>
                            @endif
                        </div>

                        <!-- Order Footer -->
                        <div class="pt-4 border-t border-gray-200 flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Tổng cộng:</p>
                                <p class="text-2xl font-bold text-red-600">{{ number_format($order->total, 0, ',', '.') }}đ</p>
                            </div>
                            <a href="{{ route('customer.orders.show', $order) }}" 
                               class="cellphones-red text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                                Xem chi tiết →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Chưa có đơn hàng nào</h3>
            <p class="text-gray-600 mb-6">Hãy khám phá và mua sắm những sản phẩm tuyệt vời của chúng tôi!</p>
            <a href="{{ route('products.index') }}" class="cellphones-red text-white px-6 py-3 rounded-lg inline-block hover:bg-red-700 transition font-semibold">
                Mua sắm ngay →
            </a>
        </div>
    @endif
</div>
@endsection

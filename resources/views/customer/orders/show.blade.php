@extends('layouts.main')

@section('title', 'Chi Tiết Đơn Hàng #' . $order->id . ' - WatchKing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-red-600">Trang chủ</a></li>
            <li>/</li>
            <li><a href="{{ route('customer.orders.index') }}" class="hover:text-red-600">Đơn hàng của tôi</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">Đơn hàng #{{ $order->id }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">📦 Sản Phẩm Trong Đơn</h2>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                            <div class="w-20 h-20 bg-gradient-to-br from-red-50 to-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-900">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-600">{{ $item->product->brand }}</p>
                                <p class="text-sm text-gray-500 mt-1">Số lượng: x{{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                                <p class="text-sm text-gray-500">Thành tiền:</p>
                                <p class="font-bold text-red-600">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between text-2xl font-bold">
                        <span class="text-gray-900">Tổng cộng:</span>
                        <span class="text-red-600">{{ number_format($order->total, 0, ',', '.') }}đ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Info & Timeline -->
        <div class="space-y-6">
            <!-- Order Info -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Thông Tin Đơn Hàng</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Mã đơn hàng</p>
                        <p class="font-bold text-gray-900">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Ngày đặt hàng</p>
                        <p class="font-semibold text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Trạng thái</p>
                        <span class="inline-block px-4 py-2 rounded-lg font-semibold mt-1
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
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">🕐 Tiến Trình Đơn Hàng</h3>
                
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                    
                    <div class="space-y-6">
                        <!-- completed -->
                        <div class="relative flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ $order->status === 'completed' ? 'bg-green-500' : 'bg-gray-300' }}">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="flex-1 {{ $order->status === 'completed' ? '' : 'opacity-50' }}">
                                <p class="font-semibold text-gray-900">Đã giao hàng</p>
                                <p class="text-sm text-gray-500">Đơn hàng đã được giao thành công</p>
                                @if($order->status === 'completed')
                                    <p class="text-xs text-gray-400 mt-1">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- shipping -->
                        <div class="relative flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 {{ in_array($order->status, ['shipping', 'completed']) ? 'bg-blue-500' : 'bg-gray-300' }}">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <div class="flex-1 {{ in_array($order->status, ['shipping', 'completed']) ? '' : 'opacity-50' }}">
                                <p class="font-semibold text-gray-900">Đang xử lý</p>
                                <p class="text-sm text-gray-500">Đơn hàng đang được chuẩn bị</p>
                            </div>
                        </div>

                        <!-- Pending -->
                        <div class="relative flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 bg-yellow-500">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Đã đặt hàng</p>
                                <p class="text-sm text-gray-500">Đơn hàng đã được tạo</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <!-- Cancelled (if applicable) -->
                        @if($order->status === 'cancelled')
                            <div class="relative flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 z-10 bg-red-500">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-red-700">Đã hủy</p>
                                    <p class="text-sm text-gray-500">Đơn hàng đã bị hủy</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('customer.orders.index') }}" class="block w-full bg-gray-200 text-gray-700 text-center px-6 py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
                ← Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection

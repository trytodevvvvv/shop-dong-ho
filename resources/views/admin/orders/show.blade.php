@extends('layouts.admin')

@section('page-title', 'Chi Tiết Đơn Hàng #' . $order->id)
@section('page-subtitle', 'Thông tin chi tiết đơn hàng')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Items -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">📦 Sản Phẩm Trong Đơn</h3>
            
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        <div class="bg-gradient-to-br from-purple-100 to-purple-50 w-16 h-16 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->product->brand }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                            <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-purple-600">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between text-xl font-bold">
                    <span>Tổng cộng:</span>
                    <span class="text-purple-600">{{ number_format($order->total, 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Info -->
    <div class="space-y-6">
        <!-- Customer Info -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">👤 Thông Tin Khách Hàng</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Tên khách hàng</p>
                    <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold text-gray-900">{{ $order->user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">📊 Trạng Thái</h3>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" onchange="this.form.submit()" 
                        class="w-full px-4 py-3 rounded-xl font-semibold border-2 cursor-pointer
                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700 border-yellow-300' : '' }}
                        {{ $order->status === 'shipping' ? 'bg-blue-100 text-blue-700 border-blue-300' : '' }}
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-700 border-green-300' : '' }}
                        {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700 border-red-300' : '' }}">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
                    <option value="shipping" {{ $order->status === 'shipping' ? 'selected' : '' }}>🚚 Đang giao hàng</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>✅ Hoàn thành</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Đã hủy</option>
                </select>
            </form>
        </div>

        <!-- Order Date -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">📅 Thời Gian</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Ngày đặt hàng</p>
                    <p class="font-semibold text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Cập nhật lần cuối</p>
                    <p class="font-semibold text-gray-900">{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.orders.index') }}" class="block w-full bg-gray-200 text-gray-700 text-center px-6 py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
            ← Quay lại danh sách
        </a>
    </div>
</div>
@endsection

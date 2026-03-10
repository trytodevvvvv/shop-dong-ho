@extends('layouts.admin')

@section('page-title', 'Chi Tiết Người Dùng')
@section('page-subtitle', $user->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- User Info -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="text-center mb-6">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $user->name }}</h3>
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>

            <div class="space-y-3 pt-6 border-t border-gray-200">
                <div>
                    <p class="text-sm text-gray-500">Quyền hiện tại</p>
                    @if($user->role === 'admin')
                        <span class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-lg font-semibold mt-1">👨‍💼 Admin</span>
                    @else
                        <span class="inline-block bg-blue-100 text-blue-700 px-4 py-2 rounded-lg font-semibold mt-1">🛍️ Khách hàng</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-500">Ngày đăng ký</p>
                    <p class="font-semibold text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Cập nhật lần cuối</p>
                    <p class="font-semibold text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Change Role -->
        @if($user->id !== auth()->id())
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🔄 Đổi Quyền</h3>
                <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="role" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl mb-4 font-semibold focus:border-purple-500 focus:outline-none">
                        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>🛍️ Khách hàng</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>👨‍💼 Admin</option>
                    </select>
                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl font-semibold hover:bg-purple-700 transition">
                        Cập nhật quyền
                    </button>
                </form>
            </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('admin.users.index') }}" class="block w-full bg-gray-200 text-gray-700 text-center px-6 py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
            ← Quay lại danh sách
        </a>
    </div>

    <!-- Order Statistics & History -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-purple-500">
                <p class="text-sm text-gray-600 mb-1">Tổng đơn hàng</p>
                <p class="text-2xl font-bold text-gray-900">{{ $orderStats['total'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-yellow-500">
                <p class="text-sm text-gray-600 mb-1">Chờ xử lý</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $orderStats['pending'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-blue-500">
                <p class="text-sm text-gray-600 mb-1">Đang xử lý</p>
                <p class="text-2xl font-bold text-blue-600">{{ $orderStats['shipping'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-green-500">
                <p class="text-sm text-gray-600 mb-1">Đã giao</p>
                <p class="text-2xl font-bold text-green-600">{{ $orderStats['completed'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-red-500">
                <p class="text-sm text-gray-600 mb-1">Đã hủy</p>
                <p class="text-2xl font-bold text-red-600">{{ $orderStats['cancelled'] }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 border-l-4 border-purple-500">
                <p class="text-sm text-gray-600 mb-1">Tổng chi tiêu</p>
                <p class="text-xl font-bold text-purple-600">{{ number_format($orderStats['total_spent'], 0, ',', '.') }}đ</p>
            </div>
        </div>

        <!-- Order History -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6">📦 Lịch Sử Đơn Hàng</h3>
            
            @if($user->orders->count() > 0)
                <div class="space-y-4">
                    @foreach($user->orders->take(10) as $order)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="flex items-center gap-4">
                                <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center">
                                    <span class="text-purple-600 font-bold">#{{ $order->id }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->orderItems->count() }} sản phẩm</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">{{ number_format($order->total, 0, ',', '.') }}đ</p>
                                <span class="text-xs px-2 py-1 rounded-full 
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $order->status === 'shipping' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                    @if($order->status === 'pending') ⏳ Chờ xử lý
                                    @elseif($order->status === 'shipping') 🚚 Đang giao
                                    @elseif($order->status === 'completed') ✅ Hoàn thành
                                    @else ❌ Đã hủy
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($user->orders->count() > 10)
                    <div class="mt-4 text-center">
                        <a href="{{ route('admin.orders.index') }}?user_id={{ $user->id }}" class="text-purple-600 hover:text-purple-800 font-semibold">
                            Xem tất cả {{ $user->orders->count() }} đơn hàng →
                        </a>
                    </div>
                @endif
            @else
                <p class="text-gray-500 text-center py-12">Người dùng chưa có đơn hàng nào</p>
            @endif
        </div>
    </div>
</div>
@endsection

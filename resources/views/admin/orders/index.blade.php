@extends('layouts.admin')

@section('title', 'Quản Lý Đơn Hàng - Admin')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-900">📦 Quản Lý Đơn Hàng</h2>
    <p class="text-gray-600">Tổng {{ $orders->total() }} đơn hàng</p>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Mã ĐH</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Khách hàng</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tổng tiền</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Trạng thái</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Ngày đặt</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-bold text-gray-900">#{{ $order->id }}</td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ number_format($order->total, 0, ',', '.') }}đ</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="px-3 py-1 rounded-full text-sm font-semibold border-0 cursor-pointer
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Xem chi tiết →
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection

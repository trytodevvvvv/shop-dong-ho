@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm - Admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-3xl font-bold text-gray-900">⌚ Quản Lý Sản Phẩm</h2>
        <p class="text-gray-600">Tổng {{ $products->total() }} sản phẩm</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
        ➕ Thêm Sản Phẩm Mới
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">ID</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Sản phẩm</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Danh mục</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Giá</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tồn kho</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">#{{ $product->id }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">{{ $product->brand }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $product->category->name }}</td>
                    <td class="px-6 py-4">
                        @if($product->sale_price)
                            <div>
                                <p class="font-bold text-red-600">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                                <p class="text-xs text-gray-500 line-through">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                            </div>
                        @else
                            <p class="font-bold text-gray-900">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->stock }} sp
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded transition">
                                ✏️
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded transition">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection

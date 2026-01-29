@extends('layouts.admin')

@section('page-title', 'Thêm Sản Phẩm Mới')
@section('page-subtitle', 'Tạo sản phẩm mới trong hệ thống')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.products.store') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tên sản phẩm *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('name') border-red-500 @enderror"
                       placeholder="Rolex Submariner Date">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Danh mục *</label>
                <select name="category_id" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('category_id') border-red-500 @enderror">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Thương hiệu *</label>
                <input type="text" name="brand" value="{{ old('brand') }}" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('brand') border-red-500 @enderror"
                       placeholder="Rolex">
                @error('brand')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Giá gốc (VNĐ) *</label>
                <input type="number" name="price" value="{{ old('price') }}" required min="0"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('price') border-red-500 @enderror"
                       placeholder="50000000">
                @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sale Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Giá khuyến mãi (VNĐ)</label>
                <input type="number" name="sale_price" value="{{ old('sale_price') }}" min="0"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('sale_price') border-red-500 @enderror"
                       placeholder="45000000">
                @error('sale_price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Movement Type -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Loại máy *</label>
                <select name="movement_type" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('movement_type') border-red-500 @enderror">
                    <option value="">-- Chọn loại máy --</option>
                    <option value="Automatic" {{ old('movement_type') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="Quartz" {{ old('movement_type') == 'Quartz' ? 'selected' : '' }}>Quartz</option>
                    <option value="Mechanical" {{ old('movement_type') == 'Mechanical' ? 'selected' : '' }}>Mechanical</option>
                    <option value="Solar" {{ old('movement_type') == 'Solar' ? 'selected' : '' }}>Solar</option>
                </select>
                @error('movement_type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tồn kho *</label>
                <input type="number" name="stock" value="{{ old('stock', 10) }}" required min="0"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('stock') border-red-500 @enderror"
                       placeholder="10">
                @error('stock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mô tả</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('description') border-red-500 @enderror"
                          placeholder="Mô tả chi tiết về sản phẩm...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-4 mt-8">
            <button type="submit" class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition">
                ➕ Thêm Sản Phẩm
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:bg-gray-300 transition">
                Hủy
            </a>
        </div>
    </form>
</div>
@endsection

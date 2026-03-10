@extends('layouts.admin')

@section('page-title', 'Thêm Sản Phẩm Mới')
@section('page-subtitle', 'Tạo sản phẩm mới trong hệ thống')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-8">
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
                    <option value="Pin" {{ old('movement_type') == 'Pin' ? 'selected' : '' }}>Pin (Smartwatch)</option>
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

            <!-- Image Selection -->
            <div class="md:col-span-2 border-t pt-6 mt-2">
                <label class="block text-sm font-semibold text-gray-700 mb-4">Hình ảnh sản phẩm *</label>
                
                <div class="flex gap-6 mb-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="image_type" value="upload" {{ old('image_type', 'upload') == 'upload' ? 'checked' : '' }} onclick="toggleImageType('upload')" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Tải ảnh lên</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="image_type" value="url" {{ old('image_type') == 'url' ? 'checked' : '' }} onclick="toggleImageType('url')" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Dùng URL ảnh</span>
                    </label>
                </div>

                <!-- Upload Input -->
                <div id="image-upload-input" class="{{ old('image_type', 'upload') == 'upload' ? '' : 'hidden' }} transition-all">
                     <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click để chọn ảnh</span> hoặc kéo thả vào đây</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF (Max 2MB)</p>
                            </div>
                            <input id="dropzone-file" name="image_file" type="file" accept="image/*" class="hidden" onchange="previewUploadImage(this)" />
                        </label>
                    </div>
                    <!-- Image Preview Container -->
                    <div id="upload-preview-container" class="hidden mt-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Xem trước:</p>
                        <img id="upload-preview" src="#" alt="Preview" class="h-48 rounded-lg shadow-md object-cover">
                    </div>
                    @error('image_file')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL Input -->
                <div id="image-url-input" class="{{ old('image_type') == 'url' ? '' : 'hidden' }} transition-all">
                    <input type="url" name="image_url" id="image_url_field" value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none"
                           oninput="previewUrlImage()">
                    
                     <!-- URL Preview Container -->
                    <div id="url-preview-container" class="hidden mt-4">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Xem trước:</p>
                        <img id="url-preview" src="#" alt="Preview" class="h-48 rounded-lg shadow-md object-cover" onerror="this.src='https://via.placeholder.com/300?text=Invalid+Image+URL'">
                    </div>
                    @error('image_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ===== ẢNH THUMBNAIL PHỤ ===== --}}
            <div class="md:col-span-2 border-t pt-6 mt-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">🖼️ Ảnh thumbnail phụ <span class="text-gray-400 font-normal">(tùy chọn, tối đa 6 ảnh)</span></label>
                <p class="text-xs text-gray-500 mb-4">Ảnh phụ hiển thị bên dưới ảnh chính trong trang chi tiết sản phẩm. Có thể upload file hoặc dán URL, hoặc kết hợp cả hai.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Upload nhiều file --}}
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">📁 Tải file lên (chọn nhiều ảnh)</p>
                        <label for="thumb-files-input" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-purple-300 rounded-xl cursor-pointer bg-purple-50 hover:bg-purple-100 transition">
                            <svg class="w-8 h-8 mb-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-purple-600 font-semibold">Click để chọn ảnh</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG (max 2MB mỗi file)</p>
                            <input id="thumb-files-input" name="thumb_files[]" type="file" accept="image/*" multiple class="hidden" onchange="previewThumbFiles(this)">
                        </label>
                    </div>

                    {{-- URL mỗi dòng --}}
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">🔗 Dán URL ảnh (mỗi dòng một URL)</p>
                        <textarea name="thumb_urls" id="thumb_urls_field" rows="5"
                                  placeholder="https://example.com/anh1.jpg&#10;https://example.com/anh2.jpg"
                                  class="w-full px-3 py-2 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none text-sm font-mono resize-none"
                                  oninput="previewThumbUrls()">{{ old('thumb_urls') }}</textarea>
                    </div>
                </div>

                {{-- Preview thumbnails --}}
                <div id="thumb-preview-container" class="mt-4 {{ old('thumb_urls') ? '' : 'hidden' }}">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Xem trước ảnh thumbnail:</p>
                    <div id="thumb-preview-grid" class="grid grid-cols-4 gap-3"></div>
                </div>
            </div>

            <!-- Description -->
            <div class="md:col-span-2 border-t pt-4">
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

@push('scripts')
<script>
    function toggleImageType(type) {
        const uploadInput = document.getElementById('image-upload-input');
        const urlInput = document.getElementById('image-url-input');
        
        if (type === 'upload') {
            uploadInput.classList.remove('hidden');
            urlInput.classList.add('hidden');
        } else {
            uploadInput.classList.add('hidden');
            urlInput.classList.remove('hidden');
        }
    }

    function previewUploadImage(input) {
        const previewContainer = document.getElementById('upload-preview-container');
        const previewImage = document.getElementById('upload-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    function previewUrlImage() {
        const input = document.getElementById('image_url_field');
        const previewContainer = document.getElementById('url-preview-container');
        const previewImage = document.getElementById('url-preview');
        const url = input.value.trim();
        
        if (url) {
            previewImage.src = url;
            previewContainer.classList.remove('hidden');
        } else {
            previewContainer.classList.add('hidden');
        }
    }
    
    // Check URL preview on load if value exists
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('input[name="image_type"]:checked').value === 'url') {
            previewUrlImage();
        }
        // Preview thumb URLs on load if old value
        if (document.getElementById('thumb_urls_field').value.trim()) {
            previewThumbUrls();
        }
    });

    // === THUMBNAIL FUNCTIONS ===
    function previewThumbFiles(input) {
        const grid = document.getElementById('thumb-preview-grid');
        const container = document.getElementById('thumb-preview-container');
        // Xóa preview file cũ (giữ lại preview URL)
        document.querySelectorAll('.thumb-file-preview').forEach(el => el.remove());

        if (input.files && input.files.length > 0) {
            container.classList.remove('hidden');
            Array.from(input.files).forEach(function(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'thumb-file-preview aspect-square rounded-lg overflow-hidden border-2 border-purple-300 relative';
                    div.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">' +
                        '<span class="absolute bottom-0 left-0 right-0 bg-purple-600 text-white text-xs text-center py-0.5">File</span>';
                    grid.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function previewThumbUrls() {
        const textarea = document.getElementById('thumb_urls_field');
        const grid = document.getElementById('thumb-preview-grid');
        const container = document.getElementById('thumb-preview-container');
        // Xóa preview URL cũ
        document.querySelectorAll('.thumb-url-preview').forEach(el => el.remove());

        const urls = textarea.value.split('\n').map(u => u.trim()).filter(u => u.length > 0);
        if (urls.length > 0) {
            container.classList.remove('hidden');
            urls.forEach(function(url) {
                const div = document.createElement('div');
                div.className = 'thumb-url-preview aspect-square rounded-lg overflow-hidden border-2 border-blue-300 relative';
                div.innerHTML = '<img src="' + url + '" class="w-full h-full object-cover" onerror="this.style.display=\'none\'">' +
                    '<span class="absolute bottom-0 left-0 right-0 bg-blue-600 text-white text-xs text-center py-0.5">URL</span>';
                grid.appendChild(div);
            });
        } else {
            // Ẩn nếu không còn gì
            if (!document.querySelector('.thumb-file-preview')) {
                container.classList.add('hidden');
            }
        }
    }

</script>
@endpush
@endsection

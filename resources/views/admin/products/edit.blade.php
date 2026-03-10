@extends('layouts.admin')

@section('page-title', 'Sửa Sản Phẩm')
@section('page-subtitle', 'Cập nhật thông tin sản phẩm')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tên sản phẩm *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Danh mục *</label>
                <select name="category_id" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('category_id') border-red-500 @enderror">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('brand') border-red-500 @enderror">
                @error('brand')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Giá gốc *</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('price') border-red-500 @enderror">
                @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sale Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Giá khuyến mãi</label>
                <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" min="0"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('sale_price') border-red-500 @enderror">
                @error('sale_price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Movement Type -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Loại máy *</label>
                <select name="movement_type" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('movement_type') border-red-500 @enderror">
                    <option value="Automatic" {{ old('movement_type', $product->movement_type) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                    <option value="Quartz" {{ old('movement_type', $product->movement_type) == 'Quartz' ? 'selected' : '' }}>Quartz</option>
                    <option value="Mechanical" {{ old('movement_type', $product->movement_type) == 'Mechanical' ? 'selected' : '' }}>Mechanical</option>
                    <option value="Solar" {{ old('movement_type', $product->movement_type) == 'Solar' ? 'selected' : '' }}>Solar</option>
                    <option value="Pin" {{ old('movement_type', $product->movement_type) == 'Pin' ? 'selected' : '' }}>Pin (Smartwatch)</option>
                </select>
                @error('movement_type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tồn kho *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('stock') border-red-500 @enderror">
                @error('stock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Image Update Section -->
            <div class="md:col-span-2 border-t pt-6 mt-2">
                <label class="block text-sm font-semibold text-gray-700 mb-4">Hình ảnh sản phẩm</label>
                
                <!-- Current Image -->
                <div class="mb-6 flex items-start gap-6 bg-gray-50 p-4 rounded-xl border border-dashed border-gray-300">
                    <div class="w-32 h-32 rounded-xl overflow-hidden border-2 border-gray-200 shadow-sm relative group bg-white">
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('images/products/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-white text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                            Hiện tại
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900 mb-1">Ảnh hiện tại</p>
                        <p class="text-xs text-gray-500 mb-3 break-all font-mono bg-white p-2 rounded border">{{ $product->image }}</p>
                        <p class="text-xs text-gray-400">Chọn tùy chọn bên dưới để thay đổi ảnh này.</p>
                    </div>
                </div>

                <!-- Selection Options -->
                <div class="flex flex-wrap gap-6 mb-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="image_type" value="keep" {{ old('image_type', 'keep') == 'keep' ? 'checked' : '' }} onclick="toggleImageType('keep')" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Giữ ảnh cũ</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="image_type" value="upload" {{ old('image_type') == 'upload' ? 'checked' : '' }} onclick="toggleImageType('upload')" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Tải ảnh mới</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="image_type" value="url" {{ old('image_type') == 'url' ? 'checked' : '' }} onclick="toggleImageType('url')" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Dùng URL mới</span>
                    </label>
                </div>

                <!-- Upload Input -->
                <div id="image-upload-input" class="{{ old('image_type') == 'upload' ? '' : 'hidden' }} transition-all">
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
                        <p class="text-sm font-semibold text-gray-700 mb-2">Xem trước ảnh mới:</p>
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
                        <p class="text-sm font-semibold text-gray-700 mb-2">Xem trước ảnh mới:</p>
                        <img id="url-preview" src="#" alt="Preview" class="h-48 rounded-lg shadow-md object-cover" onerror="this.src='https://via.placeholder.com/300?text=Invalid+Image+URL'">
                    </div>
                    @error('image_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ===== ẢNH THUMBNAIL PHỤ ===== --}}
            <div class="md:col-span-2 border-t pt-6 mt-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">🖼️ Ảnh thumbnail phụ</label>
                <p class="text-xs text-gray-500 mb-4">Ảnh phụ hiển thị bên dưới ảnh chính trong trang sản phẩm.</p>

                {{-- Hiển thị ảnh thumbnail hiện có --}}
                @if($product->images && count($product->images) > 0)
                <div class="mb-4 bg-gray-50 p-4 rounded-xl border border-dashed border-gray-300">
                    <p class="text-sm font-semibold text-gray-700 mb-3">Ảnh thumbnail hiện tại ({{ count($product->images) }} ảnh):</p>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($product->images as $thumb)
                        <div class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 relative group">
                            <img src="{{ $thumb }}" alt="Thumbnail" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white text-xs font-semibold">{{ $loop->iteration }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="mb-4 bg-gray-50 p-3 rounded-xl border border-dashed border-gray-300">
                    <p class="text-sm text-gray-500">Chưa có ảnh thumbnail phụ.</p>
                </div>
                @endif

                {{-- Toggle giữ hay thay thế --}}
                <div class="flex gap-6 mb-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="thumb_action" value="keep" checked onclick="toggleThumbAction('keep')"
                                   class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Giữ ảnh thumbnail cũ</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="radio" name="thumb_action" value="replace" onclick="toggleThumbAction('replace')"
                                   class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-purple-600 checked:bg-white transition-all">
                            <div class="absolute w-2.5 h-2.5 bg-purple-600 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <span class="group-hover:text-purple-600 transition font-medium">Thay ảnh thumbnail mới</span>
                    </label>
                </div>

                {{-- Form thay thumbnail (ẩn mặc định) --}}
                <div id="thumb-replace-section" class="hidden">
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

                    {{-- Preview thumbnails mới --}}
                    <div id="thumb-preview-container" class="mt-4 hidden">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Xem trước thumbnail mới:</p>
                        <div id="thumb-preview-grid" class="grid grid-cols-4 gap-3"></div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="md:col-span-2 border-t pt-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Mô tả</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-4 mt-8">
            <button type="submit" class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition">
                💾 Cập Nhật Sản Phẩm
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
        } else if (type === 'url') {
            uploadInput.classList.add('hidden');
            urlInput.classList.remove('hidden');
        } else {
            // Keep
            uploadInput.classList.add('hidden');
            urlInput.classList.add('hidden');
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
    
    // Check state on load
    document.addEventListener('DOMContentLoaded', function() {
        const checkedType = document.querySelector('input[name="image_type"]:checked').value;
        if (checkedType === 'url') {
            previewUrlImage();
        }
    });

    // === THUMBNAIL FUNCTIONS ===
    function toggleThumbAction(action) {
        const section = document.getElementById('thumb-replace-section');
        if (action === 'replace') {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    }

    function previewThumbFiles(input) {
        const grid = document.getElementById('thumb-preview-grid');
        const container = document.getElementById('thumb-preview-container');
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
            if (!document.querySelector('.thumb-file-preview')) {
                container.classList.add('hidden');
            }
        }
    }

</script>
@endpush
@endsection

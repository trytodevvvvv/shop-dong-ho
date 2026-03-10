@extends('layouts.main')

@section('title', $product->name . ' - WatchKing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-red-600">Trang chủ</a></li>
            <li>/</li>
            <li><a href="{{ route('products.index') }}" class="hover:text-red-600">Sản phẩm</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Product Image -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="bg-gray-50 rounded-xl aspect-square flex items-center justify-center mb-4 relative overflow-hidden group">
                <img id="mainProductImage"
                     src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('images/products/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>
            <div class="grid grid-cols-4 gap-2">
                @php
                    $thumbImages = $product->images ?? [];
                    // Nếu không có ảnh phụ, dùng ảnh chính làm 4 thumb
                    if (empty($thumbImages)) {
                        $mainImg = Str::startsWith($product->image, 'http') ? $product->image : asset('images/products/' . $product->image);
                        $thumbImages = array_fill(0, 4, $mainImg);
                    }
                @endphp
                @foreach($thumbImages as $idx => $thumb)
                <div class="bg-gray-50 rounded-lg aspect-square overflow-hidden cursor-pointer hover:ring-2 hover:ring-red-500 transition {{ $idx === 0 ? 'ring-2 ring-red-400' : '' }}"
                     onclick="switchMainImage('{{ $thumb }}', this)">
                    <img src="{{ $thumb }}" 
                         alt="Ảnh phụ {{ $idx + 1 }}"
                         class="w-full h-full object-cover hover:scale-110 transition duration-300">
                </div>
                @endforeach
            </div>
        </div>

        <!-- Product Info -->
        <div>
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-center gap-2 mb-3">
                    <span class="cellphones-red text-white px-3 py-1 rounded-full text-sm font-bold">{{ $product->brand }}</span>
                    @if($product->stock > 0)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">✓ Còn hàng</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">✗ Hết hàng</span>
                    @endif
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <!-- Price -->
                <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-xl p-6 mb-6">
                    @if($product->sale_price)
                        <div class="flex items-baseline gap-3 mb-2">
                            <p class="text-4xl font-bold text-red-600">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                            <p class="text-xl text-gray-500 line-through">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="discount-badge text-white px-3 py-1 rounded-full text-sm font-bold">
                                Giảm {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                            </span>
                            <span class="text-sm text-gray-600">Tiết kiệm: {{ number_format($product->price - $product->sale_price, 0, ',', '.') }}đ</span>
                        </div>
                    @else
                        <p class="text-4xl font-bold text-gray-900">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                    @endif
                </div>

                <!-- Promotions -->
                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 mb-6">
                    <h3 class="font-bold text-red-600 mb-3 flex items-center gap-2">
                        <span>🎁</span> Khuyến Mãi Đặc Biệt
                    </h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start gap-2">
                            <span class="text-red-600">✓</span>
                            <span>Trả góp 0% lãi suất qua thẻ tín dụng</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600">✓</span>
                            <span>Miễn phí vận chuyển toàn quốc</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600">✓</span>
                            <span>Bảo hành chính hãng 12 tháng</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600">✓</span>
                            <span>Đổi trả trong 7 ngày nếu có lỗi</span>
                        </li>
                    </ul>
                </div>

                <!-- Specifications -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h3 class="font-bold text-lg mb-4">📋 Thông Số Kỹ Thuật</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Thương hiệu</p>
                            <p class="font-semibold">{{ $product->brand }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Danh mục</p>
                            <p class="font-semibold">{{ $product->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Loại máy</p>
                            <p class="font-semibold">{{ $product->movement_type }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tình trạng</p>
                            <p class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? 'Còn ' . $product->stock . ' sản phẩm' : 'Hết hàng' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Add to Cart -->
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">
                        @csrf
                        <div class="flex items-center gap-4 mb-4">
                            <label class="font-semibold">Số lượng:</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="w-24 px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:outline-none text-center font-semibold">
                        </div>
                        <div class="space-y-3">
                            <!-- Buy Now Button -->
                            <button type="submit" formaction="{{ route('cart.buyNow', $product->id) }}" 
                                    class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg transition transform hover:scale-105">
                                ⚡ MUA NGAY
                            </button>
                            <!-- Add to Cart Button -->
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 border-2 border-red-600 text-red-600 py-4 rounded-xl font-bold text-lg hover:bg-red-50 transition">
                                    🛒 THÊM VÀO GIỎ HÀNG
                                </button>
                                <button type="button" class="px-6 border-2 border-red-600 text-red-600 rounded-xl hover:bg-red-50 transition">
                                    ❤️
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-400 text-white py-4 rounded-xl font-bold text-lg cursor-not-allowed">
                        HẾT HÀNG
                    </button>
                @endif
            </div>

            <!-- Description -->
            @if($product->description)
                <div class="bg-white rounded-2xl shadow-lg p-8 mt-6">
                    <h3 class="font-bold text-xl mb-4">📝 Mô Tả Sản Phẩm</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span>🔥</span> Sản Phẩm Liên Quan
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedProducts as $related)
                    <div class="bg-gray-50 rounded-xl overflow-hidden hover-scale group">
                        <a href="{{ route('products.show', $related->slug) }}">
                            <div class="aspect-square bg-gray-100 flex items-center justify-center relative overflow-hidden group-hover:shadow-lg transition">
                                <img src="{{ Str::startsWith($related->image, 'http') ? $related->image : asset('images/products/' . $related->image) }}" 
                                     alt="{{ $related->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            </div>
                            <div class="p-3">
                                <p class="text-xs text-red-600 font-semibold mb-1">{{ $related->brand }}</p>
                                <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2">{{ $related->name }}</h3>
                                <p class="text-lg font-bold text-red-600">{{ number_format($related->sale_price ?? $related->price, 0, ',', '.') }}đ</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<script>
function switchMainImage(src, el) {
    document.getElementById('mainProductImage').src = src;
    // Bỏ ring của tất cả thumbnails
    document.querySelectorAll('[onclick^="switchMainImage"]').forEach(function(item) {
        item.classList.remove('ring-2', 'ring-red-400');
    });
    el.classList.add('ring-2', 'ring-red-400');
}
</script>
@endsection

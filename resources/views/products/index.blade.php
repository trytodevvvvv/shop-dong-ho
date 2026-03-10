@extends('layouts.main')

@section('title', 'Sản Phẩm - WatchKing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-red-600">Trang chủ</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">Sản phẩm</li>
        </ol>
    </nav>

    <div class="flex gap-6">
        <!-- Sidebar Filters -->
        <div class="w-64 flex-shrink-0 hidden lg:block">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4 pb-3 border-b">📂 Danh Mục</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-red-50 transition {{ !request('category') ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            <span>⌚</span>
                            <span>Tất cả</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('category') == $category->id ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                                <span>
                                    @if($category->id == 1) 👨
                                    @elseif($category->id == 2) 👩
                                    @elseif($category->id == 3) ⚙️
                                    @elseif($category->id == 4) 📱
                                    @else ⚽
                                    @endif
                                </span>
                                <span>{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Price Filter -->
                <h3 class="font-bold text-lg mt-6 mb-4 pb-3 border-b">💰 Mức Giá</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('price_range'), ['price_range' => '0-5000000'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('price_range') == '0-5000000' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Dưới 5 triệu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('price_range'), ['price_range' => '5000000-10000000'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('price_range') == '5000000-10000000' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            5 - 10 triệu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('price_range'), ['price_range' => '10000000-50000000'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('price_range') == '10000000-50000000' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            10 - 50 triệu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('price_range'), ['price_range' => '50000000-999999999'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('price_range') == '50000000-999999999' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Trên 50 triệu
                        </a>
                    </li>
                </ul>

                <!-- Brand Filter -->
                <h3 class="font-bold text-lg mt-6 mb-4 pb-3 border-b">🏷️ Thương Hiệu</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('brand'), [])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ !request('brand') ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Tất cả thương hiệu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('brand'), ['brand' => 'Rolex'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('brand') == 'Rolex' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Rolex
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('brand'), ['brand' => 'Omega'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('brand') == 'Omega' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Omega
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('brand'), ['brand' => 'Casio'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('brand') == 'Casio' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Casio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('brand'), ['brand' => 'Seiko'])) }}" 
                           class="block px-3 py-2 rounded-lg hover:bg-red-50 transition {{ request('brand') == 'Seiko' ? 'bg-red-50 text-red-600 font-semibold' : 'text-gray-700' }}">
                            Seiko
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="flex-1">
            <!-- Search & Sort Bar -->
            <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                <div class="flex items-center justify-between gap-4">
                    <form method="GET" action="{{ route('products.index') }}" class="flex-1">
                        <div class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Tìm kiếm sản phẩm..." 
                                   class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:outline-none">
                            <button type="submit" class="cellphones-red text-white px-6 py-2 rounded-lg hover:bg-red-700 transition font-medium">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>
                    <select class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:outline-none">
                        <option>Sắp xếp: Mới nhất</option>
                        <option>Giá: Thấp đến cao</option>
                        <option>Giá: Cao đến thấp</option>
                        <option>Bán chạy nhất</option>
                    </select>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products as $index => $product)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale relative group"
                             data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                            <!-- Discount Badge -->
                            @if($product->sale_price)
                                <div class="absolute top-2 left-2 discount-badge text-white px-3 py-1 rounded-full text-sm font-bold z-10 transition-transform duration-300 group-hover:scale-110">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </div>
                            @endif

                            <!-- Hot Badge -->
                            <div class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded text-xs font-bold z-10 animate-pulse">
                                🔥 HOT
                            </div>

                            <a href="{{ route('products.show', $product->slug) }}">
                                <div class="aspect-square bg-gray-100 flex items-center justify-center relative overflow-hidden group-hover:shadow-lg transition">
                                    <div class="absolute inset-0 bg-black/5 group-hover:bg-transparent transition duration-300 z-10"></div>
                                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('images/products/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 group-hover:-rotate-1 transition-all duration-500">
                                </div>
                                <div class="p-3">
                                    <p class="text-xs text-red-600 font-semibold mb-1">{{ $product->brand }}</p>
                                    <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-red-600 transition-colors">{{ $product->name }}</h3>
                                    
                                    <div class="mb-2 min-h-[2.75rem]">
                                        @if($product->sale_price)
                                            <p class="text-lg font-bold text-red-600">{{ number_format($product->sale_price, 0, ',', '.') }}đ</p>
                                            <p class="text-xs text-gray-500 line-through">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                        @else
                                            <p class="text-lg font-bold text-gray-900">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                            <p class="text-xs invisible">0đ</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-1 mb-2">
                                        <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider">Trả góp 0%</span>
                                        <span class="bg-gray-50 text-gray-700 border border-gray-200 text-[10px] px-2 py-0.5 rounded uppercase tracking-wider">{{ $product->movement_type }}</span>
                                    </div>

                                    @if($product->stock > 0)
                                        <div class="text-[11px] text-green-600 font-bold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Còn {{ $product->stock }} sản phẩm
                                        </div>
                                    @else
                                        <div class="text-[11px] text-red-600 font-bold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Hết hàng
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Không tìm thấy sản phẩm</h3>
                    <p class="text-gray-600 mb-6">Hãy thử tìm kiếm với từ khóa khác</p>
                    <a href="{{ route('products.index') }}" class="cellphones-red text-white px-6 py-3 rounded-lg inline-block hover:bg-red-700 transition">
                        Xem tất cả sản phẩm
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

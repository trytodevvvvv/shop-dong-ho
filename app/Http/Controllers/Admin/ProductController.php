<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|string|max:255',
            'brand'         => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'sale_price'    => 'nullable|numeric|min:0',
            'description'   => 'nullable|string',
            'movement_type' => 'required|string',
            'stock'         => 'required|integer|min:0',
            'image_type'    => 'required|in:upload,url',
            'image_file'    => 'nullable|required_if:image_type,upload|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url'     => 'nullable|required_if:image_type,url|url',
            'thumb_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumb_urls'    => 'nullable|string',
        ], [
            'image_file.required_if' => 'Vui lòng chọn ảnh để tải lên.',
            'image_url.required_if'  => 'Vui lòng nhập đường dẫn ảnh.',
        ]);

        $validated['slug'] = Str::slug($request->name);

        // Handle Main Image
        if ($request->image_type === 'upload' && $request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $validated['image'] = $filename;
        } elseif ($request->image_type === 'url') {
            $validated['image'] = $request->image_url;
        } else {
            $validated['image'] = 'placeholder.jpg';
        }

        // Handle Thumbnail Images
        $thumbImages = $this->processThumbImages($request);
        if (!empty($thumbImages)) {
            $validated['images'] = $thumbImages;
        }

        unset($validated['image_type'], $validated['image_file'], $validated['image_url'],
              $validated['thumb_files'], $validated['thumb_urls']);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Đã thêm sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|string|max:255',
            'brand'         => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'sale_price'    => 'nullable|numeric|min:0',
            'description'   => 'nullable|string',
            'movement_type' => 'required|string',
            'stock'         => 'required|integer|min:0',
            'image_type'    => 'required|in:keep,upload,url',
            'image_file'    => 'nullable|required_if:image_type,upload|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url'     => 'nullable|required_if:image_type,url|url',
            'thumb_action'  => 'nullable|in:keep,replace',
            'thumb_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumb_urls'    => 'nullable|string',
        ], [
            'image_file.required_if' => 'Vui lòng chọn ảnh để tải lên.',
            'image_url.required_if'  => 'Vui lòng nhập đường dẫn ảnh.',
        ]);

        $validated['slug'] = Str::slug($request->name);

        // Handle Main Image
        if ($request->image_type === 'upload' && $request->hasFile('image_file')) {
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                @unlink(public_path('images/products/' . $product->image));
            }
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $validated['image'] = $filename;
        } elseif ($request->image_type === 'url') {
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                @unlink(public_path('images/products/' . $product->image));
            }
            $validated['image'] = $request->image_url;
        } else {
            unset($validated['image']);
        }

        // Handle Thumbnail Images
        $thumbAction = $request->input('thumb_action', 'keep');
        if ($thumbAction === 'replace') {
            $thumbImages = $this->processThumbImages($request);
            $validated['images'] = !empty($thumbImages) ? $thumbImages : null;
        } else {
            unset($validated['images']);
        }

        unset($validated['image_type'], $validated['image_file'], $validated['image_url'],
              $validated['thumb_action'], $validated['thumb_files'], $validated['thumb_urls']);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm thành công!');
    }

    /**
     * Xử lý ảnh thumbnail: upload file và/hoặc URL
     */
    private function processThumbImages(Request $request): array
    {
        $thumbImages = [];

        // Đảm bảo thư mục thumbs tồn tại
        $thumbDir = public_path('images/products/thumbs');
        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        // Upload files
        if ($request->hasFile('thumb_files')) {
            foreach ($request->file('thumb_files') as $thumbFile) {
                $thumbName = 'thumb_' . time() . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
                $thumbFile->move($thumbDir, $thumbName);
                $thumbImages[] = asset('images/products/thumbs/' . $thumbName);
            }
        }

        // URLs (mỗi dòng một URL)
        if ($request->filled('thumb_urls')) {
            $urls = array_filter(array_map('trim', explode("\n", $request->thumb_urls)));
            foreach ($urls as $url) {
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    $thumbImages[] = $url;
                }
            }
        }

        return $thumbImages;
    }
}

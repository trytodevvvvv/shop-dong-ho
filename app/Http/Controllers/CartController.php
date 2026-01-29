<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Check if user is admin
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return redirect()->route('home')->with('error', 'Tài khoản Admin không thể truy cập giỏ hàng!');
        }

        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $productId)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
        }

        // Check if user is admin
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tài khoản Admin không thể mua hàng. Vui lòng sử dụng tài khoản khách hàng!');
        }

        $product = Product::findOrFail($productId);
        
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng.');
        }

        $quantity = $request->input('quantity', 1);

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'slug' => $product->slug,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function buyNow(Request $request, $productId)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng!');
        }

        // Check if user is admin
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tài khoản Admin không thể mua hàng. Vui lòng sử dụng tài khoản khách hàng!');
        }

        $product = Product::findOrFail($productId);
        
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng.');
        }

        $quantity = $request->input('quantity', 1);

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'slug' => $product->slug,
            ];
        }

        session()->put('cart', $cart);

        // Redirect directly to checkout
        return redirect()->route('checkout.index')->with('success', 'Đã thêm vào giỏ hàng! Vui lòng hoàn tất đơn hàng.');
    }

    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $quantity = $request->input('quantity', 1);
            $product = Product::find($productId);

            if ($product && $quantity <= $product->stock) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng!');
            } else {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho.');
            }
        }

        return redirect()->route('cart.index');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }
}

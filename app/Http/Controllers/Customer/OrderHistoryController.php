<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())->with('orderItems.product');

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['pending', 'shipping', 'completed', 'cancelled'])) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        // Count by status
        $statusCounts = [
            'all' => Order::where('user_id', Auth::id())->count(),
            'pending' => Order::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'shipping' => Order::where('user_id', Auth::id())->where('status', 'shipping')->count(),
            'completed' => Order::where('user_id', Auth::id())->where('status', 'completed')->count(),
            'cancelled' => Order::where('user_id', Auth::id())->where('status', 'cancelled')->count(),
        ];

        return view('customer.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        $order->load('orderItems.product', 'user');

        return view('customer.orders.show', compact('order'));
    }
}

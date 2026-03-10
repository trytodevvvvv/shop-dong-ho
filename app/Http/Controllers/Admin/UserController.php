<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && in_array($request->role, ['admin', 'customer'])) {
            $query->where('role', $request->role);
        }

        // Search by name or email
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->orderBy('role', 'asc')->latest()->paginate(20);
        
        // Count by role
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();

        return view('admin.users.index', compact('users', 'adminCount', 'customerCount'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,customer'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Đã tạo tài khoản thành công!');
    }

    public function show(User $user)
    {
        /** @var \App\Models\User $user */
        $user->load('orders');
        
        $orders = $user->orders;
        $orderStats = [
            'total' => $orders->count(),
            'pending' => $orders->where('status', 'pending')->count(),
            'shipping' => $orders->where('status', 'shipping')->count(),
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
            'total_spent' => $orders->where('status', 'completed')->sum('total'),
        ];

        return view('admin.users.show', compact('user', 'orderStats'));
    }

    public function updateRole(Request $request, User $user)
    {
        /** @var \App\Models\User $user */
        $validated = $request->validate([
            'role' => 'required|in:admin,customer'
        ]);

        // Prevent changing own role
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Bạn không thể thay đổi quyền của chính mình!');
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Đã cập nhật quyền người dùng!');
    }

    public function destroy(User $user)
    {
        /** @var \App\Models\User $user */
        // Prevent deleting own account
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Bạn không thể xóa tài khoản của chính mình!');
        }

        // Check if user has orders
        if ($user->orders()->count() > 0) {
            return redirect()->back()->with('error', 'Không thể xóa người dùng có đơn hàng!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Đã xóa người dùng!');
    }
}

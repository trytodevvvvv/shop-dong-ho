@extends('layouts.admin')

@section('page-title', 'Quản Lý Người Dùng')
@section('page-subtitle', 'Danh sách tài khoản Admin & Khách hàng')

@section('header-actions')
    <a href="{{ route('admin.users.create') }}" 
       class="bg-white text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-purple-50 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tạo Tài Khoản
    </a>
@endsection

@section('content')
<!-- Search & Filter Bar -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Tìm kiếm theo tên hoặc email..." 
               class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none">
        <button type="submit" class="bg-purple-600 text-white px-8 py-3 rounded-xl hover:bg-purple-700 transition font-semibold">
            🔍 Tìm kiếm
        </button>
        @if(request('search') || request('role'))
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-300 transition font-semibold">
                ✕ Xóa lọc
            </a>
        @endif
    </form>
</div>

<!-- Tabs -->
<div class="bg-white rounded-2xl shadow-lg mb-6">
    <div class="flex border-b border-gray-200">
        <a href="{{ route('admin.users.index') }}" 
           class="flex-1 px-6 py-4 text-center font-semibold transition {{ !request('role') ? 'text-purple-600 border-b-2 border-purple-600 bg-purple-50' : 'text-gray-600 hover:bg-gray-50' }}">
            👥 Tất cả ({{ $adminCount + $customerCount }})
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
           class="flex-1 px-6 py-4 text-center font-semibold transition {{ request('role') === 'admin' ? 'text-purple-600 border-b-2 border-purple-600 bg-purple-50' : 'text-gray-600 hover:bg-gray-50' }}">
            👨‍💼 Admin ({{ $adminCount }})
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'customer']) }}" 
           class="flex-1 px-6 py-4 text-center font-semibold transition {{ request('role') === 'customer' ? 'text-purple-600 border-b-2 border-purple-600 bg-purple-50' : 'text-gray-600 hover:bg-gray-50' }}">
            🛍️ Khách hàng ({{ $customerCount }})
        </a>
    </div>
</div>

<!-- Users Table -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    @if($users->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">ID</th>
                        <th class="px-6 py-4 text-left font-semibold">Tên</th>
                        <th class="px-6 py-4 text-left font-semibold">Email</th>
                        <th class="px-6 py-4 text-left font-semibold">Quyền</th>
                        <th class="px-6 py-4 text-left font-semibold">Ngày tạo</th>
                        <th class="px-6 py-4 text-center font-semibold">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">#{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">👨‍💼 Admin</span>
                                @else
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">🛍️ Khách hàng</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.show', $user) }}" 
                                       class="bg-purple-100 text-purple-700 px-4 py-2 rounded-lg hover:bg-purple-200 transition font-semibold text-sm">
                                        👁️ Xem
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 transition font-semibold text-sm">
                                                🗑️ Xóa
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Không tìm thấy người dùng</h3>
            <p class="text-gray-600">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm</p>
        </div>
    @endif
</div>
@endsection

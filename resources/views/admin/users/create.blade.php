@extends('layouts.admin')

@section('title', 'Tạo Tài Khoản Mới')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)] p-6">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-2xl">
        <!-- Header -->
        <div class="mb-8 text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Tạo Tài Khoản Mới</h2>
            <p class="text-gray-600">Thêm người dùng mới vào hệ thống</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-900 mb-2">
                    Họ và tên <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       required
                       placeholder="Nguyễn Văn A"
                       class="w-full px-4 py-3 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:bg-white focus:outline-none transition @error('name') border-red-500 bg-red-50 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       required
                       placeholder="email@example.com"
                       class="w-full px-4 py-3 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:bg-white focus:outline-none transition @error('email') border-red-500 bg-red-50 @enderror">
                @error('email')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-900 mb-2">
                    Mật khẩu <span class="text-red-500">*</span>
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       placeholder="••••••••"
                       class="w-full px-4 py-3 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:bg-white focus:outline-none transition @error('password') border-red-500 bg-red-50 @enderror">
                @error('password')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-gray-600">Tối thiểu 8 ký tự</p>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-2">
                    Xác nhận mật khẩu <span class="text-red-500">*</span>
                </label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required
                       placeholder="••••••••"
                       class="w-full px-4 py-3 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:bg-white focus:outline-none transition">
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-bold text-gray-900 mb-2">
                    Vai trò <span class="text-red-500">*</span>
                </label>
                <select id="role" 
                        name="role" 
                        required
                        class="w-full px-4 py-3 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:bg-white focus:outline-none transition cursor-pointer @error('role') border-red-500 bg-red-50 @enderror">
                    <option value="" class="text-gray-500">-- Chọn vai trò --</option>
                    <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }} class="text-gray-900">👤 Khách hàng</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }} class="text-gray-900">👑 Quản trị viên</option>
                </select>
                @error('role')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-4 rounded-xl font-bold hover:from-purple-700 hover:to-purple-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    ✅ Tạo Tài Khoản
                </button>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex-1 bg-gray-100 text-gray-700 px-6 py-4 rounded-xl font-bold hover:bg-gray-200 transition text-center border-2 border-gray-300">
                    ❌ Hủy
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


@extends('layouts.main')

@section('title', 'Đăng Nhập - WatchKing')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="cellphones-red w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-white text-4xl font-bold">W</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Đăng Nhập</h2>
            <p class="text-gray-600">Chào mừng bạn quay trở lại WatchKing!</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none transition @error('email') border-red-500 @enderror"
                           placeholder="admin@watchking.vn">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mật khẩu</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none transition @error('password') border-red-500 @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="ml-2 text-sm text-gray-700">Ghi nhớ đăng nhập</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full cellphones-red text-white py-4 rounded-xl font-bold text-lg hover:bg-red-700 transition transform hover:scale-105 mb-4">
                    🔐 ĐĂNG NHẬP
                </button>

                <!-- Register Link -->
                <p class="text-center text-gray-600">
                    Chưa có tài khoản? 
                    <a href="{{ route('register') }}" class="text-red-600 hover:text-red-800 font-semibold">
                        Đăng ký ngay
                    </a>
                </p>
            </form>

            <!-- Demo Accounts -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm font-semibold text-gray-700 mb-3">🔑 Tài khoản demo:</p>
                <div class="space-y-2 text-xs">
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3">
                        <p class="font-semibold text-purple-700">👑 Admin</p>
                        <p class="text-gray-600">Email: admin@watchking.vn</p>
                        <p class="text-gray-600">Password: password</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <p class="font-semibold text-blue-700">👤 Khách hàng</p>
                        <p class="text-gray-600">Email: customer@example.com</p>
                        <p class="text-gray-600">Password: password</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                ← Quay lại trang chủ
            </a>
        </div>
    </div>
</div>
@endsection

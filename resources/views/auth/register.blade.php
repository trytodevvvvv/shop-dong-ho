@extends('layouts.main')

@section('title', 'Đăng Ký - WatchKing')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="cellphones-red w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-white text-4xl font-bold">W</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Đăng Ký</h2>
            <p class="text-gray-600">Tạo tài khoản mới tại WatchKing</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none transition @error('name') border-red-500 @enderror"
                           placeholder="Nguyễn Văn A">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none transition @error('email') border-red-500 @enderror"
                           placeholder="email@example.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mật khẩu</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none transition @error('password') border-red-500 @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Xác nhận mật khẩu</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-red-500 focus:outline-none transition"
                           placeholder="••••••••">
                </div>

                <!-- Terms -->
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" required class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mt-1">
                        <span class="ml-2 text-sm text-gray-700">
                            Tôi đồng ý với 
                            <a href="#" class="text-red-600 hover:text-red-800 font-medium">Điều khoản dịch vụ</a> 
                            và 
                            <a href="#" class="text-red-600 hover:text-red-800 font-medium">Chính sách bảo mật</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full cellphones-red text-white py-4 rounded-xl font-bold text-lg hover:bg-red-700 transition transform hover:scale-105 mb-4">
                    ✨ TẠO TÀI KHOẢN
                </button>

                <!-- Login Link -->
                <p class="text-center text-gray-600">
                    Đã có tài khoản? 
                    <a href="{{ route('login') }}" class="text-red-600 hover:text-red-800 font-semibold">
                        Đăng nhập ngay
                    </a>
                </p>
            </form>

            <!-- Benefits -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm font-semibold text-gray-700 mb-3">🎁 Quyền lợi thành viên:</p>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li class="flex items-center gap-2">
                        <span class="text-red-600">✓</span>
                        <span>Tích điểm mỗi đơn hàng</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-red-600">✓</span>
                        <span>Ưu đãi độc quyền cho thành viên</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-red-600">✓</span>
                        <span>Theo dõi đơn hàng dễ dàng</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-red-600">✓</span>
                        <span>Hỗ trợ trả góp 0% lãi suất</span>
                    </li>
                </ul>
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

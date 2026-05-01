@extends('layouts.app')

@section('title', 'Login - Amelia Hantaran')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="w-full max-w-md px-4">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-block">
                        <span class="font-display text-3xl font-bold text-primary-600">Amelia</span>
                        <span class="font-display text-xl text-gray-600">Hantaran</span>
                    </a>
                    <p class="text-gray-500 mt-2">Masuk ke akun Anda</p>
                </div>

                <!-- Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               required autofocus>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-700">
                            Lupa password?
                        </a>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-500 text-white py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        Masuk
                    </button>
                </form>

                <!-- Register Link -->
                <p class="text-center text-gray-600 mt-6">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-primary-600 font-medium hover:text-primary-700">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>
    </section>
@endsection

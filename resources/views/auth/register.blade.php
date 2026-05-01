@extends('layouts.app')

@section('title', 'Register - Amelia Hantaran')

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
                    <p class="text-gray-500 mt-2">Buat akun baru</p>
                </div>

                <!-- Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               required autofocus>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')
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
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               required>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-500 text-white py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors mt-6">
                        Daftar
                    </button>
                </form>

                <!-- Login Link -->
                <p class="text-center text-gray-600 mt-6">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary-600 font-medium hover:text-primary-700">
                        Masuk
                    </a>
                </p>
            </div>
        </div>
    </section>
@endsection

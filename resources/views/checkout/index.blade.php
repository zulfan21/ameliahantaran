@extends('layouts.app')

@section('title', 'Checkout - Amelia Hantaran')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Checkout
            </h1>
            <p class="text-gray-600">
                Lengkapi data Anda untuk melanjutkan pemesanan
            </p>
        </div>
    </section>

    <!-- Checkout Form -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Customer Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Shipping Info -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6">
                            <h2 class="font-semibold text-lg text-gray-900 mb-4 flex items-center">
                                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center text-sm mr-3">1</span>
                                Informasi Pengiriman
                            </h2>
                            
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" 
                                           name="customer_name" 
                                           id="customer_name" 
                                           value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('customer_name') border-red-500 @enderror"
                                           required>
                                    @error('customer_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" 
                                           name="customer_email" 
                                           id="customer_email" 
                                           value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('customer_email') border-red-500 @enderror"
                                           required>
                                    @error('customer_email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                                    <input type="tel" 
                                           name="customer_phone" 
                                           id="customer_phone" 
                                           value="{{ old('customer_phone', auth()->user()->phone ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror"
                                           required>
                                    @error('customer_phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                    <textarea name="customer_address" 
                                              id="customer_address" 
                                              rows="3"
                                              class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('customer_address') border-red-500 @enderror"
                                              required>{{ old('customer_address', auth()->user()->address ?? '') }}</textarea>
                                    @error('customer_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes" 
                                              id="notes" 
                                              rows="2"
                                              class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                              placeholder="Contoh: Warna tema pernikahan, permintaan khusus, dll.">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Order Items -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6">
                            <h2 class="font-semibold text-lg text-gray-900 mb-4 flex items-center">
                                <span class="w-8 h-8 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center text-sm mr-3">2</span>
                                Pesanan Anda
                            </h2>
                            
                            <div class="space-y-4">
                                @foreach($cart as $item)
                                    <div class="flex items-center gap-4 py-3 border-b border-gray-100 last:border-0">
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                                 alt="{{ $item['name'] }}" 
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=100&h=100&fit=crop'">
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">{{ $item['name'] }}</h4>
                                            <p class="text-sm text-gray-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        </div>
                                        <span class="font-semibold text-gray-900">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-xl p-6 sticky top-24">
                            <h3 class="font-semibold text-lg text-gray-900 mb-4">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Ongkir</span>
                                    <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-gray-900">Total</span>
                                    <span class="text-xl font-bold text-primary-600">
                                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            
                            <button type="submit" class="block w-full bg-primary-500 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                                Buat Pesanan
                            </button>
                            
                            <p class="text-center text-sm text-gray-500 mt-4">
                                Dengan melanjutkan, Anda menyetujui <a href="#" class="text-primary-600 hover:underline">Syarat & Ketentuan</a> kami.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

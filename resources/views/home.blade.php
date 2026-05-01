@extends('layouts.app')

@section('title', 'Amelia Hantaran - Make Your Wedding Hantaran Truly Special')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-cream-100 via-white to-primary-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div class="text-center lg:text-left">
                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Make Your <br>
                        <span class="text-primary-600">Wedding Hantaran</span><br>
                        Truly Special
                    </h1>
                    <p class="text-gray-600 text-lg mb-8 max-w-lg mx-auto lg:mx-0">
                        {{ $settings['company_description'] ?? 'Elegant hantaran decoration, premium rental boxes, and complete seserahan packages for your unforgettable wedding moment.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i>
                            Lihat Katalog
                        </a>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281234567890' }}" target="_blank"
                            class="inline-flex items-center justify-center px-8 py-4 border-2 border-primary-500 text-primary-500 font-semibold rounded-lg hover:bg-primary-500 hover:text-white transition-all duration-300">
                            <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                            Konsultasi
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop"
                            alt="Wedding Hantaran" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-primary-200 rounded-full opacity-50 blur-2xl"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-secondary-200 rounded-full opacity-50 blur-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih <span class="text-primary-600">Kami?</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan pelayanan terbaik untuk momen spesial Anda
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6 rounded-xl bg-cream-50 hover:bg-primary-50 transition-colors duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="gem" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-xl text-gray-900 mb-2">Kualitas Premium</h3>
                    <p class="text-gray-600 text-sm">Material berkualitas tinggi dengan sentuhan artisan yang elegan</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6 rounded-xl bg-cream-50 hover:bg-primary-50 transition-colors duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="palette" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-xl text-gray-900 mb-2">Custom Design</h3>
                    <p class="text-gray-600 text-sm">Desain dapat disesuaikan dengan tema dan keinginan Anda</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6 rounded-xl bg-cream-50 hover:bg-primary-50 transition-colors duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="truck" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-xl text-gray-900 mb-2">Pengiriman Aman</h3>
                    <p class="text-gray-600 text-sm">Packing rapi dan pengiriman tepat waktu ke lokasi Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-12">
                <div class="text-center sm:text-left mb-6 sm:mb-0">
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-2">
                        Produk <span class="text-primary-600">Unggulan</span>
                    </h2>
                    <p class="text-gray-600">Pilihan terbaik untuk hantaran pernikahan Anda</p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                    Lihat Semua
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Kategori <span class="text-primary-600">Produk</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan berbagai pilihan hantaran sesuai kebutuhan Anda
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}"
                        class="group relative overflow-hidden rounded-xl aspect-square">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-primary-500 to-primary-700 transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4">
                            <i data-lucide="{{ $category->icon ?? 'gift' }}" class="w-12 h-12 mb-3"></i>
                            <h3 class="font-semibold text-lg text-center">{{ $category->name }}</h3>
                            <span class="text-sm text-primary-100 mt-1">{{ $category->products_count }} Produk</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-primary-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Apa Kata <span class="text-primary-600">Mereka?</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Testimoni dari pelanggan yang telah mempercayakan momen spesial mereka kepada kami
                </p>
            </div>

            @if ($testimonials->count() > 0)
                <div class="swiper testimoniSwiper !pb-16">
                    <div class="swiper-wrapper items-stretch">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide !h-auto">
                                <div
                                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 h-full flex flex-col">
                                    <div class="flex items-center mb-4">
                                        <div class="flex text-secondary-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i data-lucide="star"
                                                    class="w-5 h-5 {{ $i <= $testimonial->rating ? 'fill-current' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-6 italic line-clamp-4">"{{ $testimonial->content }}"</p>
                                    <div class="flex items-center mt-auto pt-4 border-t border-gray-50">
                                        <div
                                            class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <span
                                                class="text-primary-600 font-semibold">{{ substr($testimonial->customer_name ?? 'P', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-sm">
                                                {{ $testimonial->customer_name ?? 'Pelanggan' }}</h4>
                                            @if ($testimonial->wedding_date)
                                                <p class="text-xs text-gray-500">{{ $testimonial->wedding_date }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-pagination !bottom-0"></div>
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada testimoni.</p>
            @endif
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".testimoniSwiper", {
                slidesPerView: 1, // Tampil 1 card di HP
                spaceBetween: 30, // Jarak antar card
                loop: true, // Infinite loop (bergeser tanpa batas)
                autoplay: {
                    delay: 3000, // Waktu tunggu sebelum geser (3000ms = 3 detik)
                    disableOnInteraction: false, // Tetap geser otomatis walau sudah disentuh user
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2, // Tampil 2 card di Tablet
                    },
                    1024: {
                        slidesPerView: 3, // Tampil 3 card di Desktop
                    },
                },
                on: {
                    // Script ini untuk memastikan icon Lucide tetap muncul saat card digeser/didikloning
                    init: function() {
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    },
                    slideChangeTransitionEnd: function() {
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }
                }
            });
        });
    </script>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-500 to-primary-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mb-4">
                Siap Membuat Momen Spesial Anda?
            </h2>
            <p class="text-primary-100 text-lg mb-8">
                Hubungi kami sekarang untuk konsultasi gratis dan penawaran terbaik
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281234567890' }}" target="_blank"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg">
                    <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                    Chat WhatsApp
                </a>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-600 transition-all duration-300">
                    <i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i>
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>
@endsection

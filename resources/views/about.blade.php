@extends('layouts.app')

@section('title', 'Tentang Kami - Amelia Hantaran')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                Tentang <span class="text-primary-600">Kami</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Mengenal lebih dekat Amelia Hantaran dan komitmen kami untuk momen spesial Anda
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop" 
                             alt="About Amelia Hantaran" 
                             class="w-full h-auto">
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-primary-100 rounded-full -z-10"></div>
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-secondary-100 rounded-full -z-10"></div>
                </div>
                
                <!-- Content -->
                <div>
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wide">Our Story</span>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mt-2 mb-6">
                        Mewujudkan Hantaran Impian Anda
                    </h2>
                    <div class="space-y-4 text-gray-600">
                        <p>
                            Amelia Hantaran didirikan dengan passion untuk membantu pasangan mempersiapkan momen spesial mereka. Kami memahami betapa pentingnya seserahan dalam tradisi pernikahan Indonesia, dan kami berkomitmen untuk memberikan yang terbaik.
                        </p>
                        <p>
                            Dengan pengalaman lebih dari 5 tahun dalam industri wedding, kami telah melayani ratusan pasangan dan membantu mereka menciptakan kenangan indah yang tak terlupakan.
                        </p>
                        <p>
                            Setiap hantaran yang kami buat dirancang dengan cinta dan perhatian pada detail, menggunakan material berkualitas tinggi dan desain yang elegan.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-6 mt-8">
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-primary-600">500+</span>
                            <span class="text-sm text-gray-500">Pelanggan Puas</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-primary-600">5+</span>
                            <span class="text-sm text-gray-500">Tahun Pengalaman</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-primary-600">50+</span>
                            <span class="text-sm text-gray-500">Desain Unik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-16 bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Vision -->
                <div class="bg-white rounded-xl p-8 shadow-sm">
                    <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-6">
                        <i data-lucide="eye" class="w-7 h-7 text-primary-600"></i>
                    </div>
                    <h3 class="font-display text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600">
                        Menjadi penyedia hantaran pernikahan terdepan di Indonesia yang dikenal karena kualitas, kreativitas, dan pelayanan prima, serta menjadi bagian dari setiap momen bahagia pasangan Indonesia.
                    </p>
                </div>
                
                <!-- Mission -->
                <div class="bg-white rounded-xl p-8 shadow-sm">
                    <div class="w-14 h-14 bg-secondary-100 rounded-lg flex items-center justify-center mb-6">
                        <i data-lucide="target" class="w-7 h-7 text-secondary-600"></i>
                    </div>
                    <h3 class="font-display text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-500 mr-3 flex-shrink-0 mt-0.5"></i>
                            <span>Menyediakan produk hantaran berkualitas premium dengan harga terjangkau</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-500 mr-3 flex-shrink-0 mt-0.5"></i>
                            <span>Memberikan pelayanan personal yang memahami kebutuhan setiap pelanggan</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-500 mr-3 flex-shrink-0 mt-0.5"></i>
                            <span>Terus berinovasi dalam desain dan layanan untuk mengikuti tren terkini</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-500 mr-3 flex-shrink-0 mt-0.5"></i>
                            <span>Membangun hubungan jangka panjang dengan pelanggan berdasarkan kepercayaan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Nilai-Nilai <span class="text-primary-600">Kami</span>
                </h2>
            </div>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="heart" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">Passion</h3>
                    <p class="text-gray-600 text-sm">Mengerjakan setiap hantaran dengan cinta dan dedikasi</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="award" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">Kualitas</h3>
                    <p class="text-gray-600 text-sm">Menggunakan material terbaik untuk hasil sempurna</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="users" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">Customer First</h3>
                    <p class="text-gray-600 text-sm">Kepuasan pelanggan adalah prioritas utama kami</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="lightbulb" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">Inovasi</h3>
                    <p class="text-gray-600 text-sm">Selalu mengembangkan desain dan layanan baru</p>
                </div>
            </div>
        </div>
    </section>
@endsection

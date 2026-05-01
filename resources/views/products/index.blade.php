@extends('layouts.app')

@section('title', 'Katalog Produk - Amelia Hantaran')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Katalog <span class="text-primary-600">Produk</span>
            </h1>
            <p class="text-gray-600 max-w-2xl">
                Temukan berbagai pilihan hantaran pernikahan elegan dan berkualitas
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <!-- Search -->
                <form action="{{ route('products.index') }}" method="GET" class="w-full md:w-auto">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari produk..." 
                               class="w-full md:w-80 pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    </div>
                </form>
                
                <!-- Category Filter & Sort -->
                <div class="flex flex-wrap gap-3 w-full md:w-auto">
                    <!-- Category Dropdown -->
                    <select name="category" 
                            onchange="window.location.href = this.value ? '?category=' + this.value : '{{ route('products.index') }}'"
                            class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <!-- Sort Dropdown -->
                    <select name="sort" 
                            onchange="window.location.href = '?sort=' + this.value + '{{ request('category') ? '&category=' . request('category') : '' }}{{ request('search') ? '&search=' . request('search') : '' }}'"
                            class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
                    </select>
                </div>
            </div>
            
            <!-- Active Filters -->
            @if(request('category') || request('search'))
                <div class="flex flex-wrap gap-2 mb-6">
                    @if(request('category'))
                        @php
                            $cat = $categories->firstWhere('id', request('category'));
                        @endphp
                        @if($cat)
                            <span class="inline-flex items-center px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">
                                {{ $cat->name }}
                                <a href="{{ route('products.index', array_diff_key(request()->all(), ['category' => 1])) }}" class="ml-2 hover:text-primary-900">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </a>
                            </span>
                        @endif
                    @endif
                    @if(request('search'))
                        <span class="inline-flex items-center px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">
                            "{{ request('search') }}"
                            <a href="{{ route('products.index', array_diff_key(request()->all(), ['search' => 1])) }}" class="ml-2 hover:text-primary-900">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </a>
                        </span>
                    @endif
                </div>
            @endif
            
            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="package-x" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700">
                        <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                        Lihat Semua Produk
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@props(['product'])

<div
    class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">

    <!-- IMAGE -->
    <div class="relative aspect-square overflow-hidden bg-gray-100">

        <img src="{{ $product->images->first()
            ? asset('storage/' . $product->images->first()->image_path)
            : asset('storage/' . $product->main_image) }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=400&fit=crop'">

        @if ($product->is_featured)
            <span class="absolute top-3 left-3 bg-primary-500 text-white text-xs font-semibold px-3 py-1 rounded-full">

                Unggulan

            </span>
        @endif

        @if (!$product->isInStock())
            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">

                <span class="bg-red-500 text-white text-sm font-semibold px-4 py-2 rounded-lg">

                    Stok Habis

                </span>

            </div>
        @endif

        <!-- QUICK ACTION -->
        <div
            class="absolute bottom-3 left-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

            <a href="{{ route('products.show', $product->slug) }}"
                class="flex-1 bg-white text-gray-800 text-sm font-medium py-2 rounded-lg text-center hover:bg-primary-500 hover:text-white transition-colors">

                Lihat Detail

            </a>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-5">

        <span class="text-xs text-primary-600 font-medium uppercase tracking-wide">

            {{ $product->category->name }}

        </span>

        <h3 class="font-semibold text-lg text-gray-900 mt-1 mb-2 line-clamp-1">

            {{ $product->name }}

        </h3>

        <p class="text-gray-500 text-sm line-clamp-2 mb-3">

            {{ Str::limit($product->description, 80) }}

        </p>

        <div class="flex items-center justify-between">

            <span class="text-primary-600 font-bold text-lg">

                {{ $product->formattedPrice() }}

            </span>

            @if ($product->isInStock())
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline">

                    @csrf

                    <button type="submit"
                        class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors">

                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>

                    </button>

                </form>
            @else
                <button disabled
                    class="w-10 h-10 bg-gray-100 text-gray-400 rounded-lg flex items-center justify-center cursor-not-allowed">

                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>

                </button>
            @endif

        </div>

    </div>

</div>

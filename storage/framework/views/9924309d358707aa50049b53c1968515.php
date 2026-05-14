<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">

    <!-- IMAGE -->
    <div class="relative aspect-square overflow-hidden bg-gray-100">

        <img src="<?php echo e($product->images->first()
            ? asset('storage/' . $product->images->first()->image_path)
            : asset('storage/' . $product->main_image)); ?>"
            alt="<?php echo e($product->name); ?>"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=400&fit=crop'">

        <?php if($product->is_featured): ?>
            <span class="absolute top-3 left-3 bg-primary-500 text-white text-xs font-semibold px-3 py-1 rounded-full">

                Unggulan

            </span>
        <?php endif; ?>

        <?php if(!$product->isInStock()): ?>
            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">

                <span class="bg-red-500 text-white text-sm font-semibold px-4 py-2 rounded-lg">

                    Stok Habis

                </span>

            </div>
        <?php endif; ?>

        <!-- QUICK ACTION -->
        <div
            class="absolute bottom-3 left-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

            <a href="<?php echo e(route('products.show', $product->slug)); ?>"
                class="flex-1 bg-white text-gray-800 text-sm font-medium py-2 rounded-lg text-center hover:bg-primary-500 hover:text-white transition-colors">

                Lihat Detail

            </a>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-5">

        <span class="text-xs text-primary-600 font-medium uppercase tracking-wide">

            <?php echo e($product->category->name); ?>


        </span>

        <h3 class="font-semibold text-lg text-gray-900 mt-1 mb-2 line-clamp-1">

            <?php echo e($product->name); ?>


        </h3>

        <p class="text-gray-500 text-sm line-clamp-2 mb-3">

            <?php echo e(Str::limit($product->description, 80)); ?>


        </p>

        <div class="flex items-center justify-between">

            <span class="text-primary-600 font-bold text-lg">

                <?php echo e($product->formattedPrice()); ?>


            </span>

            <?php if($product->isInStock()): ?>
                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="inline">

                    <?php echo csrf_field(); ?>

                    <button type="submit"
                        class="w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors">

                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>

                    </button>

                </form>
            <?php else: ?>
                <button disabled
                    class="w-10 h-10 bg-gray-100 text-gray-400 rounded-lg flex items-center justify-center cursor-not-allowed">

                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>

                </button>
            <?php endif; ?>

        </div>

    </div>

</div>
<?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/components/product-card.blade.php ENDPATH**/ ?>
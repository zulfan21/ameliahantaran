<?php $__env->startSection('title', $product->name . ' - Amelia Hantaran'); ?>
<?php $__env->startSection('meta_description', Str::limit($product->description, 160)); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <div class="bg-gray-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center text-sm text-gray-500">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-primary-600">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
                <a href="<?php echo e(route('products.index')); ?>" class="hover:text-primary-600">Katalog</a>
                <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
                <span class="text-gray-900"><?php echo e($product->name); ?></span>
            </nav>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Image Gallery -->
                <div>
                    <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100 mb-4">
                        <img id="main-image" 
                             src="<?php echo e(asset('storage/' . $product->main_image)); ?>" 
                             alt="<?php echo e($product->name); ?>" 
                             class="w-full h-full object-cover"
                             onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=600&h=600&fit=crop'">
                    </div>
                    
                    <?php if($product->images->count() > 0): ?>
                        <div class="grid grid-cols-4 gap-2">
                            <button onclick="changeImage('<?php echo e(asset('storage/' . $product->main_image)); ?>')" 
                                    class="aspect-square rounded-lg overflow-hidden border-2 border-primary-500 hover:opacity-80 transition-opacity">
                                <img src="<?php echo e(asset('storage/' . $product->main_image)); ?>" 
                                     alt="<?php echo e($product->name); ?>" 
                                     class="w-full h-full object-cover">
                            </button>
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button onclick="changeImage('<?php echo e(asset('storage/' . $image->image_path)); ?>')" 
                                        class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-primary-500 hover:opacity-80 transition-all">
                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                         alt="<?php echo e($image->alt_text ?? $product->name); ?>" 
                                         class="w-full h-full object-cover">
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Product Info -->
                <div>
                    <span class="text-primary-600 font-medium text-sm uppercase tracking-wide"><?php echo e($product->category->name); ?></span>
                    <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mt-2 mb-4"><?php echo e($product->name); ?></h1>
                    
                    <div class="flex items-center mb-6">
                        <span class="text-3xl font-bold text-primary-600"><?php echo e($product->formattedPrice()); ?></span>
                        <?php if($product->isInStock()): ?>
                            <span class="ml-4 px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">Tersedia</span>
                        <?php else: ?>
                            <span class="ml-4 px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">Stok Habis</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="prose prose-gray mb-8">
                        <p><?php echo e($product->description); ?></p>
                    </div>
                    
                    <!-- Specifications -->
                    <?php if($product->specifications): ?>
                        <div class="bg-gray-50 rounded-lg p-6 mb-8">
                            <h3 class="font-semibold text-gray-900 mb-4">Spesifikasi</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <?php $__currentLoopData = $product->specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <span class="text-gray-500 text-sm"><?php echo e($key); ?></span>
                                        <p class="font-medium text-gray-900"><?php echo e($value); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Stock Info -->
                    <div class="flex items-center text-sm text-gray-600 mb-6">
                        <i data-lucide="package" class="w-5 h-5 mr-2"></i>
                        <span>Stok tersedia: <strong><?php echo e($product->stock); ?></strong> unit</span>
                        <span class="mx-2">|</span>
                        <span>Min. order: <strong><?php echo e($product->min_order); ?></strong></span>
                    </div>
                    
                    <!-- Add to Cart -->
                    <?php if($product->isInStock()): ?>
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="flex flex-col sm:flex-row gap-4">
                            <?php echo csrf_field(); ?>
                            <div class="flex items-center border border-gray-200 rounded-lg">
                                <button type="button" onclick="decrementQty()" class="px-4 py-3 text-gray-500 hover:text-primary-600">
                                    <i data-lucide="minus" class="w-5 h-5"></i>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo e($product->stock); ?>"
                                       class="w-16 text-center border-0 focus:ring-0 py-3">
                                <button type="button" onclick="incrementQty(<?php echo e($product->stock); ?>)" class="px-4 py-3 text-gray-500 hover:text-primary-600">
                                    <i data-lucide="plus" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <button type="submit" class="flex-1 bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors flex items-center justify-center">
                                <i data-lucide="shopping-cart" class="w-5 h-5 mr-2"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    <?php else: ?>
                        <button disabled class="w-full bg-gray-300 text-gray-500 px-8 py-3 rounded-lg font-semibold cursor-not-allowed">
                            Stok Habis
                        </button>
                    <?php endif; ?>
                    
                    <!-- WhatsApp -->
                    <a href="https://wa.me/<?php echo e(\App\Models\Setting::get('whatsapp_number', '6281234567890')); ?>?text=Halo, saya tertarik dengan produk <?php echo e($product->name); ?>" 
                       target="_blank"
                       class="mt-4 inline-flex items-center justify-center w-full border-2 border-green-500 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-500 hover:text-white transition-colors">
                        <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                        Tanya via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <?php if($relatedProducts->count() > 0): ?>
        <section class="py-12 bg-cream-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-display text-2xl font-bold text-gray-900 mb-8">Produk Terkait</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $relatedProduct]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($relatedProduct)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <script>
        function changeImage(src) {
            document.getElementById('main-image').src = src;
        }
        
        function incrementQty(max) {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) < max) {
                qty.value = parseInt(qty.value) + 1;
            }
        }
        
        function decrementQty() {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/products/show.blade.php ENDPATH**/ ?>
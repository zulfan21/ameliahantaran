<?php $__env->startSection('title', 'Keranjang Belanja - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Keranjang <span class="text-primary-600">Belanja</span>
            </h1>
            <p class="text-gray-600">
                Review pesanan Anda sebelum melanjutkan ke checkout
            </p>
        </div>
    </section>

    <!-- Cart Content -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(count($cart) > 0): ?>
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                            <div class="p-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-gray-900">Produk (<?php echo e($itemCount); ?> item)</span>
                                    <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 text-sm hover:text-red-700 flex items-center">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                            Kosongkan
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="divide-y divide-gray-200">
                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="p-4 sm:p-6 flex flex-col sm:flex-row gap-4">
                                        <!-- Image -->
                                        <div class="w-full sm:w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="<?php echo e(asset('storage/' . $item['image'])); ?>" 
                                                 alt="<?php echo e($item['name']); ?>" 
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=200&h=200&fit=crop'">
                                        </div>
                                        
                                        <!-- Details -->
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900"><?php echo e($item['name']); ?></h3>
                                            <p class="text-primary-600 font-medium mt-1">
                                                Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?>

                                            </p>
                                            
                                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 gap-4">
                                                <!-- Quantity -->
                                                <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST" class="flex items-center">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <div class="flex items-center border border-gray-200 rounded-lg">
                                                        <button type="button" onclick="this.parentElement.querySelector('input').stepDown(); this.form.submit();" 
                                                                class="px-3 py-2 text-gray-500 hover:text-primary-600">
                                                            <i data-lucide="minus" class="w-4 h-4"></i>
                                                        </button>
                                                        <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" max="<?php echo e($item['stock']); ?>"
                                                               class="w-12 text-center border-0 focus:ring-0 py-2" onchange="this.form.submit()">
                                                        <button type="button" onclick="this.parentElement.querySelector('input').stepUp(); this.form.submit();" 
                                                                class="px-3 py-2 text-gray-500 hover:text-primary-600">
                                                            <i data-lucide="plus" class="w-4 h-4"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                
                                                <!-- Subtotal & Remove -->
                                                <div class="flex items-center gap-4">
                                                    <span class="font-semibold text-gray-900">
                                                        Rp <?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>

                                                    </span>
                                                    <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        <!-- Continue Shopping -->
                        <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center text-primary-600 font-medium mt-6 hover:text-primary-700">
                            <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                            Lanjutkan Belanja
                        </a>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-xl p-6 sticky top-24">
                            <h3 class="font-semibold text-lg text-gray-900 mb-4">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Ongkir</span>
                                    <span class="text-green-600">Dihitung saat checkout</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-gray-900">Total</span>
                                    <span class="text-xl font-bold text-primary-600">
                                        Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                                    </span>
                                </div>
                            </div>
                            
                            <a href="<?php echo e(route('checkout.index')); ?>" class="block w-full bg-primary-500 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                                Lanjutkan ke Checkout
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="shopping-bag" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Keranjang Kosong</h2>
                    <p class="text-gray-600 mb-8">Belum ada produk di keranjang Anda</p>
                    <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        <i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i>
                        Mulai Belanja
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/cart/index.blade.php ENDPATH**/ ?>
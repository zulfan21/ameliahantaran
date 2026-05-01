<?php $__env->startSection('title', 'Pesanan Saya - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Pesanan <span class="text-primary-600">Saya</span>
            </h1>
            <p class="text-gray-600">
                Kelola dan lacak status pesanan Anda
            </p>
        </div>
    </section>

    <!-- Orders List -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if($orders->count() > 0): ?>
                <div class="space-y-6">
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                            <!-- Order Header -->
                            <div class="p-4 sm:p-6 border-b border-gray-100 bg-gray-50">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <span class="text-sm text-gray-500">Nomor Pesanan</span>
                                        <p class="font-semibold text-gray-900"><?php echo e($order->order_number); ?></p>
                                    </div>
                                    <div class="text-left sm:text-right">
                                        <span class="text-sm text-gray-500">Tanggal</span>
                                        <p class="text-gray-900"><?php echo e($order->created_at->format('d M Y')); ?></p>
                                    </div>
                                    <div>
                                        <span
                                            class="px-4 py-2 bg-<?php echo e($order->status_color); ?>-100 text-<?php echo e($order->status_color); ?>-700 rounded-full text-sm font-medium">
                                            <?php echo e($order->status_label); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="p-4 sm:p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-600"><?php echo e($order->items->count()); ?> item</span>
                                    <span class="font-bold text-lg text-primary-600"><?php echo e($order->formattedTotal()); ?></span>
                                </div>

                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <a href="<?php echo e(route('orders.show', $order->order_number)); ?>"
                                        class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700">
                                        Lihat Detail
                                        <i data-lucide="chevron-right" class="w-5 h-5 ml-1"></i>
                                    </a>

                                    <?php if($order->status === 'pending' || $order->status === 'waiting_payment'): ?>
                                        <a href="<?php echo e(route('checkout.payment', $order->order_number)); ?>"
                                            class="inline-flex items-center bg-primary-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-600 transition-colors">
                                            <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                                            Upload Bukti Bayar
                                        </a>
                                    <?php endif; ?>

                                    <?php if($order->canBeCancelled()): ?>
                                        <form action="<?php echo e(route('orders.cancel', $order->order_number)); ?>" method="POST"
                                            class="inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                                                class="inline-flex items-center text-red-500 font-medium hover:text-red-700">
                                                <i data-lucide="x-circle" class="w-4 h-4 mr-1"></i>
                                                Batalkan
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <?php echo e($orders->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="package" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Belum Ada Pesanan</h2>
                    <p class="text-gray-600 mb-8">Anda belum memiliki pesanan apapun</p>
                    <a href="<?php echo e(route('products.index')); ?>"
                        class="inline-flex items-center bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        <i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i>
                        Mulai Belanja
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/orders/index.blade.php ENDPATH**/ ?>
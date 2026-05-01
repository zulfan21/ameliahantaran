<?php $__env->startSection('title', 'Dashboard Admin - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600">Selamat datang kembali, <?php echo e(auth()->user()->name); ?></p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Orders -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Pesanan</p>
                        <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_orders']); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="shopping-bag" class="w-6 h-6 text-primary-600"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Menunggu</p>
                        <p class="text-3xl font-bold text-yellow-600"><?php echo e($stats['pending_orders']); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <!-- Processing Orders -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Diproses</p>
                        <p class="text-3xl font-bold text-blue-600"><?php echo e($stats['processing_orders']); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="package" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Selesai</p>
                        <p class="text-3xl font-bold text-green-600"><?php echo e($stats['completed_orders']); ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Sales Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Penjualan 30 Hari Terakhir</h2>

                <div class="relative h-72">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="space-y-6">
                <!-- Products -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-900">Produk</h3>
                        <a href="<?php echo e(route('admin.products.index')); ?>"
                            class="text-sm text-primary-600 hover:text-primary-700">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Produk</span>
                            <span class="font-semibold"><?php echo e($stats['total_products']); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Stok Menipis</span>
                            <span class="font-semibold text-red-600"><?php echo e($stats['low_stock_products']); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Pending Actions -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="font-semibold text-gray-900 mb-4">Tindakan Pending</h3>
                    <div class="space-y-3">
                        <a href="<?php echo e(route('admin.orders.index', ['status' => 'payment_verification'])); ?>"
                            class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                            <span class="text-yellow-700">Verifikasi Pembayaran</span>
                            <span
                                class="px-2 py-1 bg-yellow-500 text-white text-xs rounded-full"><?php echo e($stats['pending_payments']); ?></span>
                        </a>
                        <a href="<?php echo e(route('admin.testimonials.index', ['status' => 'pending'])); ?>"
                            class="flex justify-between items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <span class="text-blue-700">Testimoni Pending</span>
                            <span
                                class="px-2 py-1 bg-blue-500 text-white text-xs rounded-full"><?php echo e($stats['pending_testimonials']); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <?php if($lowStockProducts->count() > 0): ?>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Stok Menipis</h2>
                    <a href="<?php echo e(route('admin.products.index', ['stock' => 'low'])); ?>"
                        class="text-sm text-primary-600 hover:text-primary-700">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-500">Produk</th>
                                <th class="text-center py-3 px-4 font-medium text-gray-500">Stok</th>
                                <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b border-gray-100 last:border-0">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <img src="<?php echo e(asset('storage/' . $product->main_image)); ?>"
                                                alt="<?php echo e($product->name); ?>" class="w-10 h-10 rounded-lg object-cover"
                                                onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=50&h=50&fit=crop'">
                                            <span class="font-medium text-gray-900"><?php echo e($product->name); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span
                                            class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-sm"><?php echo e($product->stock); ?></span>
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <form action="<?php echo e(route('admin.products.update-stock', $product)); ?>" method="POST"
                                            class="inline-flex items-center gap-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="number" name="stock" value="<?php echo e($product->stock); ?>"
                                                min="0"
                                                class="w-20 px-2 py-1 border border-gray-200 rounded text-sm">
                                            <button type="submit" class="text-primary-600 hover:text-primary-700">
                                                <i data-lucide="save" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h2>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm text-primary-600 hover:text-primary-700">Lihat
                    Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Nomor</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Pelanggan</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Tanggal</th>
                            <th class="text-right py-3 px-4 font-medium text-gray-500">Total</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-500">Status</th>
                            <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-gray-100 last:border-0">
                                <td class="py-3 px-4 font-medium"><?php echo e($order->order_number); ?></td>
                                <td class="py-3 px-4"><?php echo e($order->customer_name); ?></td>
                                <td class="py-3 px-4"><?php echo e($order->created_at->format('d M Y')); ?></td>
                                <td class="py-3 px-4 text-right font-medium"><?php echo e($order->formattedTotal()); ?></td>
                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="px-2 py-1 bg-<?php echo e($order->status_color); ?>-100 text-<?php echo e($order->status_color); ?>-700 rounded-full text-xs">
                                        <?php echo e($order->status_label); ?>

                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                        class="text-primary-600 hover:text-primary-700">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartLabels); ?>,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: <?php echo json_encode($chartData); ?>,
                    borderColor: '#ec4899',
                    backgroundColor: 'rgba(236, 72, 153, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
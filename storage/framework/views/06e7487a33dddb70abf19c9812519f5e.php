<?php $__env->startSection('title', 'Detail Pesanan ' . $order->order_number); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-2">
                        Detail Pesanan
                    </h1>
                    <p class="text-gray-600">
                        <?php echo e($order->order_number); ?> • <?php echo e($order->created_at->format('d M Y H:i')); ?>

                    </p>
                </div>
                <span
                    class="px-4 py-2 bg-<?php echo e($order->status_color); ?>-100 text-<?php echo e($order->status_color); ?>-700 rounded-full text-sm font-medium">
                    <?php echo e($order->status_label); ?>

                </span>
            </div>
        </div>
    </section>

    <!-- Order Detail -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Order Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Items -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Item Pesanan</h2>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center gap-4 py-3 border-b border-gray-100 last:border-0">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        <?php if($item->product): ?>
                                            <img src="<?php echo e(asset('storage/' . $item->product->main_image)); ?>"
                                                alt="<?php echo e($item->product_name); ?>" class="w-full h-full object-cover"
                                                onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=100&h=100&fit=crop'">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <i data-lucide="package" class="w-8 h-8 text-gray-400"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900"><?php echo e($item->product_name); ?></h4>
                                        <p class="text-sm text-gray-500"><?php echo e($item->quantity); ?> x
                                            <?php echo e($item->formattedPrice()); ?></p>
                                    </div>
                                    <span class="font-semibold text-gray-900"><?php echo e($item->formattedSubtotal()); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Informasi Pengiriman</h2>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Nama Penerima</span>
                                <p class="font-medium text-gray-900"><?php echo e($order->customer_name); ?></p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Email</span>
                                <p class="font-medium text-gray-900"><?php echo e($order->customer_email); ?></p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Telepon</span>
                                <p class="font-medium text-gray-900"><?php echo e($order->customer_phone); ?></p>
                            </div>
                            <div class="sm:col-span-2">
                                <span class="text-sm text-gray-500">Alamat</span>
                                <p class="font-medium text-gray-900"><?php echo e($order->customer_address); ?></p>
                            </div>
                            <?php if($order->notes): ?>
                                <div class="sm:col-span-2">
                                    <span class="text-sm text-gray-500">Catatan</span>
                                    <p class="font-medium text-gray-900"><?php echo e($order->notes); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Payment Proofs -->
                    <?php if($order->paymentProofs->count() > 0 && $order->status !== 'selesai'): ?>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="font-semibold text-lg text-gray-900 mb-4">Bukti Pembayaran</h2>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $order->paymentProofs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">

                                        <div onclick="document.getElementById('modal-<?php echo e($loop->index); ?>').classList.remove('hidden'); document.getElementById('modal-<?php echo e($loop->index); ?>').classList.add('flex');"
                                            title="Klik untuk memperbesar"
                                            class="block w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0 hover:opacity-75 hover:ring-2 hover:ring-primary-500 transition-all cursor-pointer">
                                            <img src="<?php echo e(asset('storage/' . $proof->image_path)); ?>" alt="Bukti Pembayaran"
                                                class="w-full h-full object-cover">
                                        </div>

                                        <div id="modal-<?php echo e($loop->index); ?>"
                                            class="hidden fixed inset-0 z-[9999] bg-black/90 items-center justify-center p-4 transition-all">

                                            <div onclick="document.getElementById('modal-<?php echo e($loop->index); ?>').classList.add('hidden'); document.getElementById('modal-<?php echo e($loop->index); ?>').classList.remove('flex');"
                                                class="absolute inset-0 cursor-pointer"></div>

                                            <div class="relative z-10 flex flex-col items-end">
                                                <button
                                                    onclick="document.getElementById('modal-<?php echo e($loop->index); ?>').classList.add('hidden'); document.getElementById('modal-<?php echo e($loop->index); ?>').classList.remove('flex');"
                                                    class="mb-4 text-white hover:text-red-500 font-bold text-lg flex items-center gap-2 cursor-pointer bg-black/50 px-4 py-2 rounded-full">
                                                    <i data-lucide="x" class="w-5 h-5"></i> Tutup
                                                </button>

                                                <img src="<?php echo e(asset('storage/' . $proof->image_path)); ?>"
                                                    class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
                                            </div>
                                        </div>

                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full 
                                                    <?php echo e($proof->status === 'approved' ? 'bg-green-100 text-green-700' : ''); ?>

                                                    <?php echo e($proof->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                                    <?php echo e($proof->status === 'rejected' ? 'bg-red-100 text-red-700' : ''); ?>">
                                                    <?php echo e(ucfirst($proof->status)); ?>

                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600">
                                                Jumlah: Rp <?php echo e(number_format($proof->amount, 0, ',', '.')); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-xl p-6 sticky top-24">
                        <h3 class="font-semibold text-lg text-gray-900 mb-4">Ringkasan Pesanan</h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span><?php echo e($order->formattedSubtotal()); ?></span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkir</span>
                                <span>Rp <?php echo e(number_format($order->shipping_cost, 0, ',', '.')); ?></span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">Total</span>
                                <span class="text-xl font-bold text-primary-600"><?php echo e($order->formattedTotal()); ?></span>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                            <h3 class="font-semibold text-lg text-gray-900 mb-4">
                                Timeline Pesanan
                            </h3>

                            <div class="space-y-4">

                                <div class="flex items-start gap-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                                    <div>
                                        <p class="font-medium text-gray-900">Pesanan Dibuat</p>
                                        <p class="text-sm text-gray-500">
                                            <?php echo e($order->created_at->format('d M Y H:i')); ?>

                                        </p>
                                    </div>
                                </div>

                                <?php if($order->payment_status !== 'unpaid'): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pembayaran Diterima</p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order->cancel_rejected): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 bg-red-500 rounded-full mt-1"></div>

                                        <div>
                                            <p class="font-medium text-red-600">
                                                Pembatalan Ditolak
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                Pesanan tetap diproses oleh admin
                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order->processed_at): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pesanan Diproses</p>
                                            <p class="text-sm text-gray-500">
                                                <?php echo e($order->processed_at->format('d M Y H:i')); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order->shipped_at): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mt-1"></div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pesanan Dikirim</p>
                                            <p class="text-sm text-gray-500">
                                                <?php echo e($order->shipped_at->format('d M Y H:i')); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order->completed_at): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                                        <div>
                                            <p class="font-medium text-gray-900">Pesanan Selesai</p>
                                            <p class="text-sm text-gray-500">
                                                <?php echo e($order->completed_at->format('d M Y H:i')); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order->status === 'dibatalkan'): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 bg-red-500 rounded-full mt-1"></div>
                                        <div>
                                            <p class="font-medium text-red-600">Pesanan Dibatalkan</p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php if($order->status === 'cancel_rejected'): ?>
                            <div class="mt-4 p-4 rounded-xl border border-red-200 bg-red-50">
                                <div class="flex items-start gap-3">

                                    <i data-lucide="shield-alert" class="w-5 h-5 text-red-500 mt-0.5"></i>

                                    <div>
                                        <p class="font-semibold text-red-600">
                                            Permintaan Pembatalan Ditolak
                                        </p>

                                        <p class="text-sm text-red-500 mt-1">
                                            Admin menolak pembatalan. Pesanan tetap diproses.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Actions -->
                        <div class="space-y-3">
                            <?php if($order->status === 'waiting_payment'): ?>
                                <a href="<?php echo e(route('checkout.payment', $order->order_number)); ?>"
                                    class="block w-full text-center px-4 py-2 bg-pink-500 text-white rounded-lg font-medium hover:bg-pink-600 transition-colors">
                                    <i data-lucide="upload" class="w-4 h-4 inline mr-2"></i>
                                    Upload Bukti Bayar
                                </a>
                            <?php endif; ?>

                            <?php if($order->status === 'diproses' && $order->cancel_rejected != 1): ?>
                                <button type="button"
                                    onclick="document.getElementById('cancelModal').classList.remove('hidden');
                                    document.getElementById('cancelModal').classList.add('flex');"
                                    class="block w-full border border-red-500 text-red-500 text-center px-6 py-3 rounded-lg font-semibold hover:bg-red-50 transition-colors">

                                    <i data-lucide="x-circle" class="w-5 h-5 inline mr-2"></i>
                                    Batalkan Pesanan
                                </button>

                                <!-- Modal -->
                                <div id="cancelModal"
                                    class="hidden fixed inset-0 z-[9999] bg-black/70 items-center justify-center p-4">

                                    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">

                                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                                            Batalkan Pesanan?
                                        </h3>

                                        <p class="text-gray-600 mb-6">
                                            Permintaan pembatalan akan dikirim ke admin dan menunggu persetujuan.
                                        </p>
                                        <form action="<?php echo e(route('orders.cancel', $order->order_number)); ?>" method="POST">

                                            <?php echo csrf_field(); ?>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Alasan Pembatalan
                                                </label>

                                                <textarea name="cancel_reason" rows="4" required
                                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                                    placeholder="Contoh: tanggal acara berubah, salah pesan, dll"></textarea>
                                            </div>

                                            <div class="flex justify-end gap-3">

                                                <button type="button"
                                                    onclick="document.getElementById('cancelModal').classList.add('hidden');
                                                    document.getElementById('cancelModal').classList.remove('flex');"
                                                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">

                                                    Kembali
                                                </button>

                                                <button type="submit"
                                                    class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">

                                                    Ya, Batalkan
                                                </button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($order->status === 'dikirim'): ?>
                                <form action="<?php echo e(route('orders.complete', $order->order_number)); ?>" method="POST">

                                    <?php echo csrf_field(); ?>

                                    <button type="button"
                                        onclick="document.getElementById('completeModal').classList.remove('hidden')"
                                        class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                                        Pesanan Selesai
                                    </button>

                                    <!-- Modal -->
                                    <div id="completeModal"
                                        class="hidden fixed inset-0 z-[9999] bg-black/50 flex items-center justify-center p-4">

                                        <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">

                                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                                Konfirmasi Pesanan
                                            </h3>

                                            <p class="text-gray-600 mb-6">
                                                Apakah pesanan sudah diterima dengan baik?
                                            </p>

                                            <div class="flex justify-end gap-3">

                                                <button type="button"
                                                    onclick="document.getElementById('completeModal').classList.add('hidden')"
                                                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                                                    Batal
                                                </button>

                                                <button type="submit"
                                                    class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                                                    Ya, Selesaikan
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>

                            <?php if($order->status === 'selesai'): ?>
                                <?php if(!$order->testimonial): ?>
                                    <a href="<?php echo e(route('testimonials.create')); ?>"
                                        class="block w-full border border-primary-500 text-primary-500 text-center px-6 py-3 rounded-lg font-semibold hover:bg-primary-50 transition-colors">
                                        <i data-lucide="star" class="w-5 h-5 inline mr-2"></i>
                                        Beri Testimoni
                                    </a>
                                <?php else: ?>
                                    <button type="button"
                                        onclick="document.getElementById('modalDetailTestimoni').classList.remove('hidden'); document.getElementById('modalDetailTestimoni').classList.add('flex');"
                                        class="block w-full bg-primary-50 border border-primary-200 text-primary-600 text-center px-6 py-3 rounded-lg font-semibold hover:bg-primary-100 transition-colors">
                                        <i data-lucide="message-square" class="w-5 h-5 inline mr-2"></i>
                                        Lihat Testimoni
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php if($order->testimonial): ?>
                            <div id="modalDetailTestimoni"
                                class="hidden fixed inset-0 z-[100] bg-black/80 items-center justify-center p-4 transition-all"
                                onclick="document.getElementById('modalDetailTestimoni').classList.add('hidden'); document.getElementById('modalDetailTestimoni').classList.remove('flex');">
                                <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden relative"
                                    onclick="event.stopPropagation()">
                                    <div
                                        class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                                        <h3 class="font-bold text-gray-900 text-lg">Testimoni Anda</h3>
                                        <button type="button"
                                            onclick="document.getElementById('modalDetailTestimoni').classList.add('hidden'); document.getElementById('modalDetailTestimoni').classList.remove('flex');"
                                            class="text-gray-400 hover:text-red-500 transition-colors">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </div>

                                    <div class="p-6">
                                        <div class="flex items-center mb-4 text-secondary-400">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i data-lucide="star"
                                                    class="w-6 h-6 <?php echo e($i <= $order->testimonial->rating ? 'fill-current' : ''); ?>"></i>
                                            <?php endfor; ?>
                                        </div>

                                        <p class="text-gray-700 text-lg italic leading-relaxed">
                                            "<?php echo e($order->testimonial->content); ?>"</p>

                                        <?php if($order->testimonial->wedding_date): ?>
                                            <p class="text-sm text-gray-500 mt-4">
                                                <i data-lucide="calendar-heart" class="w-4 h-4 inline mr-1"></i> Momen:
                                                <?php echo e($order->testimonial->wedding_date); ?>

                                            </p>
                                        <?php endif; ?>

                                        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                                            <span class="text-sm text-gray-500 flex items-center gap-2">Status:
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs font-medium 
                                                    <?php echo e($order->testimonial->status === 'approved' ? 'bg-green-100 text-green-700' : ''); ?>

                                                    <?php echo e($order->testimonial->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                                    <?php echo e($order->testimonial->status === 'rejected' ? 'bg-red-100 text-red-700' : ''); ?>">
                                                    <?php echo e(ucfirst($order->testimonial->status)); ?>

                                                </span>
                                            </span>
                                            <span
                                                class="text-sm text-gray-400"><?php echo e($order->testimonial->created_at->format('d M Y')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Tracking -->
                        <?php if($order->tracking_number): ?>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <span class="text-sm text-gray-500">Nomor Resi</span>
                                <p class="font-medium text-gray-900"><?php echo e($order->tracking_number); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/orders/show.blade.php ENDPATH**/ ?>
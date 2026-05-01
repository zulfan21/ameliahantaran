<?php $__env->startSection('title', 'Pembayaran - Pesanan ' . $order->order_number); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Pembayaran
            </h1>
            <p class="text-gray-600">
                Selesaikan pembayaran untuk pesanan <span class="font-semibold"><?php echo e($order->order_number); ?></span>
            </p>
        </div>
    </section>

    <!-- Payment Content -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Payment Methods -->
                <div class="space-y-6">
                    <!-- QRIS Payment -->
                    <div class="bg-white border-2 border-primary-500 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <span
                                class="px-3 py-1 bg-primary-100 text-primary-700 text-sm rounded-full font-medium">Rekomendasi</span>
                        </div>
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Scan QRIS</h2>
                        <p class="text-gray-600 text-sm mb-6">
                            Scan kode QR berikut menggunakan aplikasi e-wallet atau mobile banking Anda.
                        </p>

                        <!-- QRIS dari Admin -->
                        <div class="flex justify-center mb-6">
                            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200">

                                <?php if(isset($settings['qris_image'])): ?>
                                    <img src="<?php echo e(asset('storage/' . $settings['qris_image'])); ?>"
                                        class="w-48 h-48 object-contain">
                                <?php else: ?>
                                    <p class="text-red-500 text-center">QRIS belum tersedia</p>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-gray-500">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-primary-600"><?php echo e($order->formattedTotal()); ?></p>
                        </div>
                    </div>

                    <!-- Bank Transfer -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Transfer Bank</h2>
                        <div class="space-y-4">
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="font-medium text-gray-900"><?php echo e($bankInfo['name']); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-2xl font-bold text-gray-900"><?php echo e($bankInfo['account']); ?></p>
                                        <p class="text-sm text-gray-500">a.n <?php echo e($bankInfo['account_name']); ?></p>
                                    </div>
                                    <button onclick="copyToClipboard('<?php echo e($bankInfo['account']); ?>')"
                                        class="px-4 py-2 bg-primary-100 text-primary-600 rounded-lg text-sm font-medium hover:bg-primary-200 transition-colors">
                                        Salin
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="bg-cream-50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-900 mb-3">Cara Pembayaran</h3>
                        <ol class="space-y-2 text-sm text-gray-600 list-decimal list-inside">
                            <li>Pilih metode pembayaran (QRIS atau Transfer Bank)</li>
                            <li>Lakukan pembayaran sesuai total yang tertera</li>
                            <li>Simpan bukti pembayaran Anda</li>
                            <li>Upload bukti pembayaran melalui form di bawah</li>
                            <li>Tunggu konfirmasi dari admin (1x24 jam)</li>
                        </ol>
                    </div>
                </div>

                <!-- Upload Payment Proof -->
                <div>
                    <div class="bg-white border border-gray-200 rounded-xl p-6 sticky top-24">
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Upload Bukti Pembayaran</h2>

                        <form action="<?php echo e(route('orders.upload-payment', $order->order_number)); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="space-y-4">
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti
                                        Transfer</label>
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition-colors">
                                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                                            onchange="previewImage(this)" required>
                                        <label for="image" class="cursor-pointer">
                                            <i data-lucide="upload-cloud" class="w-12 h-12 text-gray-400 mx-auto mb-3"></i>
                                            <p class="text-gray-600">Klik untuk upload atau drag & drop</p>
                                            <p class="text-gray-400 text-sm mt-1">PNG, JPG maksimal 5MB</p>
                                        </label>
                                    </div>
                                    <div id="image-preview" class="mt-4 hidden">
                                        <img src="" alt="Preview" class="max-w-full h-auto rounded-lg">
                                    </div>
                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Bank
                                            Pengirim</label>
                                        <input type="text" name="bank_name" id="bank_name"
                                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                            placeholder="Contoh: BCA">
                                    </div>
                                    <div>
                                        <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Pengirim</label>
                                        <input type="text" name="account_name" id="account_name"
                                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                            placeholder="Nama rekening">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                                            Transfer</label>
                                        <input type="number" name="amount" id="amount" value="<?php echo e($order->total); ?>"
                                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="payment_date"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transfer</label>
                                        <input type="date" name="payment_date" id="payment_date"
                                            value="<?php echo e(date('Y-m-d')); ?>"
                                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                            required>
                                    </div>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan
                                        (Opsional)</label>
                                    <textarea name="notes" id="notes" rows="2"
                                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                        placeholder="Tambahan informasi..."></textarea>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-primary-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors mt-6">
                                Konfirmasi Pembayaran
                            </button>
                        </form>

                        <!-- Order Summary -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold text-gray-900 mb-3">Detail Pesanan</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nomor Pesanan</span>
                                    <span class="font-medium"><?php echo e($order->order_number); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total</span>
                                    <span class="font-bold text-primary-600"><?php echo e($order->formattedTotal()); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/checkout/payment.blade.php ENDPATH**/ ?>
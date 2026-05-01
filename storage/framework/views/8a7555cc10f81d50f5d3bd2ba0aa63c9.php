<?php $__env->startSection('title', 'Pengaturan - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pengaturan</h1>
            <p class="text-gray-600">Konfigurasi website dan informasi bisnis</p>
        </div>

        <!-- Settings Form -->
        <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST"
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <?php echo csrf_field(); ?>

            <!-- Company Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Informasi Perusahaan</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                        <input type="text" name="company_name"
                            value="<?php echo e($settings['company_name'] ?? 'Amelia Hantaran'); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="company_tagline" value="<?php echo e($settings['company_tagline'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="company_description" rows="3"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"><?php echo e($settings['company_description'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Kontak</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="company_address" rows="2"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"><?php echo e($settings['company_address'] ?? ''); ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" name="company_phone" value="<?php echo e($settings['company_phone'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="company_email" value="<?php echo e($settings['company_email'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp (62xxx)</label>
                        <input type="text" name="whatsapp_number" value="<?php echo e($settings['whatsapp_number'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps URL</label>
                        <input type="url" name="google_maps" value="<?php echo e($settings['google_maps'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">Pembayaran</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                        <input type="text" name="bank_name" value="<?php echo e($settings['bank_name'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                        <input type="text" name="bank_account" value="<?php echo e($settings['bank_account'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label>
                        <input type="text" name="bank_account_name" value="<?php echo e($settings['bank_account_name'] ?? ''); ?>"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ongkir Default (Rp)</label>
                        <input type="number" name="shipping_cost" value="<?php echo e($settings['shipping_cost'] ?? 15000); ?>"
                            min="0"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">QRIS</label>
                        <input type="file" name="qris_image" class="w-full border rounded-lg p-2">

                        <?php if(isset($settings['qris_image'])): ?>
                            <img src="<?php echo e(asset('storage/' . $settings['qris_image'])); ?>" class="mt-2 w-40">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                    <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>
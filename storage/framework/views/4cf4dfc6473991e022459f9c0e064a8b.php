

<?php $__env->startSection('title', 'Tambah Foto Galeri'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <div class="flex items-center gap-4">
            <a href="<?php echo e(route('admin.galleries.index')); ?>" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Foto Galeri</h1>
                <p class="text-gray-600">Unggah foto baru untuk ditampilkan di halaman galeri</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl">
            <form action="<?php echo e(route('admin.galleries.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Foto <span class="text-red-500">*</span></label>
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/webp" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 
                                  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold 
                                  file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maksimal 2MB.</p>
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

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                           placeholder="Contoh: Hantaran Pernikahan Rina & Doni">
                    <?php $__errorArgs = ['title'];
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

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                              placeholder="Tambahkan keterangan singkat tentang foto ini..."><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
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

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Kategori / Tipe <span class="text-red-500">*</span></label>
                    <select name="type" id="type" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="wedding" <?php echo e(old('type') == 'wedding' ? 'selected' : ''); ?>>Pernikahan (Wedding)</option>
                        <option value="product" <?php echo e(old('type') == 'product' ? 'selected' : ''); ?>>Produk (Product)</option>
                        <option value="behind_the_scenes" <?php echo e(old('type') == 'behind_the_scenes' ? 'selected' : ''); ?>>Di Balik Layar (Behind the Scenes)</option>
                    </select>
                    <?php $__errorArgs = ['type'];
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

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500" <?php echo e(old('is_active', '1') == '1' ? 'checked' : ''); ?>>
                        <span class="text-sm font-medium text-gray-700">Tampilkan foto ini di halaman galeri publik</span>
                    </label>
                    <?php $__errorArgs = ['is_active'];
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

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="<?php echo e(route('admin.galleries.index')); ?>" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition-colors">
                        <i data-lucide="upload-cloud" class="w-5 h-5 inline mr-1"></i>
                        Simpan & Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/galleries/create.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Kelola Galeri'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Galeri</h1>
                <p class="text-gray-600">Manajemen foto galeri Amelia Hantaran</p>
            </div>
            <a href="<?php echo e(route('admin.galleries.create')); ?>" class="inline-flex items-center bg-primary-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-600 transition-colors">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                Tambah Foto
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="p-4 font-semibold text-gray-600 text-sm">Foto</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Judul & Deskripsi</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 w-32">
                                    <div class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200">
                                        <img src="<?php echo e(asset('storage/' . $gallery->image_path)); ?>" alt="<?php echo e($gallery->title); ?>" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                
                                <td class="p-4">
                                    <p class="font-bold text-gray-900 text-base mb-1"><?php echo e($gallery->title); ?></p>
                                    <p class="text-sm text-gray-500 line-clamp-2"><?php echo e($gallery->description ?? 'Tidak ada deskripsi'); ?></p>
                                </td>
                                
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <form action="<?php echo e(route('admin.galleries.destroy', $gallery->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus foto ini dari galeri?')" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="p-12 text-center text-gray-500">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="image" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <p class="text-lg font-medium text-gray-900 mb-1">Galeri Masih Kosong</p>
                                    <p>Belum ada foto yang diunggah ke galeri.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if($galleries->hasPages()): ?>
                <div class="p-4 border-t border-gray-100">
                    <?php echo e($galleries->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/galleries/index.blade.php ENDPATH**/ ?>
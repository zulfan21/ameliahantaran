

<?php $__env->startSection('title', 'Kelola Testimoni'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Testimoni</h1>
                <p class="text-gray-600">Terima atau tolak testimoni dari pelanggan</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="p-4 font-semibold text-gray-600 text-sm">Pelanggan</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Rating</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Isi Testimoni</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Status</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <p class="font-medium text-gray-900"><?php echo e($testimonial->user->name ?? 'Pelanggan'); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e($testimonial->created_at->format('d M Y')); ?></p>
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center text-yellow-400">
                                        <?php echo e($testimonial->rating); ?> <i data-lucide="star"
                                            class="w-4 h-4 ml-1 fill-current"></i>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <p class="text-sm text-gray-600 max-w-xs truncate" title="<?php echo e($testimonial->content); ?>">
                                        <?php echo e($testimonial->content); ?>

                                    </p>
                                </td>

                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium 
                                        <?php echo e($testimonial->status === 'approved' ? 'bg-green-100 text-green-700' : ''); ?>

                                        <?php echo e($testimonial->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                        <?php echo e($testimonial->status === 'rejected' ? 'bg-red-100 text-red-700' : ''); ?>">
                                        <?php echo e(ucfirst($testimonial->status ?? 'pending')); ?>

                                    </span>
                                </td>

                                <td class="p-4">
                                    <div class="flex gap-2 flex-wrap">

                                        <?php if($testimonial->status === 'pending'): ?>
                                            <!-- Approve -->
                                            <form action="<?php echo e(route('admin.testimonials.approve', $testimonial->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-green-500 text-white rounded text-sm hover:bg-green-600">
                                                    Setujui
                                                </button>
                                            </form>

                                            <!-- Reject -->
                                            <form action="<?php echo e(route('admin.testimonials.reject', $testimonial->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit"
                                                    class="px-3 py-1.5 border border-red-500 text-red-500 rounded text-sm hover:bg-red-50">
                                                    Tolak
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <!-- DELETE (SELALU ADA) -->
                                        <form action="<?php echo e(route('admin.testimonials.destroy', $testimonial->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    <i data-lucide="message-square" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>
                                    Belum ada testimoni dari pelanggan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($testimonials->hasPages()): ?>
                <div class="p-4 border-t border-gray-100">
                    <?php echo e($testimonials->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/testimonials/index.blade.php ENDPATH**/ ?>
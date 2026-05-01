<?php $__env->startSection('title', 'Tulis Testimoni - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="w-full max-w-lg px-4">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display text-2xl font-bold text-gray-900">Tulis Testimoni</h1>
                    <p class="text-gray-500 mt-2">Bagikan pengalaman Anda dengan kami</p>
                </div>

                <!-- Form -->
                <form action="<?php echo e(route('testimonials.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    
                    <?php if($orders->count() > 0): ?>
                        <div>
                            <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Pesanan</label>
                            <select name="order_id" id="order_id" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                                <option value="">Pilih pesanan (opsional)</option>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($order->id); ?>"><?php echo e($order->order_number); ?> - <?php echo e($order->created_at->format('d M Y')); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <div class="flex gap-2">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="<?php echo e($i); ?>" class="hidden peer" <?php echo e($i == 5 ? 'checked' : ''); ?>>
                                    <i data-lucide="star" class="w-8 h-8 text-gray-300 peer-checked:text-secondary-400 peer-checked:fill-current hover:text-secondary-400 transition-colors"></i>
                                </label>
                            <?php endfor; ?>
                        </div>
                        <?php $__errorArgs = ['rating'];
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
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Testimoni</label>
                        <textarea name="content" id="content" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  placeholder="Ceritakan pengalaman Anda..." required><?php echo e(old('content')); ?></textarea>
                        <?php $__errorArgs = ['content'];
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
                        <label for="wedding_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pernikahan (Opsional)</label>
                        <input type="text" name="wedding_date" id="wedding_date" value="<?php echo e(old('wedding_date')); ?>" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                               placeholder="Contoh: Maret 2024">
                    </div>
                    
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <p class="text-sm text-gray-500 mt-1">Upload foto momen spesial Anda</p>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary-500 text-white py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        Kirim Testimoni
                    </button>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/testimonials/create.blade.php ENDPATH**/ ?>
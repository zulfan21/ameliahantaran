<?php $__env->startSection('title', 'Testimoni Pelanggan - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Testimoni <span class="text-primary-600">Pelanggan</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Apa kata mereka yang telah mempercayakan momen spesial kepada kami
            </p>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if(auth()->guard()->check()): ?>
                <div class="text-center mb-12">
                    <a href="<?php echo e(route('testimonials.create')); ?>"
                        class="inline-flex items-center bg-primary-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                        Tulis Testimoni
                    </a>
                </div>
            <?php endif; ?>

            <?php if($testimonials->count() > 0): ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-cream-50 rounded-xl p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-4">
                                <div class="flex text-secondary-400">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i data-lucide="star"
                                            class="w-5 h-5 <?php echo e($i <= $testimonial->rating ? 'fill-current' : ''); ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php if($testimonial->photo): ?>
                                <!-- Thumbnail -->
                                <div class="mb-4 overflow-hidden rounded-lg cursor-pointer"
                                    onclick="document.getElementById('testimonial-modal-<?php echo e($testimonial->id); ?>').classList.remove('hidden');
                                    document.getElementById('testimonial-modal-<?php echo e($testimonial->id); ?>').classList.add('flex');">

                                    <img src="<?php echo e(asset('storage/' . $testimonial->photo)); ?>" alt="Foto Testimoni"
                                        class="w-full h-56 object-cover rounded-lg hover:scale-105 transition-transform duration-300">
                                </div>

                                <!-- Modal -->
                                <div id="testimonial-modal-<?php echo e($testimonial->id); ?>"
                                    class="hidden fixed inset-0 z-[9999] bg-black/90 items-center justify-center p-4">

                                    <!-- background close -->
                                    <div class="absolute inset-0"
                                        onclick="document.getElementById('testimonial-modal-<?php echo e($testimonial->id); ?>').classList.add('hidden');
                                        document.getElementById('testimonial-modal-<?php echo e($testimonial->id); ?>').classList.remove('flex');">
                                    </div>

                                    <!-- content -->
                                    <div class="relative z-10 max-w-5xl w-full flex flex-col items-end">

                                        <!-- tombol close -->
                                        <button
                                            onclick="document.getElementById('testimonial-modal-<?php echo e($testimonial->id); ?>').classList.add('hidden');
                                            document.getElementById('testimonial-modal-<?php echo e($testimonial->id); ?>').classList.remove('flex');"
                                            class="mb-4 bg-black/50 text-white px-4 py-2 rounded-full hover:text-red-500 transition-colors">

                                            Tutup
                                        </button>

                                        <!-- gambar besar -->
                                        <img src="<?php echo e(asset('storage/' . $testimonial->photo)); ?>"
                                            class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <p class="text-gray-600 mb-6 italic">"<?php echo e($testimonial->content); ?>"</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                    <span
                                        class="text-primary-600 font-bold text-lg"><?php echo e(substr($testimonial->customer_name, 0, 1)); ?></span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900"><?php echo e($testimonial->customer_name); ?></h4>
                                    <?php if($testimonial->wedding_date): ?>
                                        <p class="text-sm text-gray-500"><?php echo e($testimonial->wedding_date); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-12">
                    <?php echo e($testimonials->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="message-square" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Belum Ada Testimoni</h2>
                    <p class="text-gray-600">Jadilah yang pertama memberikan testimoni!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/testimonials/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', $product->name . ' - Amelia Hantaran'); ?>
<?php $__env->startSection('meta_description', Str::limit($product->description, 160)); ?>

<?php $__env->startSection('content'); ?>

    <!-- Breadcrumb -->
    <div class="bg-gray-50 py-4">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center text-sm text-gray-500">

                <a href="<?php echo e(route('home')); ?>" class="hover:text-primary-600">

                    Home

                </a>

                <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>

                <a href="<?php echo e(route('products.index')); ?>" class="hover:text-primary-600">

                    Katalog

                </a>

                <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>

                <span class="text-gray-900">

                    <?php echo e($product->name); ?>


                </span>

            </nav>

        </div>

    </div>

    <!-- Product Detail -->
    <section class="py-12 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-12">

                <!-- IMAGE GALLERY -->
                <div>

                    <!-- BIG IMAGE -->
                    <div class="relative overflow-hidden rounded-xl bg-gray-100 mb-4 aspect-square select-none">

                        <div id="image-slider" style="cursor: grab;"
                            class="flex h-full transition-transform duration-300 ease-in-out">

                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="min-w-full flex-shrink-0 h-full">

                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                        class="w-full h-full object-cover pointer-events-none">

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                    <!-- THUMBNAILS -->
                    <?php if($product->images->count() > 0): ?>

                        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">

                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button onclick="changeSlide(<?php echo e($loop->index); ?>, this)"
                                    class="thumbnail-btn flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden border-2 transition-all duration-200 <?php echo e($loop->first ? 'border-primary-500' : 'border-transparent'); ?>">

                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                        class="w-full h-full object-cover">

                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- PRODUCT INFO -->
                <div>

                    <span class="text-primary-600 font-medium text-sm uppercase tracking-wide">

                        <?php echo e($product->category->name); ?>


                    </span>

                    <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mt-2 mb-4">

                        <?php echo e($product->name); ?>


                    </h1>

                    <!-- PRICE -->
                    <div class="flex items-center mb-6">

                        <span class="text-3xl font-bold text-primary-600">

                            <?php echo e($product->formattedPrice()); ?>


                        </span>

                        <?php if($product->isInStock()): ?>
                            <span class="ml-4 px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">

                                Tersedia

                            </span>
                        <?php else: ?>
                            <span class="ml-4 px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">

                                Stok Habis

                            </span>
                        <?php endif; ?>

                    </div>

                    <!-- DESCRIPTION -->
                    <div class="prose prose-gray mb-8 break-words overflow-hidden">

                        <p class="whitespace-pre-line break-words">

                            <?php echo e($product->description); ?>


                        </p>

                    </div>

                    <!-- SPECIFICATIONS -->
                    <?php if($product->specifications): ?>

                        <div class="bg-gray-50 rounded-lg p-6 mb-8">

                            <h3 class="font-semibold text-gray-900 mb-4">

                                Spesifikasi

                            </h3>

                            <div class="grid grid-cols-2 gap-4">

                                <?php $__currentLoopData = $product->specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>

                                        <span class="text-gray-500 text-sm">

                                            <?php echo e($key); ?>


                                        </span>

                                        <p class="font-medium text-gray-900">

                                            <?php echo e($value); ?>


                                        </p>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <!-- STOCK -->
                    <div class="flex items-center text-sm text-gray-600 mb-6">

                        <i data-lucide="package" class="w-5 h-5 mr-2"></i>

                        <span>

                            Stok tersedia:
                            <strong><?php echo e($product->stock); ?></strong>
                            unit

                        </span>

                        <span class="mx-2">|</span>

                        <span>

                            Min. order:
                            <strong><?php echo e($product->min_order); ?></strong>

                        </span>

                    </div>

                    <!-- ADD TO CART -->
                    <?php if($product->isInStock()): ?>
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST"
                            class="flex flex-col sm:flex-row gap-4">

                            <?php echo csrf_field(); ?>

                            <div class="flex items-center border border-gray-200 rounded-lg">

                                <button type="button" onclick="decrementQty()"
                                    class="px-4 py-3 text-gray-500 hover:text-primary-600">

                                    <i data-lucide="minus" class="w-5 h-5"></i>

                                </button>

                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    max="<?php echo e($product->stock); ?>" class="w-16 text-center border-0 focus:ring-0 py-3">

                                <button type="button" onclick="incrementQty(<?php echo e($product->stock); ?>)"
                                    class="px-4 py-3 text-gray-500 hover:text-primary-600">

                                    <i data-lucide="plus" class="w-5 h-5"></i>

                                </button>

                            </div>

                            <button type="submit"
                                class="flex-1 bg-primary-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors flex items-center justify-center">

                                <i data-lucide="shopping-cart" class="w-5 h-5 mr-2"></i>

                                Tambah ke Keranjang

                            </button>

                        </form>
                    <?php else: ?>
                        <button disabled
                            class="w-full bg-gray-300 text-gray-500 px-8 py-3 rounded-lg font-semibold cursor-not-allowed">

                            Stok Habis

                        </button>
                    <?php endif; ?>

                    <!-- WHATSAPP -->
                    <a href="https://wa.me/<?php echo e(\App\Models\Setting::get('whatsapp_number', '6281234567890')); ?>?text=Halo, saya tertarik dengan produk <?php echo e($product->name); ?>"
                        target="_blank"
                        class="mt-4 inline-flex items-center justify-center w-full border-2 border-green-500 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-500 hover:text-white transition-colors">

                        <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>

                        Tanya via WhatsApp

                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- RELATED PRODUCTS -->
    <?php if($relatedProducts->count() > 0): ?>

        <section class="py-12 bg-cream-50">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <h2 class="font-display text-2xl font-bold text-gray-900 mb-8">

                    Produk Terkait

                </h2>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $relatedProduct]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($relatedProduct)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $attributes = $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a)): ?>
<?php $component = $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a; ?>
<?php unset($__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        </section>

    <?php endif; ?>

    <!-- SCRIPT -->
    <script>
        let currentSlide = 0;

        function changeSlide(index, button = null) {

            currentSlide = index;

            const slider =
                document.getElementById('image-slider');

            slider.style.transform =
                `translateX(-${index * 100}%)`;

            // UPDATE BORDER THUMBNAIL
            document.querySelectorAll('.thumbnail-btn')
                .forEach(btn => {

                    btn.classList.remove('border-primary-500');

                    btn.classList.add('border-transparent');

                });

            if (button) {

                button.classList.remove('border-transparent');

                button.classList.add('border-primary-500');
            }
        }

        // QUANTITY
        function incrementQty(max) {

            const qty =
                document.getElementById('quantity');

            if (parseInt(qty.value) < max) {

                qty.value =
                    parseInt(qty.value) + 1;
            }
        }

        function decrementQty() {

            const qty =
                document.getElementById('quantity');

            if (parseInt(qty.value) > 1) {

                qty.value =
                    parseInt(qty.value) - 1;
            }
        }

        // SLIDER
        const slider =
            document.getElementById('image-slider');

        let startX = 0;
        let currentTranslate = 0;
        let isDragging = false;

        // TOUCH MOBILE
        slider.addEventListener('touchstart', touchStart);
        slider.addEventListener('touchmove', touchMove);
        slider.addEventListener('touchend', touchEnd);

        // DRAG DESKTOP
        slider.addEventListener('mousedown', dragStart);
        slider.addEventListener('mousemove', dragMove);
        slider.addEventListener('mouseup', dragEnd);
        slider.addEventListener('mouseleave', dragEnd);

        function touchStart(e) {

            startX =
                e.touches[0].clientX;
        }

        function touchMove(e) {

            const currentX =
                e.touches[0].clientX;

            currentTranslate =
                currentX - startX;
        }

        function touchEnd(e) {

            handleSwipe(
                e.changedTouches[0].clientX
            );
        }

        function dragStart(e) {

            isDragging = true;

            startX = e.clientX;

            slider.style.cursor = 'grabbing';
        }

        function dragMove(e) {

            if (!isDragging) return;

            const currentX = e.clientX;

            currentTranslate =
                currentX - startX;

            const moveX =
                (-currentSlide * slider.offsetWidth) +
                currentTranslate;

            slider.style.transition = 'none';

            slider.style.transform =
                `translateX(${moveX}px)`;
        }

        function dragEnd(e) {

            if (!isDragging) return;

            isDragging = false;

            slider.style.cursor = 'grab';

            slider.style.transition =
                'transform 0.3s ease-in-out';

            handleSwipe(e.clientX);
        }

        function handleSwipe(endX) {

            const totalSlides =
                document.querySelectorAll('#image-slider > div').length;

            // SWIPE LEFT
            if (startX - endX > 50 &&
                currentSlide < totalSlides - 1) {

                currentSlide++;
            }

            // SWIPE RIGHT
            else if (endX - startX > 50 &&
                currentSlide > 0) {

                currentSlide--;
            }

            changeSlide(currentSlide);

            // SYNC THUMBNAIL
            const thumbnails =
                document.querySelectorAll('.thumbnail-btn');

            thumbnails.forEach(btn => {

                btn.classList.remove('border-primary-500');

                btn.classList.add('border-transparent');

            });

            thumbnails[currentSlide]
                .classList.remove('border-transparent');

            thumbnails[currentSlide]
                .classList.add('border-primary-500');
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/products/show.blade.php ENDPATH**/ ?>
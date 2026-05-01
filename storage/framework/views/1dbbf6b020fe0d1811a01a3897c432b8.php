<?php $__env->startSection('title', 'Katalog Produk - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Katalog <span class="text-primary-600">Produk</span>
            </h1>
            <p class="text-gray-600 max-w-2xl">
                Temukan berbagai pilihan hantaran pernikahan elegan dan berkualitas
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <!-- Search -->
                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="w-full md:w-auto">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="<?php echo e(request('search')); ?>"
                               placeholder="Cari produk..." 
                               class="w-full md:w-80 pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                    </div>
                </form>
                
                <!-- Category Filter & Sort -->
                <div class="flex flex-wrap gap-3 w-full md:w-auto">
                    <!-- Category Dropdown -->
                    <select name="category" 
                            onchange="window.location.href = this.value ? '?category=' + this.value : '<?php echo e(route('products.index')); ?>'"
                            class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    
                    <!-- Sort Dropdown -->
                    <select name="sort" 
                            onchange="window.location.href = '?sort=' + this.value + '<?php echo e(request('category') ? '&category=' . request('category') : ''); ?><?php echo e(request('search') ? '&search=' . request('search') : ''); ?>'"
                            class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="latest" <?php echo e(request('sort') == 'latest' ? 'selected' : ''); ?>>Terbaru</option>
                        <option value="price_low" <?php echo e(request('sort') == 'price_low' ? 'selected' : ''); ?>>Harga: Rendah ke Tinggi</option>
                        <option value="price_high" <?php echo e(request('sort') == 'price_high' ? 'selected' : ''); ?>>Harga: Tinggi ke Rendah</option>
                        <option value="popular" <?php echo e(request('sort') == 'popular' ? 'selected' : ''); ?>>Populer</option>
                    </select>
                </div>
            </div>
            
            <!-- Active Filters -->
            <?php if(request('category') || request('search')): ?>
                <div class="flex flex-wrap gap-2 mb-6">
                    <?php if(request('category')): ?>
                        <?php
                            $cat = $categories->firstWhere('id', request('category'));
                        ?>
                        <?php if($cat): ?>
                            <span class="inline-flex items-center px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">
                                <?php echo e($cat->name); ?>

                                <a href="<?php echo e(route('products.index', array_diff_key(request()->all(), ['category' => 1]))); ?>" class="ml-2 hover:text-primary-900">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </a>
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(request('search')): ?>
                        <span class="inline-flex items-center px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">
                            "<?php echo e(request('search')); ?>"
                            <a href="<?php echo e(route('products.index', array_diff_key(request()->all(), ['search' => 1]))); ?>" class="ml-2 hover:text-primary-900">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <!-- Products Grid -->
            <?php if($products->count() > 0): ?>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal3fd2897c1d6a149cdb97b41db9ff827a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fd2897c1d6a149cdb97b41db9ff827a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
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
                
                <!-- Pagination -->
                <div class="mt-12">
                    <?php echo e($products->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="package-x" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700">
                        <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                        Lihat Semua Produk
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/products/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Edit Produk - ' . $product->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
                <p class="text-gray-600"><?php echo e($product->name); ?></p>
            </div>
        </div>

        <!-- Form -->
        <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" id="name" value="<?php echo e(old('name', $product->name)); ?>" 
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               required>
                        <?php $__errorArgs = ['name'];
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
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" id="category_id" 
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                required>
                            <option value="">Pilih Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['category_id'];
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
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="price" id="price" value="<?php echo e(old('price', $product->price)); ?>" min="0"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   required>
                            <?php $__errorArgs = ['price'];
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
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stock" id="stock" value="<?php echo e(old('stock', $product->stock)); ?>" min="0"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   required>
                            <?php $__errorArgs = ['stock'];
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
                    </div>
                    
                    <div>
                        <label for="min_order" class="block text-sm font-medium text-gray-700 mb-1">Minimum Order</label>
                        <input type="number" name="min_order" id="min_order" value="<?php echo e(old('min_order', $product->min_order)); ?>" min="1"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['min_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               required>
                        <?php $__errorArgs = ['min_order'];
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
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                                  class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  required><?php echo e(old('description', $product->description)); ?></textarea>
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
                </div>
                
                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                        <input type="file" name="main_image" id="main_image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 <?php $__errorArgs = ['main_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               onchange="previewMainImage(this)">
                        <?php $__errorArgs = ['main_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="mt-4">
                            <img id="main-image-preview" src="<?php echo e(asset('storage/' . $product->main_image)); ?>" alt="Current Image" class="max-w-full h-auto rounded-lg max-h-48">
                        </div>
                    </div>
                    
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gambar Tambahan</label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <p class="text-sm text-gray-500 mt-1">Dapat memilih multiple gambar</p>
                        
                        <?php if($product->images->count() > 0): ?>
                            <div class="mt-4 grid grid-cols-4 gap-2">
                                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative">
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="" class="w-full h-20 object-cover rounded-lg">
                                        <form action="<?php echo e(route('admin.products.delete-image', $image)); ?>" method="POST" class="absolute -top-2 -right-2">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Hapus gambar ini?')" class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">
                                                <i data-lucide="x" class="w-3 h-3"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?>

                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Produk Unggulan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?>

                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="<?php echo e(route('admin.products.index')); ?>" class="px-6 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                    Update Produk
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewMainImage(input) {
            const preview = document.getElementById('main-image-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Edit Produk - ' . $product->name); ?>

<?php $__env->startSection('content'); ?>

    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center gap-4">

            <a href="<?php echo e(route('admin.products.index')); ?>" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">

                <i data-lucide="arrow-left" class="w-5 h-5"></i>

            </a>

            <div>

                <h1 class="text-2xl font-bold text-gray-900">
                    Edit Produk
                </h1>

                <p class="text-gray-600">
                    <?php echo e($product->name); ?>

                </p>

            </div>

        </div>

        <!-- FORM -->
        <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid lg:grid-cols-2 gap-6">

                <!-- LEFT -->
                <div class="space-y-6">

                    <!-- Nama -->
                    <div>

                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">

                            Nama Produk

                        </label>

                        <input type="text" name="name" id="name" maxlength="20"
                            value="<?php echo e(old('name', $product->name)); ?>"
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
                            <p class="text-red-500 text-sm mt-1">
                                <?php echo e($message); ?>

                            </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>

                    <!-- Kategori -->
                    <div>

                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">

                            Kategori

                        </label>

                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>

                            <option value="">
                                Pilih Kategori
                            </option>

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>

                                    <?php echo e($category->name); ?>


                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>

                    <!-- Harga & Stok -->
                    <div class="grid grid-cols-2 gap-4">

                        <div>

                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">

                                Harga

                            </label>

                            <input type="number" name="price" id="price" value="<?php echo e(old('price', $product->price)); ?>"
                                min="0"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                required>

                        </div>

                        <div>

                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">

                                Stok

                            </label>

                            <input type="number" name="stock" id="stock" value="<?php echo e(old('stock', $product->stock)); ?>"
                                min="0"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                required>

                        </div>

                    </div>

                    <!-- Minimum Order -->
                    <div>

                        <label for="min_order" class="block text-sm font-medium text-gray-700 mb-1">

                            Minimum Order

                        </label>

                        <input type="number" name="min_order" id="min_order"
                            value="<?php echo e(old('min_order', $product->min_order)); ?>" min="1"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>

                    </div>

                    <!-- Deskripsi -->
                    <div>

                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">

                            Deskripsi

                        </label>

                        <textarea name="description" id="description" rows="5"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500" required><?php echo e(old('description', $product->description)); ?></textarea>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="space-y-6">

                    <!-- Upload -->
                    <div>

                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">

                            Gambar Produk

                        </label>

                        <input type="file" name="images[]" id="images" data-product-id="<?php echo e($product->id); ?>"
                            accept="image/*" multiple
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500">

                        <p class="text-sm text-gray-500 mt-2">
                            Bisa upload banyak gambar sekaligus (maksimal 10MB per gambar)
                        </p>

                        <!-- ERROR -->
                        <div id="upload-error" class="hidden mt-2 text-sm text-red-500">
                        </div>

                    </div>

                    <!-- GALLERY -->
                    <?php if($product->images->count() > 0): ?>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative group">

                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                        class="w-full h-32 object-cover rounded-xl border border-gray-200">

                                    <!-- THUMBNAIL -->
                                    <?php if($index === 0): ?>
                                        <div
                                            class="absolute top-2 left-2 bg-primary-500 text-white text-xs px-2 py-1 rounded-lg">

                                            Thumbnail

                                        </div>
                                    <?php endif; ?>

                                    <!-- DELETE -->
                                    <button type="button"
                                        onclick="openDeleteImageModal(
                                            '<?php echo e(route('admin.products.delete-image', [
                                                'product' => $product->id,
                                                'image' => $image->id,
                                            ])); ?>'
                                        )"
                                        class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-all">

                                        <i data-lucide="trash-2" class="w-4 h-4"></i>

                                    </button>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    <?php endif; ?>

                    <!-- CHECKBOX -->
                    <div class="flex gap-4">

                        <label class="flex items-center">

                            <input type="checkbox" name="is_featured" value="1"
                                <?php echo e(old('is_featured', $product->is_featured) ? 'checked' : ''); ?>

                                class="w-4 h-4 text-primary-600 border-gray-300 rounded">

                            <span class="ml-2 text-sm text-gray-700">
                                Produk Unggulan
                            </span>

                        </label>

                        <label class="flex items-center">

                            <input type="checkbox" name="is_active" value="1"
                                <?php echo e(old('is_active', $product->is_active) ? 'checked' : ''); ?>

                                class="w-4 h-4 text-primary-600 border-gray-300 rounded">

                            <span class="ml-2 text-sm text-gray-700">
                                Aktif
                            </span>

                        </label>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">

                <a href="<?php echo e(route('admin.products.index')); ?>"
                    class="px-6 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">

                    Batal

                </a>

                <button type="submit" class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600">

                    Update Produk

                </button>

            </div>

        </form>

    </div>

    <!-- DELETE MODAL -->
    <div id="deleteImageModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 mx-4">

            <div class="flex items-center justify-center w-14 h-14 mx-auto bg-red-100 rounded-full mb-4">

                <i data-lucide="trash-2" class="w-7 h-7 text-red-600"></i>

            </div>

            <h2 class="text-xl font-bold text-center text-gray-900 mb-2">
                Hapus Gambar
            </h2>

            <p class="text-gray-600 text-center mb-6">
                Yakin ingin menghapus gambar ini?
            </p>

            <div class="flex gap-3">

                <button type="button" onclick="closeDeleteImageModal()"
                    class="flex-1 px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">

                    Batal

                </button>

                <form id="deleteImageForm" method="POST" class="flex-1">

                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">

                        Ya, Hapus

                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>
        // =========================
        // DELETE MODAL
        // =========================

        function openDeleteImageModal(action) {

            const modal =
                document.getElementById('deleteImageModal');

            const form =
                document.getElementById('deleteImageForm');

            form.action = action;

            modal.classList.remove('hidden');

            modal.classList.add('flex');
        }

        function closeDeleteImageModal() {

            const modal =
                document.getElementById('deleteImageModal');

            modal.classList.add('hidden');

            modal.classList.remove('flex');
        }

        window.addEventListener('click', function(e) {

            const modal =
                document.getElementById('deleteImageModal');

            if (e.target === modal) {

                closeDeleteImageModal();
            }
        });

        // =========================
        // AUTO UPLOAD IMAGE
        // =========================

        document.getElementById('images')
            .addEventListener('change', async function(e) {

                const files = e.target.files;

                const errorBox =
                    document.getElementById('upload-error');

                errorBox.classList.add('hidden');

                // VALIDASI 10MB
                for (const file of files) {

                    if (file.size > 10 * 1024 * 1024) {

                        errorBox.innerText =
                            `${file.name} melebihi batas 10MB`;

                        errorBox.classList.remove('hidden');

                        return;
                    }
                }

                const formData = new FormData();

                for (const file of files) {

                    formData.append('images[]', file);
                }

                const productId =
                    this.dataset.productId;

                try {

                    const response = await fetch(
                        `/admin/products/${productId}/upload-images`, {
                            method: 'POST',
                            credentials: 'same-origin',

                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            },

                            body: formData
                        }
                    );

                    const result =
                        await response.json();

                    if (result.success) {

                        location.reload();
                    }

                } catch (error) {

                    errorBox.innerText =
                        'Gagal upload gambar';

                    errorBox.classList.remove('hidden');
                }
            });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>
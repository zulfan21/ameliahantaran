<?php $__env->startSection('title', 'Manajemen Kategori - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Kategori</h1>
                <p class="text-gray-600">Kelola kategori produk</p>
            </div>
            <button onclick="document.getElementById('create-modal').classList.remove('hidden')"
                class="inline-flex items-center bg-primary-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-600 transition-colors">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                Tambah Kategori
            </button>
        </div>

        <!-- Categories Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Nama</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Slug</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-500">Produk</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-500">Status</th>
                            <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i data-lucide="<?php echo e($category->icon ?? 'tag'); ?>"
                                                class="w-5 h-5 text-primary-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-900"><?php echo e($category->name); ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-gray-600"><?php echo e($category->slug); ?></td>
                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"><?php echo e($category->products_count); ?></span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="px-2 py-1 rounded-full text-sm <?php echo e($category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'); ?>">
                                        <?php echo e($category->is_active ? 'Aktif' : 'Nonaktif'); ?>

                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            onclick="editCategory(<?php echo e($category->id); ?>, '<?php echo e($category->name); ?>', '<?php echo e($category->slug); ?>', '<?php echo e($category->description); ?>', '<?php echo e($category->icon); ?>', <?php echo e($category->is_active ? 1 : 0); ?>)"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST"
                                            class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">
                                    Tidak ada kategori ditemukan
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-gray-100">
                <?php echo e($categories->links()); ?>

            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="create-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Kategori</h3>
                <button onclick="document.getElementById('create-modal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="2"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Lucide)</label>
                        <select name="icon"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                            <option value="gift">🎁 Gift</option>
                            <option value="package">📦 Package</option>
                            <option value="flower">🌸 Flower</option>
                            <option value="heart">❤️ Heart</option>
                            <option value="shopping-bag">🛍️ Shopping Bag</option>
                            <option value="star">⭐ Star</option>
                            <option value="sparkles">✨ Sparkles</option>
                            <option value="gem">💎 Gem</option>
                            <option value="box">📦 Box</option>
                            <option value="tag">🏷️ Tag</option>
                        </select>
                    </div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-4 h-4 text-primary-600 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Aktif</span>
                    </label>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('create-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Edit Kategori</h3>
                <button onclick="document.getElementById('edit-modal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="edit-form" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="edit-name"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="edit-description" rows="2"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Lucide)</label>
                        <input type="text" name="icon" id="edit-icon"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" id="edit-is_active" value="1"
                            class="w-4 h-4 text-primary-600 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Aktif</span>
                    </label>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editCategory(id, name, slug, description, icon, isActive) {
            document.getElementById('edit-form').action = '/admin/categories/' + id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-description').value = description || '';
            document.getElementById('edit-icon').value = icon || '';
            document.getElementById('edit-is_active').checked = isActive;
            document.getElementById('edit-modal').classList.remove('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>
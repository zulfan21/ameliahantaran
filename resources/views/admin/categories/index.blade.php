@extends('layouts.admin')

@section('title', 'Manajemen Kategori - Amelia Hantaran')

@section('content')
    <style>
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-scaleIn {
            animation: scaleIn 0.2s ease-out;
        }
    </style>

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
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i data-lucide="{{ $category->icon ?? 'tag' }}"
                                                class="w-5 h-5 text-primary-600"></i>
                                        </div>

                                        <span class="font-medium text-gray-900">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </td>

                                <td class="py-3 px-4 text-gray-600">
                                    {{ $category->slug }}
                                </td>

                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                        {{ $category->products_count }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-center">
                                    <span
                                        class="px-2 py-1 rounded-full text-sm {{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        <!-- Edit -->
                                        <button
                                            onclick="editCategory(
                                                {{ $category->id }},
                                                '{{ $category->name }}',
                                                '{{ $category->slug }}',
                                                '{{ $category->icon }}',
                                                {{ $category->is_active ? 1 : 0 }}
                                            )"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>

                                        <!-- Delete -->
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('admin.categories.destroy', $category) }}')"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">
                                    Tidak ada kategori ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-gray-100">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="create-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-xl max-w-md w-full p-6 animate-scaleIn">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Kategori
                </h3>

                <button onclick="document.getElementById('create-modal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama
                        </label>

                        <input type="text" name="name" maxlength="20"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Icon (Lucide)
                        </label>

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

                        <span class="ml-2 text-sm text-gray-700">
                            Aktif
                        </span>
                    </label>

                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('create-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">
                        Batal
                    </button>

                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-xl max-w-md w-full p-6 animate-scaleIn">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Kategori
                </h3>

                <button onclick="document.getElementById('edit-modal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama
                        </label>

                        <input type="text" name="name" id="edit-name" maxlength="20"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Icon (Lucide)
                        </label>

                        <input type="text" name="icon" id="edit-icon"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" id="edit-is_active" value="1"
                            class="w-4 h-4 text-primary-600 border-gray-300 rounded">

                        <span class="ml-2 text-sm text-gray-700">
                            Aktif
                        </span>
                    </label>

                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">
                        Batal
                    </button>

                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-2xl max-w-sm w-full p-6 animate-scaleIn">

            <div class="flex flex-col items-center text-center">

                <!-- Icon -->
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mb-4">
                    <i data-lucide="trash-2" class="w-8 h-8 text-red-600"></i>
                </div>

                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-900">
                    Hapus Kategori
                </h3>

                <!-- Description -->
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    Apakah Anda yakin ingin menghapus kategori ini?
                </p>

                <!-- Actions -->
                <div class="flex gap-3 mt-6 w-full">

                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition">
                        Batal
                    </button>

                    <form id="delete-form" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-red-500 text-white rounded-xl hover:bg-red-600 transition">
                            Hapus
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function editCategory(id, name, slug, icon, isActive) {
            document.getElementById('edit-form').action = '/admin/categories/' + id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-icon').value = icon || '';
            document.getElementById('edit-is_active').checked = isActive;

            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function openDeleteModal(url) {
            document.getElementById('delete-form').action = url;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
@endsection

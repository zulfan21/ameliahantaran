@extends('layouts.admin')

@section('title', 'Manajemen Produk - Amelia Hantaran')

@section('content')
    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Manajemen Produk
                </h1>

                <p class="text-gray-600">
                    Kelola produk hantaran Anda
                </p>
            </div>

            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center bg-primary-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-600 transition-colors">

                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>

                Tambah Produk

            </a>

        </div>

        <!-- FILTER -->
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">

            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap gap-4">

                <div class="flex-1 min-w-[200px]">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">

                </div>

                <select name="category" onchange="this.form.submit()"
                    class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>
                    @endforeach

                </select>

                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">

                    Reset

                </a>

            </form>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">
                                Produk
                            </th>

                            <th class="text-left py-3 px-4 font-medium text-gray-500">
                                Kategori
                            </th>

                            <th class="text-right py-3 px-4 font-medium text-gray-500">
                                Harga
                            </th>

                            <th class="text-center py-3 px-4 font-medium text-gray-500">
                                Stok
                            </th>

                            <th class="text-center py-3 px-4 font-medium text-gray-500">
                                Status
                            </th>

                            <th class="text-right py-3 px-4 font-medium text-gray-500">
                                Aksi
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50">

                                <!-- PRODUK -->
                                <td class="py-3 px-4">

                                    <div class="flex items-center gap-3">

                                        <img src="{{ $product->images->first()
                                            ? asset('storage/' . $product->images->first()->image_path)
                                            : asset('storage/' . $product->main_image) }}"
                                            alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover"
                                            onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=50&h=50&fit=crop'">

                                        <div>

                                            <p class="font-medium text-gray-900">
                                                {{ $product->name }}
                                            </p>

                                            @if ($product->is_featured)
                                                <span class="text-xs text-primary-600">
                                                    Unggulan
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                                <!-- KATEGORI -->
                                <td class="py-3 px-4">

                                    {{ $product->category->name }}

                                </td>

                                <!-- HARGA -->
                                <td class="py-3 px-4 text-right font-medium">

                                    {{ $product->formattedPrice() }}

                                </td>

                                <!-- STOK -->
                                <td class="py-3 px-4 text-center">

                                    <span
                                        class="px-2 py-1 rounded-full text-sm
                                    {{ $product->stock < 5 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">

                                        {{ $product->stock }}

                                    </span>

                                </td>

                                <!-- STATUS -->
                                <td class="py-3 px-4 text-center">

                                    <span
                                        class="px-2 py-1 rounded-full text-sm
                                    {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">

                                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}

                                    </span>

                                </td>

                                <!-- AKSI -->
                                <td class="py-3 px-4 text-right">

                                    <div class="flex items-center justify-end gap-2">

                                        <!-- EDIT -->
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">

                                            <i data-lucide="edit" class="w-4 h-4"></i>

                                        </a>

                                        <!-- DELETE -->
                                        <form id="delete-form-{{ $product->id }}"
                                            action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="py-8 text-center text-gray-500">

                                    Tidak ada produk ditemukan

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="p-4 border-t border-gray-100">

                {{ $products->links() }}

            </div>

        </div>

    </div>

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 mx-4">

            <div class="flex items-center justify-center w-14 h-14 mx-auto bg-red-100 rounded-full mb-4">

                <i data-lucide="trash-2" class="w-7 h-7 text-red-600"></i>

            </div>

            <h2 class="text-xl font-bold text-center text-gray-900 mb-2">

                Hapus Produk

            </h2>

            <p class="text-gray-600 text-center mb-6">

                Yakin ingin menghapus produk

                <span id="productName" class="font-semibold text-gray-900"></span>?

            </p>

            <div class="flex gap-3">

                <button onclick="closeDeleteModal()"
                    class="flex-1 px-4 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">

                    Batal

                </button>

                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">

                    Ya, Hapus

                </button>

            </div>

        </div>

    </div>

    <script>
        let selectedForm = null;

        function openDeleteModal(productId, productName) {

            selectedForm =
                document.getElementById(`delete-form-${productId}`);

            document.getElementById('productName')
                .textContent = productName;

            const modal =
                document.getElementById('deleteModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {

            const modal =
                document.getElementById('deleteModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('confirmDeleteBtn')
            .addEventListener('click', function() {

                if (selectedForm) {

                    selectedForm.submit();
                }
            });

        window.addEventListener('click', function(e) {

            const modal =
                document.getElementById('deleteModal');

            if (e.target === modal) {

                closeDeleteModal();
            }
        });
    </script>
@endsection

@extends('layouts.admin')

@section('title', 'Tambah Produk - Amelia Hantaran')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Produk</h1>
                <p class="text-gray-600">Tambah produk baru ke katalog</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            @csrf

            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="20"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('name') border-red-500 @enderror"
                            required>

                        <p class="text-xs text-gray-500 mt-1">
                            Maksimal 20 karakter
                        </p>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('category_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" min="0"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('price') border-red-500 @enderror"
                                required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}"
                                min="0"
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('stock') border-red-500 @enderror"
                                required>
                            @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="min_order" class="block text-sm font-medium text-gray-700 mb-1">Minimum Order</label>
                        <input type="number" name="min_order" id="min_order" value="{{ old('min_order', 1) }}"
                            min="1"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('min_order') border-red-500 @enderror"
                            required>
                        @error('min_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('description') border-red-500 @enderror"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">
                            Gambar Produk
                        </label>

                        <input type="file" name="images[]" id="images" accept="image/*" multiple
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('images') border-red-500 @enderror"
                            required>
                        <div id="image-preview" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                        </div>

                        <p class="text-sm text-gray-500 mt-1">
                            Bisa upload banyak gambar sekaligus
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Produk Unggulan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Spesifikasi</label>
                        <div id="specifications" class="space-y-2">
                            <div class="flex gap-2">
                                <input type="text" name="specifications[Material]" placeholder="Material"
                                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm">
                                <input type="text" name="specifications[Ukuran]" placeholder="Ukuran"
                                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm">
                            </div>
                            <div class="flex gap-2">
                                <input type="text" name="specifications[Warna]" placeholder="Warna"
                                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm">
                                <input type="text" name="specifications[Berat]" placeholder="Berat"
                                    class="flex-1 px-3 py-2 border border-gray-200 rounded-lg text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('images').addEventListener('change', function(e) {

            const preview = document.getElementById('image-preview');

            preview.innerHTML = '';

            const files = e.target.files;

            if (files.length > 0) {

                Array.from(files).forEach((file, index) => {

                    const reader = new FileReader();

                    reader.onload = function(event) {

                        const div = document.createElement('div');

                        div.className = 'relative';

                        div.innerHTML = `
                        <img src="${event.target.result}"
                             class="w-full h-40 object-cover rounded-xl border border-gray-200 shadow-sm">

                        ${index === 0
                            ? `<span class="absolute top-2 left-2 bg-primary-500 text-white text-xs px-2 py-1 rounded-lg">
                                        Thumbnail
                                   </span>`
                            : ''
                        }
                    `;

                        preview.appendChild(div);
                    }

                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
@endsection

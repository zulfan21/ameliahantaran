@extends('layouts.admin')

@section('title', 'Edit Produk - ' . $product->name)

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
                <p class="text-gray-600">{{ $product->name }}</p>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            @csrf
            @method('PUT')
            
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('name') border-red-500 @enderror"
                               required>
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
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('price') border-red-500 @enderror"
                                   required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('stock') border-red-500 @enderror"
                                   required>
                            @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="min_order" class="block text-sm font-medium text-gray-700 mb-1">Minimum Order</label>
                        <input type="number" name="min_order" id="min_order" value="{{ old('min_order', $product->min_order) }}" min="1"
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
                                  required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                        <input type="file" name="main_image" id="main_image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('main_image') border-red-500 @enderror"
                               onchange="previewMainImage(this)">
                        @error('main_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="mt-4">
                            <img id="main-image-preview" src="{{ asset('storage/' . $product->main_image) }}" alt="Current Image" class="max-w-full h-auto rounded-lg max-h-48">
                        </div>
                    </div>
                    
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Gambar Tambahan</label>
                        <input type="file" name="images[]" id="images" accept="image/*" multiple
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <p class="text-sm text-gray-500 mt-1">Dapat memilih multiple gambar</p>
                        
                        @if($product->images->count() > 0)
                            <div class="mt-4 grid grid-cols-4 gap-2">
                                @foreach($product->images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="w-full h-20 object-cover rounded-lg">
                                        <form action="{{ route('admin.products.delete-image', $image) }}" method="POST" class="absolute -top-2 -right-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus gambar ini?')" class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">
                                                <i data-lucide="x" class="w-3 h-3"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Produk Unggulan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
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
@endsection

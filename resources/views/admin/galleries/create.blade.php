@extends('layouts.admin')

@section('title', 'Tambah Foto Galeri')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.galleries.index') }}" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Foto Galeri</h1>
                <p class="text-gray-600">Unggah foto baru untuk ditampilkan di halaman galeri</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Foto <span class="text-red-500">*</span></label>
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/webp" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 
                                  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold 
                                  file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, WEBP. Ukuran maksimal 2MB.</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                           placeholder="Contoh: Hantaran Pernikahan Rina & Doni">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                              placeholder="Tambahkan keterangan singkat tentang foto ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Kategori / Tipe <span class="text-red-500">*</span></label>
                    <select name="type" id="type" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="wedding" {{ old('type') == 'wedding' ? 'selected' : '' }}>Pernikahan (Wedding)</option>
                        <option value="product" {{ old('type') == 'product' ? 'selected' : '' }}>Produk (Product)</option>
                        <option value="behind_the_scenes" {{ old('type') == 'behind_the_scenes' ? 'selected' : '' }}>Di Balik Layar (Behind the Scenes)</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 text-primary-600 rounded border-gray-300 focus:ring-primary-500" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700">Tampilkan foto ini di halaman galeri publik</span>
                    </label>
                    @error('is_active')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.galleries.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition-colors">
                        <i data-lucide="upload-cloud" class="w-5 h-5 inline mr-1"></i>
                        Simpan & Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
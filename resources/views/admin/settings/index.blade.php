@extends('layouts.admin')

@section('title', 'Pengaturan - Amelia Hantaran')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pengaturan</h1>
            <p class="text-gray-600">Konfigurasi website dan informasi bisnis</p>
        </div>

        <!-- Settings Form -->
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            @csrf

            <!-- Company Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                    Informasi Perusahaan
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <!-- Nama Perusahaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Perusahaan
                        </label>

                        <input type="text" name="company_name" maxlength="20"
                            value="{{ $settings['company_name'] ?? 'Amelia Hantaran' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            required>

                        <p class="text-xs text-gray-400 mt-1">
                            Maksimal 20 karakter
                        </p>
                    </div>

                    <!-- Tagline -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tagline
                        </label>

                        <input type="text" name="company_tagline" maxlength="50"
                            value="{{ $settings['company_tagline'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">

                        <p class="text-xs text-gray-400 mt-1">
                            Maksimal 50 karakter
                        </p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>

                        <textarea name="company_description" rows="3"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">{{ $settings['company_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                    Kontak
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat
                        </label>

                        <textarea name="company_address" rows="2"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">{{ $settings['company_address'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Telepon
                        </label>

                        <input type="text" name="company_phone" value="{{ $settings['company_phone'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>

                        <input type="email" name="company_email" value="{{ $settings['company_email'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            WhatsApp (62xxx)
                        </label>

                        <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Google Maps URL
                        </label>

                        <input type="url" name="google_maps" value="{{ $settings['google_maps'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                    Pembayaran
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Bank
                        </label>

                        <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor Rekening
                        </label>

                        <input type="text" name="bank_account" value="{{ $settings['bank_account'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Atas Nama
                        </label>

                        <input type="text" name="bank_account_name" value="{{ $settings['bank_account_name'] ?? '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Ongkir Default (Rp)
                        </label>

                        <input type="number" name="shipping_cost" value="{{ $settings['shipping_cost'] ?? 15000 }}"
                            min="0"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    </div>

                    <!-- QRIS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            QRIS
                        </label>

                        <input type="file" name="qris_image" class="w-full border rounded-lg p-2">

                        <!-- Preview Cropper -->
                        <div class="mt-4">
                            <img id="preview" class="max-w-sm hidden rounded-lg border">
                        </div>

                        <p class="text-xs text-gray-500 mt-2">
                            Geser area QR code lalu klik tombol Crop QRIS
                        </p>

                        <button type="button" id="crop-button"
                            class="mt-3 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 hidden">
                            Crop QRIS
                        </button>

                        <div class="mt-4 hidden" id="cropped-result">
                            <p class="text-sm text-gray-500 mb-2">
                                Hasil Crop
                            </p>

                            <img id="cropped-preview" class="w-40 rounded-lg border">
                        </div>

                        <input type="hidden" name="cropped_qris" id="cropped_qris">

                        @if (!empty($settings['qris_image']))
                            <div class="mt-4">
                                <p class="text-sm text-gray-500 mb-2">
                                    QRIS Saat Ini
                                </p>

                                <img src="{{ asset('storage/' . $settings['qris_image']) . '?v=' . time() }}"
                                    class="w-40 rounded-lg border">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">

                    <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>

                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <!-- Cropper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

    <script>
        let cropper;

        const input = document.querySelector('input[name="qris_image"]');
        const preview = document.getElementById('preview');
        const cropButton = document.getElementById('crop-button');
        const croppedInput = document.getElementById('cropped_qris');
        const croppedPreview = document.getElementById('cropped-preview');
        const croppedResult = document.getElementById('cropped-result');

        input.addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(event) {

                preview.src = event.target.result;

                preview.classList.remove('hidden');

                cropButton.classList.remove('hidden');

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(preview, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };

            reader.readAsDataURL(file);
        });

        cropButton.addEventListener('click', function() {

            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500
            });

            const croppedData = canvas.toDataURL('image/png');

            // simpan ke hidden input
            croppedInput.value = croppedData;

            // preview hasil crop
            croppedPreview.src = croppedData;

            croppedResult.classList.remove('hidden');

            // sembunyikan area crop
            preview.classList.add('hidden');

            // sembunyikan tombol crop
            cropButton.classList.add('hidden');

            // destroy cropper
            cropper.destroy();

            cropper = null;
        });
    </script>
@endsection

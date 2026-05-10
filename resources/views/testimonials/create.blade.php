@extends('layouts.app')

@section('title', 'Tulis Testimoni - Amelia Hantaran')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="w-full max-w-lg px-4">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display text-2xl font-bold text-gray-900">Tulis Testimoni</h1>
                    <p class="text-gray-500 mt-2">Bagikan pengalaman Anda dengan kami</p>
                </div>

                <!-- Form -->
                <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    @if ($orders->count() > 0)
                        <div>
                            <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Pesanan</label>
                            <select name="order_id" id="order_id"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                                <option value="">Pilih pesanan (opsional)</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_number }} -
                                        {{ $order->created_at->format('d M Y') }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <div class="flex gap-2" id="rating-stars">

                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" class="star-btn" data-value="{{ $i }}">

                                    <i data-lucide="star"
                                        class="star-icon w-8 h-8 text-gray-300 transition-all duration-200">
                                    </i>
                                </button>
                            @endfor

                            <input type="hidden" name="rating" id="rating" value="5">
                        </div>
                        @error('rating')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Testimoni</label>
                        <textarea name="content" id="content" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500 @error('content') border-red-500 @enderror"
                            placeholder="Ceritakan pengalaman Anda..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="wedding_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pernikahan
                            (Opsional)</label>
                        <input type="text" name="wedding_date" id="wedding_date" value="{{ old('wedding_date') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                            placeholder="Pilih tanggal pernikahan">
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <p class="text-sm text-gray-500 mt-1">Upload foto momen spesial Anda</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary-500 text-white py-3 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        Kirim Testimoni
                    </button>
                </form>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        const stars = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating');

        function updateStars(rating) {

            stars.forEach((star, index) => {

                const icon = star.querySelector('.star-icon');

                if (index < rating) {
                    icon.classList.remove('text-gray-300');
                    icon.classList.add('text-yellow-400', 'fill-yellow-400');
                } else {
                    icon.classList.remove('text-yellow-400', 'fill-yellow-400');
                    icon.classList.add('text-gray-300');
                }
            });
        }

        flatpickr("#wedding_date", {
            locale: "id",
            dateFormat: "d F Y",
            defaultDate: "today",
            allowInput: false
        });

        // default 5 bintang
        updateStars(5);

        stars.forEach((star) => {

            star.addEventListener('click', function() {

                const value = this.dataset.value;

                ratingInput.value = value;

                updateStars(value);
            });
        });
    </script>
@endsection

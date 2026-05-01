@extends('layouts.app')

@section('title', 'Galeri - Amelia Hantaran')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Galeri <span class="text-primary-600">Kami</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Koleksi foto hasil karya dan momen bahagia pelanggan kami
            </p>
        </div>
    </section>

    <!-- Gallery -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galleries->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galleries as $gallery)
                        <div class="group relative aspect-square rounded-xl overflow-hidden cursor-pointer" onclick="openModal('{{ asset('storage/' . $gallery->image_path) }}', '{{ $gallery->title }}')">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=400&fit=crop'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h3 class="text-white font-semibold">{{ $gallery->title }}</h3>
                                    @if($gallery->description)
                                        <p class="text-white/80 text-sm">{{ $gallery->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-12">
                    {{ $galleries->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="image" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Galeri Kosong</h2>
                    <p class="text-gray-600">Belum ada foto di galeri</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" onclick="closeModal()">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300">
            <i data-lucide="x" class="w-8 h-8"></i>
        </button>
        <div class="max-w-4xl max-h-[90vh]" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-lg">
            <p id="modalTitle" class="text-white text-center mt-4 text-lg"></p>
        </div>
    </div>

    <script>
        function openModal(src, title) {
            document.getElementById('modalImage').src = src;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = '';
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
@endsection

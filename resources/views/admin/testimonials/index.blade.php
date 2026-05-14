@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

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
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Testimoni</h1>
                <p class="text-gray-600">Terima atau tolak testimoni dari pelanggan</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="p-4 font-semibold text-gray-600 text-sm">Pelanggan</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Rating</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Isi Testimoni</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Status</th>
                            <th class="p-4 font-semibold text-gray-600 text-sm">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($testimonials as $testimonial)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <!-- Pelanggan -->
                                <td class="p-4">
                                    <p class="font-medium text-gray-900">
                                        {{ $testimonial->user->name ?? 'Pelanggan' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $testimonial->created_at->format('d M Y') }}
                                    </p>
                                </td>

                                <!-- Rating -->
                                <td class="p-4">
                                    <div class="flex items-center text-yellow-400">
                                        {{ $testimonial->rating }}

                                        <i data-lucide="star" class="w-4 h-4 ml-1 fill-current"></i>
                                    </div>
                                </td>

                                <!-- Isi -->
                                <td class="p-4">

                                    @if ($testimonial->photo)
                                        <!-- Thumbnail -->
                                        <div class="w-20 h-20 rounded-lg overflow-hidden cursor-pointer border border-gray-200"
                                            onclick="
                                                document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.remove('hidden');
                                                document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.add('flex');
                                            ">

                                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Foto Testimoni"
                                                class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                        </div>

                                        <!-- Modal Preview -->
                                        <div id="admin-testimonial-modal-{{ $testimonial->id }}"
                                            class="hidden fixed inset-0 z-[9999] bg-black/90 items-center justify-center p-4">

                                            <!-- Overlay -->
                                            <div class="absolute inset-0"
                                                onclick="
                                                    document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.add('hidden');
                                                    document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.remove('flex');
                                                ">
                                            </div>

                                            <!-- Content -->
                                            <div class="relative z-10 flex flex-col items-end max-w-6xl w-full">

                                                <!-- Close -->
                                                <button
                                                    onclick="
                                                        document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.add('hidden');
                                                        document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.remove('flex');
                                                    "
                                                    class="mb-4 px-4 py-2 bg-black/50 text-white rounded-full hover:text-red-500 transition-colors">
                                                    Tutup
                                                </button>

                                                <!-- Image -->
                                                <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                                    class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl border border-white/10">
                                            </div>
                                        </div>
                                    @endif

                                    <p class="text-gray-600 mb-6 italic">
                                        "{{ $testimonial->content }}"
                                    </p>
                                </td>

                                <!-- Status -->
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $testimonial->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $testimonial->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $testimonial->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">

                                        {{ ucfirst($testimonial->status ?? 'pending') }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="p-4">
                                    <div class="flex gap-2 flex-wrap">

                                        @if ($testimonial->status === 'pending')
                                            <!-- Approve -->
                                            <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-green-500 text-white rounded text-sm hover:bg-green-600">
                                                    Setujui
                                                </button>
                                            </form>

                                            <!-- Reject -->
                                            <form action="{{ route('admin.testimonials.reject', $testimonial->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="px-3 py-1.5 border border-red-500 text-red-500 rounded text-sm hover:bg-red-50">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete -->
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('admin.testimonials.destroy', $testimonial->id) }}')"
                                            class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                            Hapus
                                        </button>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">

                                    <i data-lucide="message-square" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>

                                    Belum ada testimoni dari pelanggan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($testimonials->hasPages())
                <div class="p-4 border-t border-gray-100">
                    {{ $testimonials->links() }}
                </div>
            @endif
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
                    Hapus Testimoni
                </h3>

                <!-- Description -->
                <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                    Apakah Anda yakin ingin menghapus testimoni ini?
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
        function openDeleteModal(url) {
            document.getElementById('delete-form').action = url;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
@endsection

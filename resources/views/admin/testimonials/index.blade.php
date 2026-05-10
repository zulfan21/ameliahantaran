@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
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
                                <td class="p-4">
                                    <p class="font-medium text-gray-900">{{ $testimonial->user->name ?? 'Pelanggan' }}</p>
                                    <p class="text-xs text-gray-500">{{ $testimonial->created_at->format('d M Y') }}</p>
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center text-yellow-400">
                                        {{ $testimonial->rating }} <i data-lucide="star"
                                            class="w-4 h-4 ml-1 fill-current"></i>
                                    </div>
                                </td>

                                <td class="p-4">
                                    @if ($testimonial->photo)
                                        <!-- Thumbnail -->
                                        <div class="w-20 h-20 rounded-lg overflow-hidden cursor-pointer border border-gray-200"
                                            onclick="document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.remove('hidden');
                                            document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.add('flex');">

                                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Foto Testimoni"
                                                class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                        </div>

                                        <!-- Modal -->
                                        <div id="admin-testimonial-modal-{{ $testimonial->id }}"
                                            class="hidden fixed inset-0 z-[9999] bg-black/90 items-center justify-center p-4">

                                            <!-- Overlay -->
                                            <div class="absolute inset-0"
                                                onclick="document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.add('hidden');
                                                document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.remove('flex');">
                                            </div>

                                            <!-- Content -->
                                            <div class="relative z-10 flex flex-col items-end max-w-6xl w-full">

                                                <!-- Close -->
                                                <button
                                                    onclick="document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.add('hidden');
                                                    document.getElementById('admin-testimonial-modal-{{ $testimonial->id }}').classList.remove('flex');"
                                                    class="mb-4 px-4 py-2 bg-black/50 text-white rounded-full hover:text-red-500 transition-colors">

                                                    Tutup
                                                </button>

                                                <!-- Image -->
                                                <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                                    class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl border border-white/10">
                                            </div>
                                        </div>
                                    @endif

                                    <p class="text-gray-600 mb-6 italic">"{{ $testimonial->content }}"</p>
                                    </p>
                                </td>

                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $testimonial->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $testimonial->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $testimonial->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($testimonial->status ?? 'pending') }}
                                    </span>
                                </td>

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

                                        <!-- DELETE (SELALU ADA) -->
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>

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
@endsection

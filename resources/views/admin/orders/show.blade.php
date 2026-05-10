@extends('layouts.admin')

@section('title', 'Detail Pesanan ' . $order->order_number)

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $order->order_number }}</h1>
                    <p class="text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <span
                class="px-4 py-2 bg-{{ $order->status_color }}-100 text-{{ $order->status_color }}-700 rounded-full text-sm font-medium">
                {{ $order->status_label }}
            </span>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-semibold text-lg text-gray-900 mb-4">Item Pesanan</h2>
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex items-center gap-4 py-3 border-b border-gray-100 last:border-0">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if ($item->product)
                                        <img src="{{ asset('storage/' . $item->product->main_image) }}"
                                            alt="{{ $item->product_name }}" class="w-full h-full object-cover"
                                            onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=100&h=100&fit=crop'">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                            <i data-lucide="package" class="w-8 h-8 text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900">{{ $item->product_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} x {{ $item->formattedPrice() }}
                                    </p>
                                </div>
                                <span class="font-semibold text-gray-900">{{ $item->formattedSubtotal() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-semibold text-lg text-gray-900 mb-4">Informasi Pelanggan</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm text-gray-500">Nama</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Email</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_email }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Telepon</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-sm text-gray-500">Alamat</span>
                            <p class="font-medium text-gray-900">{{ $order->customer_address }}</p>
                        </div>
                        @if ($order->notes)
                            <div class="sm:col-span-2">
                                <span class="text-sm text-gray-500">Catatan</span>
                                <p class="font-medium text-gray-900">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Proofs -->
                @if ($order->paymentProofs->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Bukti Pembayaran</h2>
                        <div class="space-y-4">
                            @foreach ($order->paymentProofs as $proof)
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">

                                    <div onclick="document.getElementById('modal-admin-{{ $loop->index }}').classList.remove('hidden'); document.getElementById('modal-admin-{{ $loop->index }}').classList.add('flex');"
                                        title="Klik untuk memperbesar"
                                        class="block w-32 h-32 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0 hover:opacity-75 hover:ring-2 hover:ring-primary-500 transition-all cursor-pointer">
                                        <img src="{{ asset('storage/' . $proof->image_path) }}" alt="Bukti Pembayaran"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div id="modal-admin-{{ $loop->index }}"
                                        class="hidden fixed inset-0 z-[9999] bg-black/90 items-center justify-center p-4 transition-all">

                                        <div onclick="document.getElementById('modal-admin-{{ $loop->index }}').classList.add('hidden'); document.getElementById('modal-admin-{{ $loop->index }}').classList.remove('flex');"
                                            class="absolute inset-0 cursor-pointer"></div>

                                        <div class="relative z-10 flex flex-col items-end">
                                            <button
                                                onclick="document.getElementById('modal-admin-{{ $loop->index }}').classList.add('hidden'); document.getElementById('modal-admin-{{ $loop->index }}').classList.remove('flex');"
                                                class="mb-4 text-white hover:text-red-500 font-bold text-lg flex items-center gap-2 cursor-pointer bg-black/50 px-4 py-2 rounded-full transition-colors">
                                                <i data-lucide="x" class="w-5 h-5"></i> Tutup
                                            </button>

                                            <img src="{{ asset('storage/' . $proof->image_path) }}"
                                                class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full font-medium
                                                {{ $proof->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ $proof->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                {{ $proof->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                                {{ ucfirst($proof->status) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">Jumlah: Rp
                                            {{ number_format($proof->amount, 0, ',', '.') }}</p>
                                        @if ($proof->bank_name)
                                            <p class="text-sm text-gray-600">Bank: {{ $proof->bank_name }}</p>
                                        @endif
                                        @if ($proof->account_name)
                                            <p class="text-sm text-gray-600">Nama: {{ $proof->account_name }}</p>
                                        @endif
                                        <p class="text-sm text-gray-500">{{ $proof->created_at->format('d M Y H:i') }}</p>

                                        @if ($proof->status === 'pending')
                                            <div class="flex gap-2 mt-3">
                                                <form action="{{ route('admin.payments.verify', $proof) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <input type="hidden" name="action" value="approve">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-500 text-white rounded-lg text-sm font-medium hover:bg-green-600">
                                                        <i data-lucide="check" class="w-4 h-4 inline mr-1"></i>
                                                        Setuju
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.payments.verify', $proof) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <input type="hidden" name="action" value="reject">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600">
                                                        <i data-lucide="x" class="w-4 h-4 inline mr-1"></i>
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-semibold text-lg text-gray-900 mb-4">Ringkasan</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>{{ $order->formattedSubtotal() }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkir</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">Total</span>
                                <span class="text-xl font-bold text-primary-600">{{ $order->formattedTotal() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Status -->
                @if ($order->status !== 'selesai' && $order->status !== 'dibatalkan')
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="font-semibold text-lg text-gray-900 mb-4">Update Status</h2>
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status"
                                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="waiting_payment"
                                            {{ $order->status == 'waiting_payment' ? 'selected' : '' }}>Menunggu Pembayaran
                                        </option>
                                        <option value="payment_verification"
                                            {{ $order->status == 'payment_verification' ? 'selected' : '' }}>Verifikasi
                                            Pembayaran</option>
                                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>
                                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>
                                            Dikirim
                                        </option>
                                        <option value="cancel_request"
                                            {{ $order->status == 'cancel_request' ? 'selected' : '' }}>
                                            Request Pembatalan
                                        </option>
                                        <option value="cancel_rejected"
                                            {{ $order->status == 'cancel_rejected' ? 'selected' : '' }}>
                                            Pembatalan Ditolak
                                        </option>
                                    </select>
                                </div>

                                @if ($order->status === 'diproses' || $order->status === 'dikirim')
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Resi</label>
                                        <input type="text" name="tracking_number"
                                            value="{{ $order->tracking_number }}"
                                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500"
                                            placeholder="Masukkan nomor resi">
                                    </div>
                                @endif

                                <button type="submit"
                                    class="w-full bg-primary-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-600 transition-colors">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-semibold text-lg text-gray-900 mb-4">Timeline</h2>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pesanan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @if ($order->paid_at)
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pembayaran Diterima</p>
                                    <p class="text-xs text-gray-500">{{ $order->paid_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($order->status === 'cancel_rejected')
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>

                                <div>
                                    <p class="text-sm font-medium text-orange-600">
                                        Pembatalan Ditolak
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Pesanan tetap diproses
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        {{ $order->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if ($order->processed_at)
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>

                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        Pesanan Diproses
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $order->processed_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if ($order->shipped_at)
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan Dikirim</p>
                                    <p class="text-xs text-gray-500">{{ $order->shipped_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($order->completed_at)
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan Selesai</p>
                                    <p class="text-xs text-gray-500">{{ $order->completed_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($order->status === 'dibatalkan')
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan Dibatalkan</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $order->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($order->status === 'cancel_request')
                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-6 mt-6">

                        <h3 class="font-semibold text-orange-700 text-lg mb-2">
                            Request Pembatalan
                        </h3>

                        <p class="text-sm text-orange-600 mb-4">
                            Customer mengajukan pembatalan pesanan ini.
                        </p>

                        @if ($order->cancel_reason)
                            <div class="bg-white/70 rounded-lg p-4 mb-4">
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Alasan Pembatalan
                                </p>

                                <p class="text-sm text-gray-600">
                                    {{ $order->cancel_reason }}
                                </p>
                            </div>
                        @endif

                        <div class="flex gap-3">

                            <form action="{{ route('admin.orders.approve-cancel', $order) }}" method="POST">

                                @csrf

                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">

                                    Setujui Pembatalan
                                </button>
                            </form>

                            <form action="{{ route('admin.orders.reject-cancel', $order) }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">

                                    Tolak
                                </button>
                            </form>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

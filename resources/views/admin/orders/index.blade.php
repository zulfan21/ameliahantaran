@extends('layouts.admin')

@section('title', 'Manajemen Pesanan - Amelia Hantaran')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Pesanan</h1>
            <p class="text-gray-600">Kelola dan verifikasi pesanan pelanggan</p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor/nama/email..." 
                           class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
                <select name="status" onchange="this.form.submit()" class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="waiting_payment" {{ request('status') == 'waiting_payment' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="payment_verification" {{ request('status') == 'payment_verification' ? 'selected' : '' }}>Verifikasi Pembayaran</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">
                    Reset
                </a>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Nomor</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Pelanggan</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Tanggal</th>
                            <th class="text-right py-3 px-4 font-medium text-gray-500">Total</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-500">Status</th>
                            <th class="text-right py-3 px-4 font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium">{{ $order->order_number }}</td>
                                <td class="py-3 px-4">
                                    <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->customer_phone }}</p>
                                </td>
                                <td class="py-3 px-4">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td class="py-3 px-4 text-right font-medium">{{ $order->formattedTotal() }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-{{ $order->status_color }}-100 text-{{ $order->status_color }}-700">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-500">
                                    Tidak ada pesanan ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="p-4 border-t border-gray-100">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection

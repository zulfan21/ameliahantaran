<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentProof;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'paymentProofs', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (in_array($order->status, ['selesai', 'dibatalkan'])) {
            return redirect()->back()->with('error', 'Status pesanan tidak dapat diubah lagi.');
        }

    $request->validate([
        'status' => ['required', 'in:pending,waiting_payment,payment_verification,diproses,dikirim,selesai,dibatalkan,cancel_rejected'],
        'tracking_number' => ['nullable', 'string', 'max:100'],
    ]);

    $currentStatus = $order->status;
    $newStatus = $request->status;

    /*
    |--------------------------------------------------------------------------
    | Pesanan belum dibayar / diverifikasi
    |--------------------------------------------------------------------------
    */

    if (
        in_array($newStatus, ['diproses', 'dikirim', 'selesai']) &&
        $order->payment_status !== 'paid'
    ) {
        return back()->with(
            'error',
            'Pesanan tidak dapat diproses sebelum pembayaran disetujui.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Validasi perpindahan status
    |--------------------------------------------------------------------------
    */

    $allowedTransitions = [
        'pending' => ['waiting_payment', 'dibatalkan'],

        'waiting_payment' => [
            'payment_verification',
            'dibatalkan'
        ],

        'payment_verification' => [
            'diproses',
            'dibatalkan'
        ],

        'diproses' => [
            'dikirim',
            'dibatalkan',
            'cancel_rejected'
        ],

        'cancel_rejected' => [
            'dikirim',
            'selesai'
        ],

        'dikirim' => [
            'selesai'
        ],

        'selesai' => [],

        'dibatalkan' => [],
    ];

    if (!in_array($newStatus, $allowedTransitions[$currentStatus] ?? [])) {
        return back()->with(
            'error',
            'Perubahan status tidak valid.'
        );
    }

        $updateData = ['status' => $request->status];

        // Set timestamps based on status
        switch ($request->status) {
            case 'diproses':
                $updateData['processed_at'] = now();
                break;
            case 'dikirim':
                $updateData['shipped_at'] = now();
                $updateData['tracking_number'] = $request->tracking_number;
                break;
            case 'selesai':
                $updateData['completed_at'] = now();
                break;
        }

        $order->update($updateData);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function verifyPayment(Request $request, PaymentProof $paymentProof)
    {
        $request->validate([
            'action' => ['required', 'in:approve,reject'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        if ($request->action === 'approve') {
            $paymentProof->approve(auth()->id(), $request->admin_notes);
            $message = 'Bukti pembayaran berhasil disetujui.';
        } else {
            $paymentProof->reject(auth()->id(), $request->admin_notes);
            $message = 'Bukti pembayaran ditolak.';
        }

        return redirect()->back()->with('success', $message);
    }
    
    public function approveCancel(Order $order)
    {
        $order->update([
            'status' => 'dibatalkan'
        ]);

        return back()->with('success', 'Pembatalan disetujui.');
    }

    public function rejectCancel(Order $order)
    {
        $order->status = 'cancel_rejected';
        $order->cancel_rejected = true;

        $order->save();

        return back()->with(
            'success',
            'Permintaan pembatalan ditolak.'
        );
    }
}

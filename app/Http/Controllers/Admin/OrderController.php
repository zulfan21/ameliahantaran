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
        $request->validate([
            'status' => ['required', 'in:pending,waiting_payment,payment_verification,diproses,dikirim,selesai,dibatalkan'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
        ]);

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
}

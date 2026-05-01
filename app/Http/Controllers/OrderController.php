<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentProofRequest;
use App\Models\Order;
use App\Models\PaymentProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product', 'paymentProofs'])
            ->firstOrFail();

        // Check if user owns this order
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function uploadPayment(PaymentProofRequest $request, $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if (!$order->canUploadPayment()) {
            return redirect()->back()->with('error', 'Tidak dapat mengupload bukti pembayaran untuk pesanan ini.');
        }

        // Upload image
        $imagePath = $request->file('image')->store('payment_proofs', 'public');

        PaymentProof::create([
            'order_id' => $order->id,
            'image_path' => $imagePath,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        $order->update([
            'status' => 'payment_verification',
            'payment_status' => 'waiting_verification',
        ]);

        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }

    public function cancel($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!$order->canBeCancelled()) {
            return redirect()->back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
        }

        // Restore stock
        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        $order->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}

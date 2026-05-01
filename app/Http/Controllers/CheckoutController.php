<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $shippingCost = Setting::get('shipping_cost', 15000);
        $grandTotal = $total + $shippingCost;

        return view('checkout.index', compact('cart', 'total', 'shippingCost', 'grandTotal'));
    }

    public function store(CheckoutRequest $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingCost = Setting::get('shipping_cost', 15000);
        $total = $subtotal + $shippingCost;

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-'.date('Ymd').'-'.strtoupper(Str::random(6)),
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'notes' => $request->notes,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'status' => 'waiting_payment',
            'payment_status' => 'unpaid',
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // Decrease stock
            $product = Product::find($item['id']);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('checkout.payment', $order->order_number);
    }

    public function payment($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if ($order->status !== 'waiting_payment') {
            return redirect()->route('orders.show', $order->order_number);
        }

        $bankInfo = [
            'name' => Setting::get('bank_name', 'Bank Central Asia'),
            'account' => Setting::get('bank_account', '1234567890'),
            'account_name' => Setting::get('bank_account_name', 'PT Amelia Hantaran'),
        ];

        $settings = Setting::getGroup('payment');

        return view('checkout.payment', compact('order', 'bankInfo', 'settings'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $itemCount = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $itemCount += $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total', 'itemCount'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if (!$product->isInStock()) {
            return redirect()->back()->with('error', 'Produk tidak tersedia.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + ($request->quantity ?? 1);
            
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia.');
            }
            
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $quantity = $request->quantity ?? 1;
            
            if ($quantity > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia.');
            }

            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->main_image,
                'stock' => $product->stock,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::find($productId);
        
        if ($request->quantity > $product->stock) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $cart[$productId]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return response()->json(['count' => $count]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('stock') && $request->stock === 'low') {
            $query->where('stock', '<', 5);
        }

        $products = $query->latest()->paginate(20)->withQueryString();
        $categories = Category::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('sort_order')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $mainImage = null;

        // Upload multiple images
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                $path = $image->store('products', 'public');

                // gambar pertama jadi thumbnail utama
                if ($index === 0) {
                    $mainImage = $path;
                }

                $uploadedImages[] = [
                    'image_path' => $path,
                    'sort_order' => $index,
                ];
            }
        }

        // simpan thumbnail utama
        $data['main_image'] = $mainImage;

        // hapus images dari data agar tidak error
        unset($data['images']);

        $product = Product::create($data);

        // simpan semua gambar ke tabel product_images
        if (!empty($uploadedImages)) {

            foreach ($uploadedImages as $image) {

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image['image_path'],
                    'sort_order' => $image['sort_order'],
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->orderBy('sort_order')->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Upload new main image if provided
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product->update($data);

        // Upload additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image->store('products', 'public'),
                    'sort_order' => $product->images->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => [
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:10240'
            ],
        ]);

        foreach ($request->file('images') as $index => $image) {

            $path = $image->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'sort_order' => $product->images()->count() + $index,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy(Product $product)
    {
        // Delete images
        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function deleteImage(Product $product, ProductImage $image)
    {
        // cek apakah gambar ini thumbnail utama
        $isMainImage = $product->main_image === $image->image_path;

        // hapus file
        Storage::disk('public')->delete($image->image_path);

        // hapus database
        $image->delete();

        // refresh relasi gambar
        $product->load('images');

        // jika thumbnail dihapus
        if ($isMainImage) {

            // ambil gambar pertama tersisa
            $nextImage = $product->images()
                ->orderBy('sort_order')
                ->first();

            // update thumbnail baru
            $product->update([
                'main_image' => $nextImage
                    ? $nextImage->image_path
                    : null
            ]);
        }

        return redirect()->back()
            ->with('success', 'Gambar berhasil dihapus.');
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->update(['stock' => $request->stock]);

        return redirect()->back()->with('success', 'Stok berhasil diperbarui.');
    }
}

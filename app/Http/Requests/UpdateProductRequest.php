<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $productId = $this->route('product');

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,' . $productId],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_order' => ['required', 'integer', 'min:1'],
            'main_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'specifications' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'name.required' => 'Nama produk wajib diisi.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok wajib diisi.',
        ];
    }
}

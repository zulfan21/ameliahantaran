<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:20'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($this->category),
            ],

            'icon' => ['nullable', 'string', 'max:50'],

            'is_active' => ['boolean'],

            'sort_order' => ['integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 20 karakter.',
            'slug.unique' => 'Slug sudah digunakan.',
        ];
    }
}
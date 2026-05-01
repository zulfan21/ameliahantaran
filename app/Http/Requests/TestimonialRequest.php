<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:10'],
            'wedding_date' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Rating wajib dipilih.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'content.required' => 'Testimoni wajib diisi.',
            'content.min' => 'Testimoni minimal 10 karakter.',
        ];
    }
}

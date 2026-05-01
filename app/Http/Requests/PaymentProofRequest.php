<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
            'bank_name' => ['nullable', 'string', 'max:100'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Bukti pembayaran wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
            'amount.required' => 'Jumlah pembayaran wajib diisi.',
            'payment_date.required' => 'Tanggal pembayaran wajib diisi.',
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getGroup('general')
            ->merge(Setting::getGroup('contact'))
            ->merge(Setting::getGroup('payment'));

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'company_tagline' => ['nullable', 'string', 'max:255'],
            'company_description' => ['nullable', 'string'],
            'company_address' => ['nullable', 'string'],
            'company_phone' => ['nullable', 'string', 'max:20'],
            'company_email' => ['nullable', 'email', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'google_maps' => ['nullable', 'url'],
            'bank_name' => ['nullable', 'string', 'max:100'],
            'bank_account' => ['nullable', 'string', 'max:50'],
            'bank_account_name' => ['nullable', 'string', 'max:255'],
            'shipping_cost' => ['nullable', 'numeric', 'min:0'],
            'qris_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        if ($request->cropped_qris) {

            // ambil gambar lama
            $old = Setting::where('key', 'qris_image')->value('value');

            // hapus file lama
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }

            // decode base64
            $image = $request->cropped_qris;

            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            // nama file baru
            $imageName = 'qris/' . Str::random(20) . '.png';

            // simpan file
            Storage::disk('public')->put(
                $imageName,
                base64_decode($image)
            );

            // update database
            Setting::updateOrCreate(
                ['key' => 'qris_image'],
                [
                    'value' => $imageName,
                    'type' => 'string',
                    'group' => 'payment'
                ]
            );
            cache()->flush();
        }

        // General settings
        Setting::set('company_name', $request->company_name, 'string', 'general');
        Setting::set('company_tagline', $request->company_tagline, 'string', 'general');
        Setting::set('company_description', $request->company_description, 'string', 'general');

        // Contact settings
        Setting::set('company_address', $request->company_address, 'string', 'contact');
        Setting::set('company_phone', $request->company_phone, 'string', 'contact');
        Setting::set('company_email', $request->company_email, 'string', 'contact');
        Setting::set('whatsapp_number', $request->whatsapp_number, 'string', 'contact');
        Setting::set('google_maps', $request->google_maps, 'string', 'contact');

        // Payment settings
        Setting::set('bank_name', $request->bank_name, 'string', 'payment');
        Setting::set('bank_account', $request->bank_account, 'string', 'payment');
        Setting::set('bank_account_name', $request->bank_account_name, 'string', 'payment');
        Setting::set('shipping_cost', $request->shipping_cost ?? 15000, 'integer', 'payment');

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}

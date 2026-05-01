<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::featured()
            ->with('category')
            ->take(6)
            ->get();

        $categories = Category::active()
            ->withCount('products')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::approved()
            ->latest()
            ->get();

        $settings = [
            'company_name' => Setting::get('company_name', 'Amelia Hantaran'),
            'company_tagline' => Setting::get('company_tagline', 'Make Your Wedding Hantaran Truly Special'),
            'company_description' => Setting::get('company_description', ''),
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
        ];

        return view('home', compact(
            'featuredProducts',
            'categories',
            'testimonials',
            'settings'
        ));
    }

    public function about()
    {
        $settings = [
            'company_name' => Setting::get('company_name', 'Amelia Hantaran'),
            'company_description' => Setting::get('company_description', ''),
            'company_address' => Setting::get('company_address', ''),
            'company_phone' => Setting::get('company_phone', ''),
            'company_email' => Setting::get('company_email', ''),
        ];

        return view('about', compact('settings'));
    }

    public function contact()
    {
        $settings = [
            'company_name' => Setting::get('company_name', 'Amelia Hantaran'),
            'company_address' => Setting::get('company_address', ''),
            'company_phone' => Setting::get('company_phone', ''),
            'company_email' => Setting::get('company_email', ''),
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
            'google_maps' => Setting::get('google_maps', ''),
        ];

        return view('contact', compact('settings'));
    }

    public function gallery()
    {
        $galleries = \App\Models\Gallery::active()
            ->orderBy('sort_order')
            ->paginate(12);

        return view('gallery', compact('galleries'));
    }
}

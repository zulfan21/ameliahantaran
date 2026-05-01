<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Order;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::approved()
            ->latest()
            ->paginate(12);

        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        // Get completed orders for the user
        $orders = Order::where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->whereDoesntHave('testimonial')
            ->get();

        return view('testimonials.create', compact('orders'));
    }

    public function store(TestimonialRequest $request)
    {
        $data = [
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'customer_name' => auth()->user()->name,
            'rating' => $request->rating,
            'content' => $request->content,
            'wedding_date' => $request->wedding_date,
            'status' => 'pending',
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni berhasil dikirim. Menunggu persetujuan admin.');
    }
}

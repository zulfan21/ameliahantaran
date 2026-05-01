<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::with(['user', 'order']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $testimonials = $query->latest()->paginate(20);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->approve(auth()->id());

        return redirect()->back()->with('success', 'Testimoni berhasil disetujui.');
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->reject();

        return redirect()->back()->with('success', 'Testimoni ditolak.');
    }

    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        return redirect()->back()->with('success', 'Status featured berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}

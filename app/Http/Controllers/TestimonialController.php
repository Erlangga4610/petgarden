<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('testimonials.index', compact('testimonials'));
    } 

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // Upload ke Cloudinary
        $uploadedFile = Cloudinary::upload(
            $request->file('image')->getRealPath(),
            ['folder' => 'testimonials'] // folder opsional
        );

        Testimonial::create([
            'image' => $uploadedFile->getSecurePath(), // URL file
            'public_id' => $uploadedFile->getPublicId() // simpan untuk hapus nanti
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama di Cloudinary
            if ($testimonial->public_id) {
                Cloudinary::destroy($testimonial->public_id);
            }

            // Upload file baru
            $uploadedFile = Cloudinary::upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'testimonials']
            );

            $testimonial->image = $uploadedFile->getSecurePath();
            $testimonial->public_id = $uploadedFile->getPublicId();
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Hapus file di Cloudinary
        if ($testimonial->public_id) {
            Cloudinary::destroy($testimonial->public_id);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni dihapus!');
    }
}

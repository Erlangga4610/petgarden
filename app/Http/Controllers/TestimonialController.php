<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    // Tampilkan semua testimoni
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('testimonials.index', compact('testimonials'));
    }

    // Simpan testimoni baru
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $fileName = time() . '.' . $image->getClientOriginalExtension();

        // Simpan ke folder public/testimoni
        $image->move(public_path('testimoni'), $fileName);

        Testimonial::create([
            'image' => 'testimoni/' . $fileName,
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    // Update testimoni
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldPath = public_path($testimonial->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('testimoni'), $fileName);

            $testimonial->image = 'testimoni/' . $fileName;
        }

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni diperbarui!');
    }

    // Hapus testimoni
    public function destroy(Testimonial $testimonial)
    {
        $imagePath = public_path($testimonial->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimoni dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


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

    $image = $request->file('image')->store('testimonials', 'public');

    Testimonial::create([
        'image' => $image,
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
        Storage::disk('public')->delete($testimonial->image);
        $image = $request->file('image')->store('testimoni', 'public');
        $testimonial->image = $image;
    }

    $testimonial->save();

    return redirect()->route('testimonials.index')->with('success', 'Testimoni diperbarui!');
}

// Hapus testimoni
public function destroy(Testimonial $testimonial)
{
    Storage::disk('public')->delete($testimonial->image);
    $testimonial->delete();

    return redirect()->route('testimonials.index')->with('success', 'Testimoni dihapus!');
}


}

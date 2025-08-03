<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    // Tampilkan semua produk
    public function index(Request $request): View
    {
        $query = Product::query();

        // Jika ada keyword pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    // Tampilkan form tambah produk
    public function create(): View
    {
        return view('products.create');
    }

    // Simpan produk baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'harga' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $image = $request->file('image')->store('produk', 'public');

        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'harga' => $request->harga,
            'image' => $image
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    // Update produk
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'harga' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $image = $request->file('image')->store('produk', 'public');
            $product->image = $image;
        }

        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'harga' => $request->harga,
            'image' => $product->image
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy(Product $product): RedirectResponse
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}

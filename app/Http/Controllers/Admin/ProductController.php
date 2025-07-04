<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('products', $fotoName, 'public');
            $data['foto'] = $fotoPath;
        }

        Product::create($data);
       
        $product = Product::latest()->first();
        $product->stockHistories()->create([
            'jumlah' => $data['stok'],
            'tipe' => 'masuk', 
        ]); 
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }

            // Upload foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $fotoPath = $foto->storeAs('products', $fotoName, 'public');
            $data['foto'] = $fotoPath;
        }

        $product->update($data);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        // Hapus foto jika ada
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }
        // Hapus semua histori stok yang terkait produk
        $product->stockHistories()->delete();

        $product->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
} 
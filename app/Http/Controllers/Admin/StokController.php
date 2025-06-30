<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StokController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.stok.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);
        $product = Product::findOrFail($id);
        $product->stok = $request->stok;
        $product->save();
        return redirect()->route('admin.stok.index')->with('success', 'Stok produk berhasil diupdate');
    }
}

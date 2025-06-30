<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'diskon' => 'required|integer|min:0|max:100',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        \App\Models\Promo::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'diskon' => $request->diskon,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.promo.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic untuk update promo
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Logic untuk hapus promo
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus');
    }
} 
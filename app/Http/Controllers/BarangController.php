<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allbarangs = Barang::all();
        $JumlahBarang = Barang::count();
        return view('barang.index', compact('allbarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_produk' => 'required',
            'kode' => 'nullable|string|unique:barangs,kode',
            'qty' => 'integer',
            'satuan' => 'nullable|in:pcs,kg',
            'modal_awal' => 'required|numeric',
            'kategori' => 'nullable|string',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $kode = $request->kode ?? 'PRD'.time();

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('barangs','public');
        }

        Barang::create([
            'nama_produk' => $request->nama_produk,
            'kode' => $kode,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'kategori' => $request->kategori,
            'modal_awal' => $request->modal_awal,
            'harga_jual' => $request->harga_jual,
            'image' => $path, 
        ]);

        return redirect()->route('barang.index')->with('succes','produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $allbarang = Barang::findOrFail($id);

        return view('barang.index', compact('allbarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $allbarang = Barang::findOrFail($id);
        return view('barang.edit', compact('allbarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        
        $request->validate([
            'nama_produk' => 'required',
            'kode' => 'nullable|string|unique:barangs,kode,'.$id,
            'qty' => 'integer',
            'satuan' => 'nullable|in:pcs,kg',
            'modal_awal' => 'required|numeric',
            'kategori' => 'nullable|string',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            ]);
            
        $allbarang = Barang::findOrFail($id);

        $path = $allbarang->image; // default pakai gambar lama
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('barangs','public');
        }

        $allbarang->update([
            'nama_produk' => $request->nama_produk,
            'kode' => $request->kode ?? $allbarang->kode,
            'qty' => $request->qty ?? $allbarang->qty,
            'satuan' => $request->satuan,
            'kategori' => $request->kategori,
            'modal_awal' => $request->modal_awal,
            'harga_jual' => $request->harga_jual,
            'image' => $path, 
        ]);

        return redirect()->route('barang.index')->with('succes','produk berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

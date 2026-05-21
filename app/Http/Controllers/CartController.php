<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $allbarang = Barang::all();

        $cartItems = Cart::with('barang')->get();

        return view('shop.index', compact('allbarang', 'cartItems'));
    }

    public function addkeranjang(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|exists:barangs,kode',
            'qty' => 'required|integer|min:1',
        ]);

        $barang = Barang::where('kode', $validated['kode'])->first();

        $cekKeranjang = Cart::where('barang_id', $barang->id)->first();

        if (!$cekKeranjang) {

            Cart::create([
                'barang_id' => $barang->id,
                'qty' => $validated['qty'],
            ]);

        } else {

            $cekKeranjang->update([
                'qty' => $cekKeranjang->qty + $validated['qty']
            ]);
        }

        return redirect('/shop');
    }
    public function increase($id)
{
    $cart = Cart::findOrFail($id);
    $barang = Barang::findOrFail($cart->barang_id);

    // batasi qty cart <= stok barang
    if ($cart->qty >= $barang->qty) {
        return back()->with('error', 'Jumlah melebihi stok tersedia');
    }

    // tambah qty cart (stok barang tidak dikurangi di sini)
    $cart->update([
        'qty' => $cart->qty + 1
    ]);

    return back();
}

public function decrease($id)
{
    $cart = Cart::findOrFail($id);

    if ($cart->qty <= 1) {
        $cart->delete();
    } else {
        $cart->update([
            'qty' => $cart->qty - 1
        ]);
    }

    return back();
}


}
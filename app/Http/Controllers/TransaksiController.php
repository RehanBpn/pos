<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {
        $selected = $request->input('selected', []);
        $cartItems = Cart::with('barang')->get();

        $subtotal = $cartItems->sum(fn($c) => $c->barang->harga_jual * $c->qty);

        return view('checkout.index', compact('cartItems','subtotal'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|in:online,cash',
            'bayar' => 'required|numeric|min:0',
        ]);

        $subtotal = $request->input('subtotal');
        $admin = 2000;
        $ongkir = $request->payment_type === 'online' ? 10000 : 0;
        $total = $subtotal + $admin + $ongkir;
        $bayar = $request->bayar;
        $kembalian = $bayar - $total;


        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX-'.Str::upper(Str::random(6)),
            'subtotal' => $subtotal,
            'admin' => $admin,
            'ongkir' => $ongkir,
            'total' => $total,
            'payment_type' => $request->payment_type,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
        ]);

        foreach($request->items as $item){
        $barang = Barang::find($item['barang_id']);
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $barang->id,
                'qty' => $item['qty'],
                'harga' => $barang->harga_jual,
                'subtotal' => $barang->harga_jual * $item['qty'],
            ]);

            // update stok
            $barang->qty -= $item['qty'];
            $barang->save();
            Cart::where('barang_id', $barang->id)->delete();
        }

        return redirect()->route('checkout.invoice', $transaksi->id);
    }

    public function invoice($id)
    {
        $trx = Transaksi::with('items.barang')->findOrFail($id);
        return view('checkout.invoice', compact('trx'));
    }

}

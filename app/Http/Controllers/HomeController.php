<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $jumlahProduk     = Barang::count();
        $jumlahTransaksi  = Transaksi::count();
        $omzetHariIni     = Transaksi::whereDate('created_at', now()->toDateString())->sum('total');
        $pendapatan       = Transaksi::sum('total');
        $transaksiTerbaru = Transaksi::latest()->take(5)->get();

        return view('home.index', compact(
            'jumlahProduk',
            'jumlahTransaksi',
            'omzetHariIni',
            'pendapatan',
            'transaksiTerbaru'
        ));
    }
}

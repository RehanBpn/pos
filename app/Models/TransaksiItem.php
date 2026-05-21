<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $table = 'transaksi_item';
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal',
    ];
    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}

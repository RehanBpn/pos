<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    //
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi', 'subtotal', 'admin','ongkir','total','payment_type', 'bayar','kembalian'
    ];
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}

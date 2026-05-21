<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_produk','kode','satuan','qty','modal_awal','kategori', 'harga_jual','image',
    ];
}

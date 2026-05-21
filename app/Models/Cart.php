<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'barang_id',
        'qty'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
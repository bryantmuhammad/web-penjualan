<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_detail_pembelian';
    protected $guarded      = ['id_detail_pembelian'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}

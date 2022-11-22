<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail_penjualan';
    protected $guarded = ['id_detail_penjualan'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}

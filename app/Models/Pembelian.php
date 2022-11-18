<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\DetailPembelian;

class Pembelian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pembelian';
    protected $guarded = ['id_pembelian'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian');
    }
}

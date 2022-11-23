<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailPenjualan;
use App\Models\AlamatPengiriman;

class Penjualan extends Model
{
    use HasFactory;
    public $incrementing    = false;
    protected $primaryKey   = 'id_penjualan';
    protected $fillable     = ['id_penjualan', 'user_id', 'estimasi', 'pengiriman', 'resi', 'ongkir', 'total', 'status', 'pdf'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }

    public function alamat_pengiriman()
    {
        return $this->hasOne(AlamatPengiriman::class, 'id_penjualan');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Array $tanggal : [Tanggal_Mulai, Tanggal Selesai]
     */

    public function scopeSearchByDate($query, array $tanggal)
    {
        return $query->whereBetween('created_at', [$tanggal]);
    }
}

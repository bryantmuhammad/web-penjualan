<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;

class AlamatPengiriman extends Model
{
    use HasFactory;
    protected $table        = 'alamat_pengirimans';
    protected $primaryKey   = 'id_alamat_pengiriman';
    protected $guarded      = ['id_alamat_pengiriman'];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }
}

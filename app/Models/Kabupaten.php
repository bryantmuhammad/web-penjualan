<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provinsi;

class Kabupaten extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kabupaten';
    protected $fillable = ['id_kabupaten', 'id_provinsi', 'nama_kabupaten'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
}

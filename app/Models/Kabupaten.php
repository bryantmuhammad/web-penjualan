<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kabupaten';
    protected $fillable = ['id_kabupaten', 'id_provinsi', 'nama_kabupaten'];
}

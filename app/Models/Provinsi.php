<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_provinsi';
    protected $fillable = ['id_provinsi', 'nama_provinsi'];
}

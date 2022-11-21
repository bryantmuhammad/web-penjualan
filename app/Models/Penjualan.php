<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Penjualan extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_penjualan';
    protected $guarded      = ['id_penjualan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

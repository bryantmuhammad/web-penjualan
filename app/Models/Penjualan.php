<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
}

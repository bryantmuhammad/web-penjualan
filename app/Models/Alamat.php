<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Alamat extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_alamat';
    protected $guarded      = ['id_alamat'];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByUserLogin($query)
    {
        $query->where('user_id', auth()->user()->id);
    }
}

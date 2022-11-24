<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'title' => 'Home',
            'produks' => Produk::with('kategori')->latest()->paginate(5)
        ]);
    }


    public function index_admin()
    {
        return view('admin.index', [
            'title'     => 'Dashboard',
            'pending'   => Penjualan::where('status', 1)->count(),
            'paid'      => Penjualan::where('status', 2)->count(),
            'finish'    => Penjualan::where('status', '>', 2)->count(),
            'user'      => User::count(),
            'produk'    => Produk::count()
        ]);
    }
}

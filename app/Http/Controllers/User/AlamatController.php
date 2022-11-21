<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlamatRequest;
use App\Models\Alamat;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use RealRashid\SweetAlert\Facades\Alert;

class AlamatController extends Controller
{
    public function index()
    {
        return view('user.profil.alamat', [
            'title'     => 'Daftar Alamat',
            'alamats'   => Alamat::ByUserLogin()->with('user', 'kabupaten.provinsi')->get()
        ]);
    }

    public function create()
    {
        return view('user.profil.create', [
            'title'      => 'Tambah Alamat',
            'provinsis'  => Provinsi::all()
        ]);
    }

    public function store(AlamatRequest $request)
    {

        $validatedData          = $request->validated() + ['user_id' => auth()->user()->id];
        $alamat_aktif           = Alamat::where('user_id', auth()->user()->id)->where('aktif', 1)->count();
        $validatedData['aktif'] = 1;
        if ($alamat_aktif) $validatedData['aktif'] = 0;
        Alamat::create($validatedData);

        Alert::success('success', 'Berhasil menambahkan alamat baru');

        return redirect()->route('user.alamat');
    }

    public function aktif(Request $request, Alamat $alamat)
    {
        Alamat::where('aktif', 1)->where('user_id', auth()->user()->id)->update(['aktif' => 0]);
        $alamat->update(['aktif' => 1]);
        Alert::success('success', 'Berhasil merubah alamat aktif');

        return redirect()->route('user.alamat');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeranjangRequest;
use App\Models\Keranjang;
use App\Service\KeranjangService;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangController extends Controller
{
    private KeranjangService $keranjang_service;

    public function __construct(KeranjangService $keranjangService)
    {
        $this->keranjang_service = $keranjangService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.keranjang.index', [
            'title'         => 'Keranjang',
            'keranjangs'    => Keranjang::where('user_id', auth()->user()->id)->with('produk.kategori')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeranjangRequest $request)
    {
        $response = $this->keranjang_service->create($request);

        if ($response->status_code == 200) {
            Alert::success('Success', $response->message);
        } else {
            Alert::error('Gagal', $response->message);
        }

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(KeranjangRequest $request, Keranjang $keranjang)
    {
        $response = $this->keranjang_service->update($request, $keranjang);

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keranjang $keranjang)
    {
        $keranjang->delete();
        $response = create_reponse();
        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Produk berhasil dihapus dari keranjang';

        return response()->json($response, 200);
    }



    public function jumlah()
    {
        $jumlah = 0;
        if (auth()->user()) {
            $user       = auth()->user()->id;
            $keranjang  = Keranjang::where('user_id', $user)->count();

            $jumlah = $keranjang;
        }

        return response()->json([
            'jumlah' => $jumlah
        ], 200);
    }
}

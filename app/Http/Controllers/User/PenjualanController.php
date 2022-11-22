<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenjualanRequest;
use App\Models\Alamat;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Service\PaymentService;
use App\Service\PenjualanService;
use RealRashid\SweetAlert\Facades\Alert;


class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alamat = Alamat::where('aktif', 1)->ByUserLogin()->with('kabupaten.provinsi')->first();
        if ($alamat) {
            return view('user.penjualan.index', [
                'title'         => 'Checkout',
                'alamat'        => $alamat,
                'keranjangs'    => Keranjang::where('user_id', auth()->user()->id)->with('produk.kategori')->get()
            ]);
        } else {
            return redirect()->route('user.alamat');
        }
    }


    public function checkout(PenjualanRequest $request)
    {
        $service    = new PaymentService();
        $response   = $service->create_token($request);

        return response()->json($response, $response->status_code);
    }

    public function list_penjualan()
    {

        return view('user.penjualan.list-penjualan', [
            'title'     => 'List Pemesanan',
            'penjualans' => Penjualan::where('user_id', auth()->user()->id)->with('detail_penjualan.produk')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penjualan_service  = new PenjualanService();
        $response           = $penjualan_service->create($request);

        if ($response->status_code == 200) {
            Alert::success('Success', $response->message);
        } else {
            Alert::error('Gagal', $response->message);
        }

        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        return view('user.penjualan.detail', [
            'title'     => 'Detail Pembelian',
            'penjualan' => $penjualan->load('user', 'detail_penjualan.produk', 'alamat_pengiriman.kabupaten.provinsi')
        ]);
        dd($penjualan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.produk.list-produk', [
            'title'         => 'List Produk',
            'kategoris'     => Kategori::all(),
            'produks'       => Produk::where('stok', '>', 0)->paginate('5'),
            'id_kategori'   => 0,
            'min_harga'     => Produk::select('harga')->orderBy('harga', 'asc')->first()->harga,
            'max_harga'     => Produk::select('harga')->orderBy('harga', 'desc')->first()->harga
        ]);
    }

    public function filter_by_category(Kategori $kategori)
    {
        $produks = Produk::where('id_kategori', $kategori->id_kategori)->where('stok', '>', 0)->paginate('5');

        return view('user.produk.list-produk', [
            'title'         => 'List Produk',
            'kategoris'     => Kategori::all(),
            'produks'       => $produks,
            'id_kategori'   => $kategori->id_kategori,
            'min_harga'     => Produk::select('harga')->where('id_kategori', $kategori->id_kategori)->orderBy('harga', 'asc')->first()->harga,
            'max_harga'     => Produk::select('harga')->where('id_kategori', $kategori->id_kategori)->orderBy('harga', 'desc')->first()->harga
        ]);
    }

    public function filter_by_price(Request $request)
    {
        $response = create_reponse();
        $produk = Produk::select('nama_produk', 'harga', 'id_produk', 'id_kategori', 'gambar')->with('kategori')->whereBetween('harga', [$request->min, $request->max])->where('stok', '>', 0);
        if ($request->id_kategori) {
            $produk->where('id_kategori', $request->id_kategori);
        }

        $produk = $produk->get();
        $response->status = 'success';
        $response->status_code = 200;
        $response->message = 'Produk Found';
        $response->data = $produk;

        return response()->json($response, $response->status_code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('user.produk.detail-produk', [
            'title' => 'Detail Produk',
            'produk' => $produk->load('kategori')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }
}

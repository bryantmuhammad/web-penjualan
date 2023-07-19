<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\ProdukDataTable;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Service\ProdukService;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProdukDataTable $dataTable)
    {
        return $dataTable->render('admin.produk.index', [
            'title' => 'Produk Management'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.create', [
            'title'     => 'Tambah Produk',
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        $produk = (new ProdukService)->create($request);
        Alert::success('Success', 'Berhasil menambahkan produk');

        return redirect()->route('dashboard.produks.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('admin.produk.update', [
            'produk'    => $produk,
            'kategoris' => Kategori::all(),
            'title'     => 'Edit Produk'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukRequest $request, Produk $produk)
    {
        $response = (new ProdukService)->update($request, $produk);
        Alert::success('Success', 'Berhasil merubah produk');

        return redirect()->route('dashboard.produks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        (new ProdukService)->delete($produk);
        Alert::success('Success', 'Berhasil merubah produk');

        return redirect()->route('dashboard.produks.index');
    }

    public function laporan()
    {
        $produk = Produk::with('kategori')->get();

        return view('admin.laporan.produk', [
            'produks' => $produk,
            'title'  => 'Laporan Produk'
        ]);
    }

    public function laporan_print()
    {

        $produk = Produk::with('kategori')->get();

        return view('admin.laporan.produk-print', [
            'produks' => $produk,
            'title'  => 'Laporan Produk'
        ]);
    }
}

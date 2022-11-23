<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\DataTables\PembelianDataTable;
use App\Http\Requests\PembelianRequest;
use App\Models\DetailPembelian;
use App\Models\Produk;
use App\Models\Supplier;
use RealRashid\SweetAlert\Facades\Alert;
use App\Service\PembelianService;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    private PembelianService $pembelian_service;

    public function __construct(PembelianService $pembelianService)
    {
        $this->pembelian_service = $pembelianService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PembelianDataTable $dataTable)
    {
        return $dataTable->render('admin.pembelian.index', [
            'title' => 'Pembelian Management'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pembelian.create', [
            'title'     => 'Tambah Pembelian',
            'suppliers' => Supplier::all(),
            'produks'    => Produk::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembelianRequest $request)
    {
        $response = $this->pembelian_service->create($request->validated());

        if ($response->status_code == 200) {
            Alert::success('Success', $response->message);
        } else {
            Alert::error('Gagal', $response->message);
        }

        return redirect()->route('dashboard.pembelians.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        return view('admin.pembelian.detail', [
            'title'         => 'Detail Pembelian',
            'pembelian'     => $pembelian->load('supplier', 'detail_pembelian.produk'),
        ]);
    }

    public function print_invoice(Pembelian $pembelian)
    {
        return view('admin.pembelian.print-invoice', [
            'title'         => 'Detail Pembelian',
            'pembelian'     => $pembelian->load('supplier', 'detail_pembelian.produk'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }


    public function laporan_index()
    {
        $pembelians = (new PembelianService)->laporan();

        return view('admin.laporan.pembelian', [
            'pembelians'    => $pembelians,
            'title'         => 'Laporan Pembelian'
        ]);
    }

    public function laporan_print()
    {
        $pembelians = (new PembelianService)->laporan();
        return view('admin.laporan.pembelian-print', [
            'pembelians'    => $pembelians,
            'title'         => 'Laporan Pembelian'
        ]);
    }
}

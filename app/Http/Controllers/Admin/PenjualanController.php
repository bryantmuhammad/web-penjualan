<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\DataTables\PenjualanDataTable;
use App\Http\Requests\KirimResiRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Service\PenjualanService;

class PenjualanController extends Controller
{

    public function belumbayar(PenjualanDataTable $dataTable)
    {
        return $dataTable->render('admin.penjualan.belumbayar.index', [
            'title' => 'Penjualan Belum Membayar'
        ]);
    }

    public function sudahbayar(PenjualanDataTable $dataTable)
    {
        return $dataTable->render('admin.penjualan.sudahbayar.index', [
            'title' => 'Penjualan Sudah Membayar'
        ]);
    }

    public function selesai(PenjualanDataTable $dataTable)
    {
        return $dataTable->render('admin.penjualan.sudahbayar.index', [
            'title' => 'Penjualan Sudah Membayar'
        ]);
    }

    public function print_invoice(Penjualan $penjualan)
    {
        return view('admin.penjualan.print-invoice', [
            'title' => 'Detail Penjualan',
            'penjualan' => $penjualan->load('user', 'detail_penjualan.produk', 'alamat_pengiriman.kabupaten.provinsi')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        return view('admin.penjualan.detail', [
            'title' => 'Detail Penjualan',
            'penjualan' => $penjualan->load('user', 'detail_penjualan.produk', 'alamat_pengiriman.kabupaten.provinsi')
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(KirimResiRequest $request, Penjualan $penjualan)
    {
        //Kirim Resi
        $penjualan->update($request->validated() + ['status' => 3]);
        Alert::success('Success', 'Berhasil mengirimkan no resi');

        return redirect()->route('dashboard.penjualans.sudahbayar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $response = (new PenjualanService)->delete($penjualan);
        if ($response->status_code == 200) {
            Alert::success('Success', $response->message);
        } else {
            Alert::error('Gagal', $response->message);
        }

        return redirect()->back();
    }

    public function laporan_index()
    {
        $penjualans = (new PenjualanService)->laporan();

        return view('admin.laporan.penjualan', [
            'penjualans'    => $penjualans,
            'title'         => 'Laporan Penjualan'
        ]);
    }

    public function laporan_print()
    {
        $penjualans = (new PenjualanService)->laporan();
        return view('admin.laporan.penjualan-print', [
            'penjualans'    => $penjualans,
            'title'         => 'Laporan Penjualan'
        ]);
    }
}

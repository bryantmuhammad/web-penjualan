<?php

namespace App\Service;

use App\Models\Alamat;
use App\Models\Penjualan;
use App\Models\AlamatPengiriman;
use App\Models\DetailPenjualan;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PenjualanService
{
    public function create($request)
    {
        $response = create_reponse();
        DB::beginTransaction();
        try {
            // Decode data dari midtrans
            $payment    = json_decode($request->midtrans);
            // Insert penjualan
            $penjualan  = Penjualan::create([
                'id_penjualan'  => $payment->order_id,
                'user_id'       => auth()->user()->id,
                'estimasi'      => $request->estimasi,
                'pengiriman'    => $request->pengiriman,
                'resi'          => '',
                'ongkir'        => $request->ongkir,
                'total'         => $request->grandtotal,
                'status'        => 1,
                'pdf'           => $payment->pdf_url
            ]);

            // Ambil data dari keranjang lalu maskan ke detail penjualan
            $keranjangs = Keranjang::where('user_id', auth()->user()->id)->with('produk')->get();
            foreach ($keranjangs as $keranjang) {
                DetailPenjualan::create([
                    'id_penjualan'  => $penjualan->id_penjualan,
                    'id_produk'     => $keranjang->id_produk,
                    'jumlah'        => $keranjang->jumlah,
                    'sub_total'     => $keranjang->jumlah * $keranjang->produk->harga
                ]);

                Produk::where('id_produk', $keranjang->id_produk)->decrement('stok', $keranjang->jumlah);
            }


            //Insert alamat pengiriman
            $alamat     = Alamat::where('user_id', auth()->user()->id)->where('aktif', 1)->first();
            $alamat     = $alamat->getAttributes();
            $alamat['id_penjualan'] = $penjualan->id_penjualan;
            unset($alamat['created_at']);
            unset($alamat['updated_at']);
            AlamatPengiriman::create($alamat);

            //Hapus data keranjang user
            Keranjang::where('user_id', auth()->user()->id)->delete();

            $response->data = $penjualan;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return $response;
        }

        DB::commit();
        $response->message      = 'Transaksi berhasil dilakukan';
        $response->status       = 'success';
        $response->status_code  = 200;

        return $response;
    }

    public function delete(Penjualan $penjualan)
    {
        $response = create_reponse();

        DB::beginTransaction();
        try {
            $produks = DetailPenjualan::where('id_penjualan', $penjualan->id_penjualan)->get();
            $produks->each(function ($produk) {
                Produk::where('id_produk', $produk->id_produk)->increment('stok', $produk->jumlah);
            });

            $penjualan->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return $response;
        }

        DB::commit();
        $response->status       = 'success';
        $response->status_code  = 200;
        $response->message      = 'Berhasil menghapus penjualan';

        return $response;
    }

    public function laporan()
    {
        $start_date = request()->query('start_date', false);
        $end_date   = request()->query('end_date', false);

        if ($start_date && $end_date) {

            $penjualans = Penjualan::with('detail_penjualan.produk', 'user')->SearchByDate([$start_date, $end_date])->where('status', '>', 2)->get();
        } else {
            $penjualans = Penjualan::with('detail_penjualan.produk', 'user')->where('status', '>', 2)->get();
        }

        return $penjualans;
    }
}

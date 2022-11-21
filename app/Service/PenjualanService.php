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
            $payment    = json_decode($request->midtrans);
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


            $alamat     = Alamat::where('user_id', auth()->user()->id)->where('aktif', 1)->first();
            $alamat     = $alamat->getAttributes();
            $alamat['id_penjualan'] = $penjualan->id_penjualan;
            unset($alamat['created_at']);
            unset($alamat['updated_at']);
            AlamatPengiriman::create($alamat);

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
}

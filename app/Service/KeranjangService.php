<?php

namespace App\Service;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;


class KeranjangService
{
    public function create($request)
    {
        $response   = create_reponse();
        $stok       = Produk::select('stok')->where('id_produk', $request['id_produk'])->first()->stok;
        if ($stok) {
            DB::beginTransaction();
            try {
                //Cek keranjang apakah sudah ada 
                $keranjang = Keranjang::where('id_produk', $request['id_produk'])
                    ->where('user_id', auth()->user()->id)
                    ->first();

                if ($keranjang) {
                    $jumlahProdukKeranjang = $keranjang->jumlah + 1;
                    if ($jumlahProdukKeranjang < $stok) {
                        $keranjang->increment('jumlah', 1);
                    }
                } else {
                    $keranjang = Keranjang::create([
                        'user_id'   => auth()->user()->id,
                        'id_produk' => $request['id_produk'],
                        'jumlah'    => 1
                    ]);
                }

                $response->status_code  = 200;
                $response->message      = 'Berhasil menambahkan produk ke keranjang';
                $response->status       = 'Success';
                $response->data         = $keranjang;

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
                return $response;
            }
        }


        return $response;
    }

    public function update($request, Keranjang $keranjang)
    {
        $response   = create_reponse();
        $produk       = Produk::select('stok', 'harga')->where('id_produk', $keranjang['id_produk'])->first();
        $stok           = $produk->stok;


        if ($request['jumlah'] <= $stok) {
            $keranjang->update(['jumlah' => $request['jumlah']]);
        }

        $grandTotal = DB::table('keranjangs')
            ->select(DB::raw('SUM(keranjangs.jumlah * produks.harga) AS grandtotal'))
            ->join('produks', 'produks.id_produk', '=', 'keranjangs.id_produk')
            ->where('keranjangs.user_id', auth()->user()->id)
            ->first()->grandtotal;

        $data = [
            'grandtotal'    => rupiah($grandTotal),
            'subtotal'      => rupiah($request['jumlah'] * $produk->harga),
        ];



        $response->status_code  = 200;
        $response->message      = 'Berhasil mengupdate keranjang';
        $response->data         = $data;
        $response->status       = 'success';

        return $response;
    }
}

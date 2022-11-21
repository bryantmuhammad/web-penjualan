<?php

namespace App\Service;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Produk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\ProdukService;
use Carbon\Carbon;

class PembelianService
{

    /**
     * Membuat list produk dari input array id_produk[] dan jumlah[].
     *
     * @return array
     */

    public function generate_produk($request)
    {
        $list_produk = [];
        $total = 0;
        for ($i = 0; $i < count($request['produk']); $i++) {
            $id_produk      = $request['produk'][$i];
            $jumlah         = $request['jumlah'][$i];
            $harga_produk   = Produk::select('harga')->where('id_produk', $id_produk)->first()->harga;
            $total          += $jumlah * $harga_produk;


            $list_produk[] = [
                'id_produk'    => $id_produk,
                'jumlah'       => $jumlah,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ];
        }

        return [$list_produk, $total];
    }

    public function create($request)
    {
        $response = create_reponse();

        DB::beginTransaction();
        try {
            $produkService                      = new ProdukService();
            [$list_produk, $total_pembelian]    = $this->generate_produk($request);

            //INSERT PEMBELIAN
            $pembelian = Pembelian::create([
                'id_supplier'       => $request['id_supplier'],
                'tanggal_pembelian' => $request['tanggal_pembelian'],
                'total_pembelian'   => $total_pembelian
            ]);

            //MEMASUKAN ID PEMBELIAN KE ARRAY LIST DETAIL PEMBELIAN
            foreach ($list_produk as $key => $produk) {
                $list_produk[$key]['id_pembelian'] = $pembelian->id_pembelian;
            }

            //INSERT DETAIL PEMBELIAN
            DetailPembelian::insert($list_produk);
            $produkService->updateStok($list_produk);
        } catch (Exception $e) {
            DB::rollBack();
            $response->status_code  = 500;
            $response->message      = 'Terjadi kesalahan server';
            $response->status       = 'failed';

            return $response;
        }

        DB::commit();
        $response->status_code  = 200;
        $response->message      = 'Pembelian berhasil dilakukan';
        $response->status       = 'success';
        $response->data         = $pembelian;

        return $response;
    }
}

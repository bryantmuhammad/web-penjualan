<?php

namespace App\Service;

use App\Models\Alamat;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\DB;

class OngkirService
{
    public function getOngkir()
    {
        $response   = create_reponse();

        try {
            $alamat     = Alamat::where('aktif', 1)->ByUserLogin()->with('kabupaten.provinsi')->first();
            $berat      = DB::table('keranjangs')
                ->select(DB::raw('SUM(produks.berat * keranjangs.jumlah) AS berat'))
                ->join('produks', 'produks.id_produk', '=', 'keranjangs.id_produk')
                ->where('keranjangs.user_id', auth()->user()->id)
                ->first()->berat;


            $eksepdisis     = ['jne', 'tiki', 'pos'];

            $daftarProvinsi = [];
            foreach ($eksepdisis as $eksepdisi) {
                $daftarProvinsi[] = RajaOngkir::ongkosKirim([
                    'origin'        => env('RAJAONGKIR_ORIGIN'),                // ID kota/kabupaten asal
                    'destination'   => $alamat->kabupaten->id_kabupaten,        // ID kota/kabupaten tujuan
                    'weight'        => $berat,                                  // berat barang dalam gram
                    'courier'       => $eksepdisi                               // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
                ])->get();
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return $response;
        }

        $response->data         = $daftarProvinsi;
        $response->status_code  = 200;
        $response->status       = 'success';
        $response->message      = 'Ongkir Found';

        return $response;
    }
}

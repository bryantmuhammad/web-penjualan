<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\RajaOngkir;
use App\Models\Provinsi;
use App\Models\Kabupaten;


class DareahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rajaOngkir = new RajaOngkir(env('RAJAONGKIR_API_KEY'));

        $daftarProvinsi = $rajaOngkir->provinsi()->all();
        $insertProvinsi = [];
        $insertKabupaten = [];
        foreach ($daftarProvinsi as $provinsi) {
            $insertProvinsi[] = [
                'id_provinsi'   => $provinsi['province_id'],
                'nama_provinsi' => $provinsi['province']
            ];
            $daftarKabupaten = $rajaOngkir->kota()->dariProvinsi($provinsi['province_id'])->get();


            foreach ($daftarKabupaten as $kabupaten) {
                $insertKabupaten[] = [
                    'id_kabupaten'      => $kabupaten['city_id'],
                    'id_provinsi'       => $kabupaten['province_id'],
                    'nama_kabupaten'    => $kabupaten['city_name']
                ];
            };
        }

        Provinsi::insert($insertProvinsi);
        Kabupaten::insert($insertKabupaten);
    }
}

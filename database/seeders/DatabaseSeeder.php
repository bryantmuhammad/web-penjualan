<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Produk;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = ['Zakat', 'Infaq'];
        foreach ($kategoris as $kategori) {
            Kategori::factory()->has(Produk::factory()->count(10))->create([
                'nama_kategori' => $kategori
            ]);
        }

        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            DareahSeeder::class
        ]);
    }
}

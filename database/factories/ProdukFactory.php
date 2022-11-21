<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_kategori'   => Kategori::factory(),
            'nama_produk'   => $this->faker->sentence(3),
            'stok'          => 5,
            'berat'         => 200,
            'harga'         => 100000,
            'gambar'        => 'foto_produk/' . $this->faker->image('public/storage/foto_produk', 640, 580, null, false),
            'keterangan'    => $this->faker->sentence(10)
        ];
    }
}

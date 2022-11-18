<?php

namespace App\Service;

use App\Models\Produk;

class ProdukService
{
    public function create($request)
    {
        $validatedData              = $request->validated();
        $validatedData['gambar']    = $request->file('gambar')->store('foto_produk');
        $produk = Produk::create($validatedData);

        return $produk;
    }

    public function updateStok($list_produk): void
    {
        foreach ($list_produk as $produk) {
            Produk::where('id_produk', $produk['id_produk'])
                ->increment('stok', $produk['jumlah']);
        }
    }
}

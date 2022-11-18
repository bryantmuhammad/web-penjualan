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
}

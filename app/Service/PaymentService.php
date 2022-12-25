<?php

namespace App\Service;

use App\Models\Keranjang;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class PaymentService
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;
    }



    public function create_token($request)
    {
        $response = create_reponse();
        $items = [];
        $total = 0;
        $keranjangs = Keranjang::select('jumlah', 'id_produk')->with(['produk' => function ($query) {
            $query->select('id_produk', 'nama_produk', 'stok', 'harga');
        }])->where('user_id', auth()->user()->id)->get();

        foreach ($keranjangs as $keranjang) {
            if ($keranjang->jumlah > $keranjang->produk->stok) {
                $response->status       = 'error';
                $response->status_code  = 500;
                $response->message      = 'Stok barang habis';
                return $response;
            }

            //Item Pembelian Untuk Dikirimkan Ke Midtrans
            $items[] = [
                'id'        => $keranjang->id_produk,
                'price'     => $keranjang->produk->harga,
                'quantity'  => (int)$keranjang->jumlah,
                'name'      => $keranjang->produk->nama_produk
            ];

            $total += $keranjang->jumlah * $keranjang->produk->harga;
        }

        $items[] = [
            'id'        => 'ONGIR',
            'price'     => (int)$request['ongkir'],
            'quantity'  => 1,
            'name'      => 'Biaya Ongkos Kirim'
        ];
        $total += $request['ongkir'];

        $transaction_details =  array(
            'order_id'      => Str::random(10),
            'gross_amount'  => (int)$total,
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => auth()->user()->name,
            'email'            => auth()->user()->email,
        );

        $params = array(
            'transaction_details'   => $transaction_details,
            'customer_details'      => $customer_details,
            'item_details'          => $items,
        );

        try {
            // Get Snap Payment Page URL
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $response->data = [
                'token' => $snapToken,
                'total' => $total
            ];
            $response->status = 'success';
            $response->status_code = 200;
            $response->message = 'Snap has been created';

            return $response;
        } catch (\Exception $e) {

            return $response;
        }
    }
}

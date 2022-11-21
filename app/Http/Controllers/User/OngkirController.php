<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\OngkirService;

class OngkirController extends Controller
{
    public function get_ongkir(OngkirService $ongkir_service)
    {
        $response = $ongkir_service->getOngkir();

        return response()->json($response, $response->status_code);
    }
}

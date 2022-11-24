<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Penjualan;

class ReportController extends Controller
{
    public function chart_penjualan()
    {
        $response = create_reponse();

        $data = [
            'list_bulan' => [],
            'list_harga' => []
        ];


        $year = date('Y');
        for ($month = 1; $month <= 12; $month++) {
            // Create a Carbon object from the current year and the current month (equals 2019-01-01 00:00:00)
            $bulan                   = Carbon::create($year, $month, 1, 10);
            $data['list_bulan'][]    = $bulan->monthName;
            $penjualan               = Penjualan::select(DB::raw('SUM(total) as total'))->whereMonth('created_at', '=', $month)->first()->total;
            $data['list_harga'][]    = $penjualan ?? 0;
        }

        $response->status_code = 200;
        $response->status      = 'success';
        $response->message     = 'Data Found';
        $response->data        = $data;

        return response()->json($response, $response->status_code);
    }
}

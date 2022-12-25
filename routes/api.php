<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProvinsiController;
use App\Http\Controllers\User\OngkirController;
use App\Http\Controllers\User\ProdukController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\PenjualanController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/provinsi/getkabupaten', [ProvinsiController::class, 'get_kabupaten']);
Route::get('/ongkir/getongkir', [OngkirController::class, 'get_ongkir']);
Route::post('/produk/filterbyprice', [ProdukController::class, 'filter_by_price']);
Route::get('/chartpenjualan', [ReportController::class, 'chart_penjualan']);
Route::post('/payment_handler', [PenjualanController::class, 'payment_handler']);

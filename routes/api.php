<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BarangControllerApi;
use App\Http\Controllers\api\FormMasukControllerApi;
use App\Http\Controllers\api\FormKeluarControllerApi;
use App\Http\Controllers\api\PengembalianControllerApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('barang', BarangControllerApi::class);
Route::apiResource('form-masuk', FormMasukControllerApi::class);
Route::apiResource('form-keluar', FormKeluarControllerApi::class);
Route::apiResource('pengambilan', PengembalianControllerApi::class);

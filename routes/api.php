<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\ProdukController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class,'login']);

Route::group(['middleware'=>'auth:sanctum'],function(){

    Route::resource('produk', ProdukController::class);

    Route::post('/produk/{id}', [ProdukController::class,'update']);

    Route::get('/kategoriproduk', [ProdukController::class,'kategoriProduk']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::apiResource('/posts', Api\PostController::class)->middleware('hak-akses');
// Route::apiResource('/kategori', Api\KategoriController::class);
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('posts', Api\PostController::class);
Route::apiResource('mahasiswa', Api\MahasiswaController::class);
Route::apiResource('pembayaran', Api\PembayaranController::class);
Route::apiResource('spp', Api\sppController::class);
// Route::middleware('auth:sanctum')->get('/', function (Request $request) {
//     Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
// });
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'signin']);
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'signup']);
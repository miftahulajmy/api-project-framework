<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/layout', function () {
    return view('layouts.main');
});
Route::apiResource('/posts',PostController::class);
Route::apiResource('/mahasiswa',MahasiswaController::class);
Route::apiResource('/spp',sppController::class);
Route::apiResource('/pembayaran',PembayaranController::class);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout',[App\Http\Controllers\Api\AuthController::class, 'logout']);
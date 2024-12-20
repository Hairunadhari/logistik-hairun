<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BarangMasukController::class, 'index']);
Route::post('/submit-barang-masuk', [BarangMasukController::class, 'submit']);

Route::get('/barang-keluar', [BarangKeluarController::class, 'index']);
Route::post('/submit-barang-keluar', [BarangKeluarController::class, 'submit']);

Route::get('/stok-barang', [StokBarangController::class, 'index']);

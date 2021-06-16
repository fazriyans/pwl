<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;

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
    //return view('welcome');
    return view('layouts.beranda');
});

Route::get('/beranda', function () {
    return view('layouts.beranda');
});

Route::get('/about', function () {
    return view('layouts.about');
});

Route::get('/salam', function () {
    return "Assalamu'alaikum Sobat, Selamat Belajara Laravel";
});

Route::get('/pegawai/{nama}/{divisi}', function ($nama,$divisi) {
    return 'Nama Pegawai: '.$nama.'<br/>Departemen: '.$divisi;
});

Route::get('/kabar', function () {
    return view('kondisi');
});

Route::get('/nilai', function () {
    return view('nilai');
});

Route::get('/daftarnilai', function () {
    return view('daftar_nilai');
});

Route::resource('/pengarang', PengarangController::class);
Route::resource('/buku', BukuController::class);
// Route::resource('/penerbit', PenerbitController::class);
// Route::resource('/kategori', KategoriController::class);
Route::resource('/anggota', AnggotaController::class);
// Route::resource('/peminjaman', PeminjamanController::class);
Route::get('generate-pdf', [BukuController::class, 'generatePDF']);
Route::get('bukupdf', [BukuController::class, 'bukuPDF']);

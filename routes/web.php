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

// Route::get('/', function () {
//     return view('layouts-front.app');
// });

Route::get('/dashboard', 'PagesController@dashboard');

Route::get('/data/eigen', 'DataController@vectorEigen');

// Landing Page
Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LoginController@logout');

// Otentikasi
Route::get('/register', 'RegisterController@register');
Route::post('/register', 'RegisterController@register');

// Profile
Route::get('/profile/{id}', 'UserController@edit');
Route::put('/profile/{id}', 'UserController@update');

// User
Route::get('/user', 'UserController@index');
Route::post('/user', 'UserController@store');
Route::get('/user/{id}', 'UserController@show');
Route::put('/user/{id}/status', 'UserController@ubahStatus');

// UMKM
Route::get('/umkm', 'UMKMController@index');
Route::get('/umkm/create', 'UMKMController@create');
Route::post('/umkm', 'UMKMController@store');
Route::get('/umkm/import', 'UMKMController@import');
Route::post('/umkm/import', 'UMKMController@import');
Route::get('/umkm/{id}', 'UMKMController@show');
Route::get('/personal/{id}/umkm', 'UMKMController@umkmShow');
Route::get('/persyaratan/{id}/umkm', 'UMKMController@persyaratan');
Route::put('/persyaratan/{id}/umkm', 'UMKMController@persyaratan');
Route::post('/umkm/{id}/surat', 'UMKMController@downloadSurat');
Route::get('/umkm/{id}/edit', 'UMKMController@edit');
Route::put('/umkm/{id}/edit', 'UMKMController@update');

// Pengurus
Route::get('/pengurus', 'PengurusController@index');
Route::get('/pengurus/create', 'PengurusController@create');
Route::post('/pengurus', 'PengurusController@store');
Route::get('/pengurus/{id}', 'PengurusController@show');
Route::get('/pengurus/{id}/edit', 'PengurusController@edit');
Route::put('/pengurus/{id}/edit', 'PengurusController@update');

// Persetujuan
Route::get('/persetujuan', 'PersetujuanBantuanController@index');
Route::get('/persetujuan/hitung', 'PersetujuanBantuanController@hitung');
Route::post('/persetujuan/{id}/ajukan', 'PersetujuanBantuanController@ajukan');
Route::put('/persetujuan/{id}/status/{method}', 'PersetujuanBantuanController@status');

// Data
Route::get('/dashboard/data', 'DataController@dashboard');

// Laporan
Route::get('/laporan', 'LaporanController@index');
Route::post('/laporan', 'LaporanController@index');
Route::post('/laporan/download', 'LaporanController@laporanPDF');

// Result
Route::get('/test1', 'UMKMController@hitung');


// Running Query
Route::get('/running/data', 'PersetujuanBantuanController@hitungData');

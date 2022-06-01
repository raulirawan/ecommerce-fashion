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
//     return view('welcome');
// });

Route::prefix('admin')->middleware(['admin','auth'])->group(function () {
    Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard.index');

    // CRUD KATEGORI
    Route::get('kategori', 'Admin\KategoriController@index')->name('admin.kategori.index');
    Route::post('kategori/create', 'Admin\KategoriController@store')->name('admin.kategori.store');
    Route::post('kategori/update/{id}', 'Admin\KategoriController@update')->name('admin.kategori.update');
    Route::delete('kategori/delete/{id}', 'Admin\KategoriController@delete')->name('admin.kategori.delete');


    // CRUD PRODUK
    Route::get('produk', 'Admin\ProdukController@index')->name('admin.produk.index');
    Route::post('produk/create', 'Admin\ProdukController@store')->name('admin.produk.store');
    Route::post('produk/update/{id}', 'Admin\ProdukController@update')->name('admin.produk.update');
    Route::delete('produk/delete/{id}', 'Admin\ProdukController@delete')->name('admin.produk.delete');

    // Transaksi
    Route::get('transaksi', 'Admin\TransaksiController@index')->name('admin.transaksi.index');
    Route::get('transaksi/detail/{id}', 'Admin\TransaksiController@detail')->name('admin.transaksi.detail');
    Route::post('transaksi/update/{id}', 'Admin\TransaksiController@update')->name('admin.transaksi.update');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

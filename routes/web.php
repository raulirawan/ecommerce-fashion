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

Route::get('/','HomeController@index')->name('home.index');
Route::get('/kategori/{slug}','KategoriController@index')->name('kategori.index');
Route::get('/produk/{slug}','ProdukController@detail')->name('produk.detail');

Route::get('/shop','ShopController@index')->name('shop.index');

Route::get('/search','ProdukController@search')->name('search.index');


Route::middleware(['auth'])->group(function () {
    Route::get('transaksi','TransaksiController@index')->name('transaksi.index');
    Route::get('transaksi/detail/{id}','TransaksiController@detail')->name('transaksi.detail');

    Route::get('profil','ProfilController@index')->name('profil.index');
    Route::post('profil/update-password','ProfilController@updatePassword')->name('update.password');
    Route::post('profil/update','ProfilController@update')->name('update.profil');

    Route::get('cart','CartController@index')->name('cart.index');
    Route::post('add/cart/{id}','CartController@addCart')->name('add.cart');
    Route::get('delete/cart/{id}','CartController@delete')->name('delete.cart');

    Route::get('/checkout','CheckoutController@index')->name('checkout.index');
    Route::get('/kota','CheckoutController@getKota')->name('fetch.kota');
    Route::post('/ongkir','CheckoutController@ongkir')->name('get.ongkir');

    Route::post('/checkout','CheckoutController@checkoutPost')->name('checkout.post');

    Route::get('/success','HomeController@success')->name('success.index');



});


Route::prefix('admin')->middleware(['admin','auth'])->group(function () {
    Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard.index');


    // CRUD CUSTOMER
    Route::get('customer', 'Admin\CustomerController@index')->name('admin.customer.index');
    Route::post('customer/create', 'Admin\CustomerController@store')->name('admin.customer.store');
    Route::post('customer/update/{id}', 'Admin\CustomerController@update')->name('admin.customer.update');
    Route::delete('customer/delete/{id}', 'Admin\CustomerController@delete')->name('admin.customer.delete');

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
    Route::post('transaksi/update/resi/{id}', 'Admin\TransaksiController@updateResi')->name('admin.transaksi.update.resi');
});

Route::prefix('pimpinan')->middleware(['auth'])->group(function () {
    Route::get('dashboard','Admin\DashboardController@index')->name('pimpinan.dashboard.index');

    // Transaksi
    Route::get('transaksi', 'Admin\TransaksiController@index')->name('pimpinan.transaksi.index');
    Route::get('transaksi/detail/{id}', 'Admin\TransaksiController@detail')->name('pimpinan.transaksi.detail');
    Route::post('transaksi/update/{id}', 'Admin\TransaksiController@update')->name('pimpinan.transaksi.update');
    Route::post('transaksi/update/resi/{id}', 'Admin\TransaksiController@updateResi')->name('pimpinan.transaksi.update.resi');


});



Auth::routes();

Route::post('/midtrans/callback', 'MidtransController@callback')->name('midtrans.callback');

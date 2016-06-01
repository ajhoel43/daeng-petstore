<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'C_barang@index');

Route::resource('barang', 'C_barang');
Route::resource('pembeli', 'C_pembeli');
Route::resource('transaksi', 'C_transaksi');
Route::get('transaksi/pembelian/{params}', 'C_transaksi@pembelian');
Route::post('transaksi/store_pembelian', 'C_transaksi@store_pembelian');

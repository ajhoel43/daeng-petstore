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

// memberikan nama ke routes agar dapat digunakan untuk fungsi Form::open
// Jika ingin menggunakan fungsi Redirect::route ataupun link_to_route
// ataupun fungsi yang berhubungan dengan pemanggilan routes
// kita harus memberikan alias terhadap masing-masing routes yang kita buat
Route::get('transaksi/{transaksi}/pembelian', [
	'as' => 'transaksi.pembelian', 
	'uses' => 'C_transaksi@pembelian'
	]);

Route::post('transaksi/store_pembelian', [
	'as' => 'transaksi.store_pembelian',
	'uses' => 'C_transaksi@store_pembelian'
	]);

Route::get('autocomplete_brg', [
	'as' => 'autocomplete_brg',
	'uses' => 'C_transaksi@barang_autocomplete'
	]);
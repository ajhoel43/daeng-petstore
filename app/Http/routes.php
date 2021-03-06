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

Route::get('/', function(){
	return view('layouts.frontpage');
});

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

Route::get('transaksi/{pembelian}/upd_pembelian', [
	'as' => 'pembelian.edit',
	'uses' => 'C_transaksi@edit_pembelian'
	]);

Route::post('transaksi/store_pembelian', [
	'as' => 'transaksi.store_pembelian',
	'uses' => 'C_transaksi@store_pembelian'
	]);

Route::post('transaksi/update_pembelian', [
	'as' => 'pembelian.update',
	'uses' => 'C_transaksi@update_pembelian'
	]);

// parameter pembelian harus menggunakan kata yang sama dengan addressnya
Route::delete('pembelian/{pembelian}', [
	'as' => 'pembelian.hapus',
	'uses' => 'C_transaksi@rm_pembelian'
	]);

Route::get('autocomplete_brg', [
	'as' => 'autocomplete_brg',
	'uses' => 'C_transaksi@barang_autocomplete'
	]);

Route::get('autocomplete_pembeli', [
	'as' => 'autocomplete_pembeli',
	'uses' => 'C_transaksi@autocomplete_pembeli'
	]);
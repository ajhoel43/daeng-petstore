<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaksi as Transaksi;
use App\Pembeli as Pembeli;
use App\Barang as Barang;
use View, Input, Validator, Redirect, DB, HTML;

class C_transaksi extends Controller
{
    public function index()
    {
    	$transaksis = Transaksi::all();
    	$transaksis->toArray();

    	return View::make('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
    	return View::make('transaksi.input');
    }

    public function store()
    {
        DB::beginTransaction();
        // Inserting Pembeli
    	$input = Input::all();

        $pembeli = Pembeli::firstOrCreate(['nama' => $input['nama']]);
        // if($input['id'] == '')
        // {
        //     $insert = Pembeli::create($input);
        // }

        // Inserting Transaksi
        $transaksi = new Transaksi;
        $transaksi->tanggal = FormatDateDB();
        $transaksi->pembeli_id = $pembeli->id;
        $insert = $transaksi->save();

        if($insert)
        {
            DB::commit();
            $data = array(
                'id' => $transaksi->id,
                );

            return Redirect::action('C_transaksi@pembelian', $transaksi->id);
            // return Redirect::route('transaksi.pembelian', $transaksi->id);
        }
        else
        {
            DB::rollback();
            $message = 'Oops! some error when inserting data';
            return Redirect::route('transaksi.create')
                ->with('message', error_delimiter('danger', $message));
        }
    }

    // Untuk menginputkan barang yang akan dibeli
    public function pembelian($id)
    {
        $transaksi = Transaksi::find($id)->first();
        // dd($transaksi);
    	return View::make('transaksi.pembelian', compact('transaksi'));
    }

    public function show($params = array())
    {
        $this->barang_autocomplete();
        dd($params, 'test');
    	// $id = $params['id'];
        $transaksi = Transaksi::find($id);
        dd($transaksi);
        return View::make('transaksi.pembelian', compact('pembeli'));
    }

    public function store_pembelian()
    {
        dd('TESTING');
    }

    public function barang_autocomplete()
    {
        $params = Input::all();

        $barangs = DB::table('barangs')
                    ->where('nama', 'like', "%".$params['nama_brg']."%")
                    ->get();

        $result = array(
            'error' => 1,
            'error_msg' => 'Testing Error',
            'barang' => $barangs
            );
        $json = array();
        foreach ($barangs as $index => $barang) {
            $json[] = $barang->nama;
        }

        die(json_encode($json));
    }
}

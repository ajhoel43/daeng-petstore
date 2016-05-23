<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaksi as Transaksi;
use App\Pembeli as Pembeli;
use View, Input, Validator, Redirect;

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
    	$input = Input::all();

        $insert = Pembeli::create($input);

        if($insert)
            return Redirect::route('pembeli.index');
        else
        {
            return Redirect::route('transaksi.create')
                ->with('message', 'Error when insert data.');
        }
    }

    // Untuk menginputkan barang yang akan dibeli
    public function pembelian()
    {
    	dd("Sukses");
    }
    public function show()
    {
    	dd("SUCCESS");
    }
}

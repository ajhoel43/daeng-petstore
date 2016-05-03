<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaksi as Transaksi;
use View, Input, Validator, Redirect;

class C_transaksi extends Controller
{
    public function index()
    {
    	$transaksis = Transaksi::all();
    	$transaksis->toArray();

    	return View::make('transaksi.index', compact('transaksis'));
    }
}

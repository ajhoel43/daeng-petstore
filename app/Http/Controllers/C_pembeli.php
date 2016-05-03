<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pembeli as Pembeli;
use View, Input, Validator, Redirect;

class C_pembeli extends Controller
{
    public function index()
    {
    	$pembelis = Pembeli::all();
    	$pembelis->toArray();

    	return View::make('pembeli.index', compact('pembelis'));
    }
}

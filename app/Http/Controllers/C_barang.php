<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Barang as Barang;
use View, Input, Validator, Redirect;

class C_barang extends Controller
{
    public function index()
    {
    	$barangs = Barang::all();
    	$barangs->toArray();

    	return View::make('barang.index', compact('barangs'));
    }

    public function store()
    {
    	$input = Input::all();
        $validation = Validator::make($input, Barang::validation());

        if ($validation->passes())
        {
            Barang::create($input);

            return Redirect::route('barang.index');
        }

        return Redirect::route('barang.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function create()
    {
    	return View::make('barang.create');
    }

    public function update($id)
    {
    	$input = Input::all();
        $validation = Validator::make($input, Barang::validation());
        if ($validation->passes())
        {
            $user = Barang::find($id);
            $user->update($input);
            return Redirect::route('barang.index');
        }
		return Redirect::route('barang.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function show()
    {
    	# code...
    }

    public function destroy($id)
    {
    	Barang::find($id)->delete();
        return Redirect::route('barang.index');
    }

    public function edit($id)
    {
    	$barang = Barang::find($id);
        if (is_null($barang))
        {
            return Redirect::route('barang.index');
        }
        return View::make('barang.edit', compact('barang'));
    }
}

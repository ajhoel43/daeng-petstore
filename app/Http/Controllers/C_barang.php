<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Barang as Barang;
use View, Input, Validator, Redirect, DB;

class C_barang extends Controller
{
    protected $jenisbarang = array();

    protected $satuan = array();

    public function __construct()
    {
        $this->jenisbarang = array(
            'Hewan' => 'Hewan',
            'Makanan' => 'Makanan',
            'Perlengkapan' => 'Perlengkapan'
            );

        $this->satuan = array(
            'Gram' => 'Gram', 
            'Kg' => 'Kg', 
            'Pcs' => 'Pcs', 
            'Lsn' => 'Lsn', 
            'Ekor' => 'Ekor'
            );
    }

    public function index()
    {
    	$barangs = Barang::all();
    	$barangs->toArray();

    	return View::make('barang.index', compact('barangs'));
    }

    public function store()
    {
    	$input = Input::all();

        $insert = Barang::create($input);

        if($insert)
            return Redirect::route('barang.index');
        else
        {
            return Redirect::route('barang.create')
                ->with('message', 'Error when insert data.');
        }
    }

    public function create()
    {
        $data = array(
            'jenis' => $this->jenisbarang,
            'satuan' => $this->satuan
            );

    	return View::make('barang.inputbarang', compact('data'));
    }

    public function update($id)
    {
    	$input = Input::all();

        $user = Barang::find($id);
        $update = $user->update($input);
        if($update)
            return Redirect::route('barang.index');
        else
        {
    		return Redirect::route('barang.edit', $id)
                ->with('message', 'Error when update data.');
        }
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
            return Redirect::route('barang.index')->with('message', 'Barang dengan $id tidak ditemukan');
        }
        $data['jenis'] = $this->jenisbarang;
        $data['satuan'] = $this->satuan;

        return View::make('barang.editbarang', compact(array('barang', 'data')));
    }
}

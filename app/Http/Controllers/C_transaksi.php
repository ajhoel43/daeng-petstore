<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaksi as Transaksi;
use App\Pembeli as Pembeli;
use App\Pembelian as Pembelian;
use App\Barang as Barang;
use View, Input, Validator, Redirect, DB, HTML, Response;

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

        // $pembeli = Pembeli::firstOrCreate(['nama' => $input['nama']]);
        if($input['id'] == '')
        {
            $pembeli = Pembeli::create($input);
        }
        else
        {
            $org = Pembeli::find($input['id']);
            $pembeli = $org->update($input);
        }

        // Inserting Transaksi
        $transaksi = new Transaksi;
        $transaksi->tanggal = FormatDateDB();
        $transaksi->pembeli_id = $org->id;
        $insert = $transaksi->save();

        if($insert && $pembeli)
        {
            DB::commit();
            $data = array(
                'id' => $transaksi->id,
                );

            return Redirect::action('C_transaksi@pembelian', $transaksi->id);
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
        $transaksi = Transaksi::find($id);
        $barangs = Pembelian::where('transaksi_id', $id)->get();

    	return View::make('transaksi.pembelian', compact('transaksi', 'barangs'));
    }

    public function show($params = array())
    {

    }

    public function store_pembelian()
    {
        $input = Input::all();

        $id_tr = Input::get('transaksi_id');
        unset($input['submit']);

        DB::beginTransaction();
        $result = Pembelian::create($input);

        if($result)
        {
            DB::commit();
            $message = 'Data has been insert successfully';
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->with('message', error_delimiter('success', $message));
        }

        DB::rollback();
        $message = 'Oops!! Something went wrong when inserting data';
        return Redirect::route('transaksi.pembelian', $id_tr)
            ->with('message', error_delimiter('warning', $message));
    }

    public function barang_autocomplete()
    {
        $params = Input::all();

        $barangs = DB::table('barangs')
                    ->where('nama', 'like', "%".$params['term']."%")
                    ->get();

        $result = array();
        foreach ($barangs as $index => $barang) {
            $result[] = array(
                'value' => $barang->nama, 
                'id' => $barang->id,
                'satuan' => $barang->satuan,
                'harga' => $barang->harga,
                );
        }

        return Response::json($result);
    }

    public function autocomplete_pembeli()
    {
        $params = Input::all();

        $pembelis = DB::table('pembelis')
                    ->where('nama', 'like', "%".$params['term']."%")
                    ->get();

        $json = array();
        foreach ($pembelis as $index => $pembeli) {
            $json[] = array(
                'value' => $pembeli->nama, 
                'id' => $pembeli->id,
                'alamat' => $pembeli->alamat
                );
        }

        return Response::json($json);
    }
}

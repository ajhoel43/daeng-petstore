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
            $pembeli = $org = Pembeli::create($input);
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

    public function edit_pembelian($id)
    {
        $pembelian = Pembelian::find($id);

        return View::make('transaksi.edit_pembelian', compact('pembelian'));
    }

    public function update_pembelian()
    {
        $input = Input::all();

        $id_tr = Input::get('transaksi_id');
        unset($input['submit']);

        if($input['barang_id'] == '0' || $input['barang_id'] == null)
        {
            $message = 'Oops!! Terjadi error, barang tidak ditemukan';
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->with('message', error_delimiter('danger', $message));
        }

        DB::beginTransaction();
        
        $id_pbl = Input::get('id');
        $old_pembelian = Pembelian::find($id_pbl);

        $sparams = array(
            'id' => $input['barang_id'],
            'qty' => $input['qty'],
            'old_qty' => $old_pembelian->qty,
            'type' => 'update'
            );
        list($upd_stock, $msg) = $this->update_stock($sparams);

        if(!$upd_stock)
        {
            DB::rollback();
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->with('message', error_delimiter('danger', $msg));
        }

        $pembelian = Pembelian::find($id_pbl);
        $result = $pembelian->update($input);

        if($result)
        {
            DB::commit();
            $message = 'Data has been update successfully';
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->with('message', error_delimiter('success', $message));
        }

        DB::rollback();
        $message = 'Oops!! Something went wrong when updating data';
        return Redirect::route('transaksi.pembelian', $id_tr)
            ->with('message', error_delimiter('warning', $message));
    }

    public function rm_pembelian($id)
    {
        DB::beginTransaction();
        $pembelian = Pembelian::find($id);
        $id_tr = $pembelian->transaksi_id;

        $sparams = array(
            'id' => $pembelian->barang_id,
            'qty' => $pembelian->qty,
            'type' => 'delete'
            );

        $upd_stock = $this->update_stock($sparams);

        $result = $pembelian->delete();

        if($upd_stock && $result)
        {
            DB::commit();
            $message = 'Data has been deleted successfully';
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->with('message', error_delimiter('success', $message));
        }

        DB::rollback();
        $message = 'Oops!! Something went wrong when deleting data';
        return Redirect::route('transaksi.pembelian', $id_tr)
            ->with('message', error_delimiter('warning', $message));
    }

    public function show($params = array())
    {

    }

    public function destroy()
    {
        
    }

    public function store_pembelian()
    {
        $input = Input::all();

        $id_tr = Input::get('transaksi_id');

        $repop_form = $input;
        unset($input['nama_barang']);
        unset($input['submit']);

        if($input['barang_id'] == '0' || $input['barang_id'] == null)
        {
            $message = 'Oops!! Terjadi error, barang tidak ditemukan';
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->withInput($repop_form)
                ->with('message', error_delimiter('danger', $message));
        }

        DB::beginTransaction();

        $sparams = array(
            'id' => $input['barang_id'],
            'qty' => $input['qty']
            );
        list($upd_stock, $msg) = $this->update_stock($sparams);

        if(!$upd_stock)
        {
            DB::rollback();
            return Redirect::route('transaksi.pembelian', $id_tr)
                ->withInput($repop_form)
                ->with('message', error_delimiter('danger', $msg));
        }

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
            ->withInput($repop_form)
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

    function update_stock($params = array())
    {
        $message = '';
        $barang = Barang::find($params['id']);
        $remain_stock = 0;

        if(isset($params['type']) && $params['type'] == 'update')
        {
            $remain_stock = $barang->stok + $params['old_qty'];
            $remain_stock = $remain_stock - $params['qty'];
        }
        else if(isset($params['type']) && $params['type'] == 'delete')
        {
            $remain_stock = $barang->stok + $params['qty'];
        }
        else
        {
            $remain_stock = $barang->stok - $params['qty'];
        }

        $barang->stok = $remain_stock;

        if($remain_stock < 0)
        {
            $message = 'Oops!! Stok barang tidak mencukupi :(';
            return array(false, $message);
        }

        $result = $barang->update();
        
        if(!$result)
            $message = 'Oops!! Terjadi error, gagal memperbaharui stok barang';

        return array($result, $message);
    }
}

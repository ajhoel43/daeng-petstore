<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
	protected $guarded = array('id');
	public $timestamps = false;

    public function barang()
    {
    	return $this->belongsTo('App\Barang');
    }

    public function transaksi(){
    	return $this->belongsTo('App\Transaksi');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	protected $guarded = array('id');

	public function pembelian(){
    	return $this->belongsTo('App\Pembelian');
    }
}

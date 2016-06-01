<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = array('id');

    public function pembeli(){
    	return $this->belongsTo('App\Pembeli');
    }

    public function pembelian(){
    	return $this->hasMany('App\Pembelian');
    }
}

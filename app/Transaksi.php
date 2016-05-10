<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = array('id');

    public function pembeli(){
    	return $this->hasOne('App\Pembeli');
    }

    public function barang(){
    	return $this->hasMany('App\Barang');
    }
}

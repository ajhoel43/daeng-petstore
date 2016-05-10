<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $guarded = array('id');

    public function transaksi(){
    	return $this->belongsTo('App\Transaksi');
    }
}

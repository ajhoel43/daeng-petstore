<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->integer('transaksi_id');
            $table->integer('barang_id');
            $table->integer('satuan');
            $table->bigInteger('qty');
            $table->double('harga_satuan', 12, 2);
            $table->double('total_harga', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pembelians');
    }
}

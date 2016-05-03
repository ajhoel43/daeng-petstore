<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TabelBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('barangs')->insert([
        // 	'nama' => str_random(10),
        // 	'jenis' => '1',
        // 	'harga' => 25000,
        // 	'stok' => 100,
        // 	'satuan' => 1
        // 	]);

        // $array_pembeli = array();
        // DB::table()

        // factory(App\Barang::class, 50)->create()->each(function($u) {
        // 	$u->barangs()->save(factory(App\Barang::class)->make());
        // });

        factory(App\Barang::class, 50)->create();
    }
}

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
        factory(App\Barang::class, 5)->create();
        factory(App\Pembeli::class, 5)->create();
    }
}

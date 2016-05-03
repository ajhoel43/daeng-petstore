<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Barang::class, function(Faker\Generator $faker){
	$input_jenis = array('Hewan', 'Makanan', 'Perlengkapan');
	$rand_jenis = array_rand($input_jenis, 1);

	$input_stn = array('Gram', 'Kg', 'Pcs', 'Lsn');
	$rand_stn = array_rand($input_stn, 1);
	
	return [
		'nama' => $faker->name,
		'jenis' => $input_jenis[$rand_jenis],
		'harga' => rand(10000, 1000000),
		'stok'  => rand(10, 1000),
		'satuan' => $input_stn[$rand_stn],
	];
});

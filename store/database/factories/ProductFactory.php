<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'product_id' => "4a149a9a-9758-11e9-bc42-526af7764f64",
        'artist' => "Foo Fighters",
        'year' => 1993,
        'album' => "Foo Fighters: Learning to Fly",
        'price' => 100,
        'store' => "Super Discos",
        'thumb' => "https://images-na.ssl-images-amazon.com/images/I/71F08TZfw1L._SX569_.jpg",
        'date' => "18/08/2019" 
    ];
});

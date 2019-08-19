<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Cart::class, function (Faker $faker) {
    return [
        'cart_id' => $faker->name,
        'client_id' => $faker->name,
        'product_id' => $faker->name,
        'date' => $faker->name,
        'time' => $faker->name 
    ];
});

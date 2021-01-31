<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'sku' => $faker->unique()->lexify('id-????'),
        'imageUrl' => $faker->url(),
        'quantity' => $faker->randomNumber(3, false),
        'price' => $faker->numerify('##.##'),
        'description' => $faker->sentence()
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'active' => '1',
        'description' => $faker->text,
        'url' => $faker->url,
        'mincpc' => $faker->randomFloat(2, 1, 3),
        'maxcpc' => $faker->randomFloat(2, 3, 5),
        'clicks_total' => $faker->randomDigit(1, 2000),
        'clicks_last_week' => $faker->randomDigit(1, 2000),
        'campaigns_count' => $faker->randomDigit(1, 20),
        'spendings_total' => $faker->randomFloat(2, 0, 2000),
        'spendings_last_week' => $faker->randomFloat(2, 0, 2000),
        'fixcpc' => 0,
        'name' => $faker->company,
        'image' => $faker->imageUrl(),
    ];
});

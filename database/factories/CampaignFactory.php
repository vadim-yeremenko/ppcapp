<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Campaign;
use Faker\Generator as Faker;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'user_id' => '33',
        'product_id' => $faker->optional()->numberBetween(1, 28),
        'subproduct_id' => $faker->optional()->numberBetween(1, 28),
        'url' => $faker->url,
        'cpc' => $faker->randomFloat(2, 1, 3),
        'image' => $faker->imageUrl(),
        'is_active' => '1',
        'date' => $faker->dateTimeBetween('-2 week'),
    ];
});

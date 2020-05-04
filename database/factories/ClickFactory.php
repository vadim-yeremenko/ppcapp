<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Click;
use Faker\Generator as Faker;

$factory->define(Click::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTimeBetween('-2 week'),
        'user_id' => $faker->randomDigit(2, 5),
        'product_id' => $faker->randomDigit(1, 5),
        'campaign_id' => $faker->randomDigit(1, 50),
        'subproduct_id' => $faker->randomDigit(1, 5),
        'url' => $faker->url,
        'date' => $faker->dateTimeBetween('-2 week'),
        'spending_id' => $faker->randomDigit(1, 50),
    ];
});

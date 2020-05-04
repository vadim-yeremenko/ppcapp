<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Spending;
use Faker\Generator as Faker;

$factory->define(Spending::class, function (Faker $faker) {
    return [
        'value' => $faker->randomFloat(2, 1, 5),
        'date' => $faker->dateTimeBetween('-2 week'),
        'user_id' => $faker->randomDigit(1, 5),
        'campaign_id' => $faker->randomDigit(1, 5),
        'product_id' => $faker->randomDigit(1, 5),
        'subproduct_id' => $faker->randomDigit(1, 5),
        'click_id' => $faker->randomDigit(1, 50),
    ];
});

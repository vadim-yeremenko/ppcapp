<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Charge;
use Faker\Generator as Faker;

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'value' => $faker->randomFloat(1, 100, 10000),
        'balance' => $faker->randomFloat(1, 100, 10000),
        'date' => $faker->dateTimeBetween('-2 week'),
        'user_id' => 2,
    ];
});

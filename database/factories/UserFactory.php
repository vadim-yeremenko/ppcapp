<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'organization' => $faker->company,
        'address' => $faker->address,
        'role' => $faker->randomElement(array('Manager', 'Secretary', 'CEO')),
        'active' => $faker->numberBetween(0, 1),
        'balance' => $faker->numberBetween(0, 3300),
        'avatar' => $faker->imageUrl(),
        'spendings_total' => $faker->numberBetween(0, 3300),
        'spendings_last_week' => $faker->numberBetween(0, 3300),
        'campaigns_count' => $faker->numberBetween(0, 30),
        'password' => '', // password
        'remember_token' => Str::random(10),
    ];
});

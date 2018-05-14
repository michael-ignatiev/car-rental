<?php

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

$factory->define(App\Discount::class, function (Faker $faker) {
    return [
        'promo_code' => $faker->word,
        'description' => $faker->text,
        'amount' => rand(10, 90),
        'is_active' => rand(0, 1),
        'activity_start' => \Carbon\Carbon::now(),
        'activity_end' => \Carbon\Carbon::now()->addDays(rand(1, 20)),
    ];
});

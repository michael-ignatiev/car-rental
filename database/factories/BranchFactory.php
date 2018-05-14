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

$factory->define(App\Branch::class, function (Faker $faker) {
    $cities = \App\City::all();
    return [
        'address' => $faker->address,
        'city_id' => function() use ($cities){
            return rand($cities->min('id'), $cities->max('id'));
        },
        'is_active' => rand(0, 1),
    ];
});

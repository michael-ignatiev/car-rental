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

$factory->define(App\City::class, function (Faker $faker) {
    $countries = \App\Country::all();
    return [
        'name' => $faker->city,
        'country_id' => function() use ($countries){
            return rand($countries->min('id'), $countries->max('id'));
        },
        'is_active' => true,
    ];
});

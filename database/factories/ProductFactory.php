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

$factory->define(App\Product::class, function (Faker $faker) {
    $branches = \App\Branch::all();
    $productTypes = \App\ProductType::all();
    return [
        'model' => $faker->word,
        'branch_id' => function() use ($branches){
            return rand($branches->min('id'), $branches->max('id'));
        },
        'price_per_hour' => 500,
        'product_type_id' => function() use ($productTypes){
            return rand($productTypes->min('id'), $productTypes->max('id'));
        },
        'is_active' => rand(0, 1),
    ];
});

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

$factory->define(App\Order::class, function (Faker $faker) {
    $users = \App\User::all();
    $products = \App\Product::all();
    $rentalPlans = \App\RentalPlan::all();
    $branches = \App\Branch::all();
    $paymentTypes = \App\PaymentType::all();
    $paymentStatuses = \App\PaymentStatus::all();
    $discounts = \App\Discount::all();
    return [
        'user_id' => function() use ($users){
            return rand($users->min('id'), $users->max('id'));
        },
        'product_id' => function() use ($products){
            return rand($products->min('id'), $products->max('id'));
        },
        'rental_plan_id' => function() use ($rentalPlans){
            return rand($rentalPlans->min('id'), $rentalPlans->max('id'));
        },
        'branch_to_take_from_id' => function() use ($branches){
            return rand($branches->min('id'), $branches->max('id'));
        },
        'branch_to_return_to_id' => function() use ($branches){
            return rand($branches->min('id'), $branches->max('id'));
        },
        'payment_type_id' => function() use ($paymentTypes){
            return rand($paymentTypes->min('id'), $paymentTypes->max('id'));
        },
        'payment_status_id' => function() use ($paymentStatuses){
            return rand($paymentStatuses->min('id'), $paymentStatuses->max('id'));
        },
        'price' => function(){
            return rand(2000, 30000);
        },
        'discount_id' => function() use ($discounts){
            return rand($discounts->min('id'), $discounts->max('id'));
        },
        'total' => function(){
            return rand(2000, 30000);
        },
        'comment' => $faker->text,
    ];
});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => env('API_CURRENT_VERSION')], function() {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Auth\LoginController@logout');   
        
        Route::get('products/', 'ProductController@index')->middleware('rbac.action:product.showAll');
        Route::get('products/{id}', 'ProductController@show')->middleware('rbac.action:product.showOne');
        Route::post('products/', 'ProductController@store')->middleware('rbac.action:product.store');
        Route::put('products/{id}', 'ProductController@update')->middleware('rbac.action:product.update');
        
        Route::get('orders/', 'OrderController@index')->middleware('rbac.action:order.showAll');
        Route::get('orders/{id}', 'OrderController@show')->middleware('rbac.action:order.showOne');
        Route::post('orders/', 'OrderController@store')->middleware('rbac.action:order.store');
        Route::put('orders/{id}', 'OrderController@update')->middleware('rbac.action:order.update');
        
        Route::get('users/', 'UserController@index')->middleware('rbac.action:user.showAll');
        Route::get('users/{id}', 'UserController@show')->middleware('rbac.action:user.showOne');
        Route::post('users/', 'UserController@store')->middleware('rbac.action:user.store');
        Route::put('users/{id}', 'UserController@update')->middleware('rbac.action:user.update');
        Route::get('users/{id}/orders', 'UserController@showOrders')->middleware('rbac.action:user.showOrders');
        
        Route::get('branches/', 'BranchController@index')->middleware('rbac.action:branch.showAll');
        Route::get('branches/{id}', 'BranchController@show')->middleware('rbac.action:branch.showOne');
        Route::post('branches/', 'BranchController@store')->middleware('rbac.action:branch.store');
        Route::put('branches/{id}', 'BranchController@update')->middleware('rbac.action:branch.update');
        Route::get('branches/{id}/products', 'BranchController@showProducts')->middleware('rbac.action:branch.showProducts');
    });
});

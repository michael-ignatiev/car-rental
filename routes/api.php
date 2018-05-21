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
        Route::resource('products', 'ProductController');
        Route::resource('users', 'UserController');
        Route::resource('branches', 'BranchController');
        Route::resource('orders', 'OrderController');
        
        Route::get('users/{id}/orders', 'UserController@showOrders');
        Route::get('branches/{id}/products', 'BranchController@showProducts');
    });
});

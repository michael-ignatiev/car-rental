<?php

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
        
        Route::prefix('products')->group(base_path('routes/modules/products.php'));
        Route::prefix('orders')->group(base_path('routes/modules/orders.php'));
        Route::prefix('users')->group(base_path('routes/modules/users.php'));
        Route::prefix('branches')->group(base_path('routes/modules/branches.php'));
    });
});

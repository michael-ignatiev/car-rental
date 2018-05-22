<?php

Route::get('/', 'ProductController@index')->middleware('rbac.action:product.showAll');
Route::get('/{id}', 'ProductController@show')->middleware('rbac.action:product.showOne');
Route::post('/', 'ProductController@store')->middleware('rbac.action:product.store');
Route::put('/{id}', 'ProductController@update')->middleware('rbac.action:product.update');
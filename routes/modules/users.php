<?php

Route::get('/', 'UserController@index')->middleware('rbac.action:user.showAll');
Route::get('/{id}', 'UserController@show')->middleware('rbac.action:user.showOne');
Route::post('/', 'UserController@store')->middleware('rbac.action:user.store');
Route::put('/{id}', 'UserController@update')->middleware('rbac.action:user.update');
Route::get('/{id}/orders', 'UserController@showOrders')->middleware('rbac.action:user.showOrders');
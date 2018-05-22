<?php

Route::get('/', 'OrderController@index')->middleware('rbac.action:order.showAll');
Route::get('/{id}', 'OrderController@show')->middleware('rbac.action:order.showOne');
Route::post('/', 'OrderController@store')->middleware('rbac.action:order.store');
Route::put('/{id}', 'OrderController@update')->middleware('rbac.action:order.update');
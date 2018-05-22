<?php

Route::get('/', 'BranchController@index')->middleware('rbac.action:branch.showAll');
Route::get('/{id}', 'BranchController@show')->middleware('rbac.action:branch.showOne');
Route::post('/', 'BranchController@store')->middleware('rbac.action:branch.store');
Route::put('/{id}', 'BranchController@update')->middleware('rbac.action:branch.update');
Route::get('/{id}/products', 'BranchController@showProducts')->middleware('rbac.action:branch.showProducts');
<?php
Route::get('navigation', 'NavigationController@index')->name('admin.navigation.index');
Route::get('navigation/create', 'NavigationController@create')->name('admin.navigation.store');
Route::post('navigation/create', 'NavigationController@store');
Route::get('navigation/{id}', 'NavigationController@edit')->name('admin.navigation.edit');
Route::post('navigation/{id}', 'NavigationController@update')->name('admin.navigation.update');
Route::post('navigation/delete/{id}', 'NavigationController@delete')->name('admin.navigation.delete');

Route::get('navigation-item', 'NavigationItemController@index')->name('admin.navigation.item.index');
Route::match(['get', 'post'], 'navigation-item/form/{group}/{item?}', 'NavigationItemController@create')->name('admin.navigation.item.create');
Route::post('navigation-item', 'NavigationItemController@store')->name('admin.navigation.item.store');
Route::post('navigation-item/update/{id}', 'NavigationItemController@update')->name('admin.navigation.item.update');
Route::post('navigation-item/delete/{id}', 'NavigationItemController@delete')->name('admin.navigation.item.delete');
Route::post('navigation-item/reorder', 'NavigationItemController@reorder')->name('admin.navigation.item.reorder');
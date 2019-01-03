<?php
Route::get('page/export', 'PageController@export')->name('admin.page.export');
Route::post('page/switch', 'PageController@switch')->name('admin.page.switch');
Route::get('page', 'PageController@index')->name('admin.page.index');
Route::get('page/create', 'PageController@create')->name('admin.page.store');
Route::post('page/create', 'PageController@store');
Route::get('page/{id}', 'PageController@edit')->name('admin.page.edit');
Route::post('page/{id}', 'PageController@update')->name('admin.page.update');
Route::post('page/delete/{id}', 'PageController@delete')->name('admin.page.delete');

<?php
Route::get('banner/export', 'BannerController@export')->name('admin.banner.export');
Route::post('banner/switch', 'BannerController@switch')->name('admin.banner.switch');
Route::get('banner', 'BannerController@index')->name('admin.banner.index');
Route::get('banner/create', 'BannerController@create')->name('admin.banner.store');
Route::post('banner/create', 'BannerController@store');
Route::get('banner/{id}', 'BannerController@edit')->name('admin.banner.edit');
Route::post('banner/{id}', 'BannerController@update')->name('admin.banner.update');
Route::post('banner/delete/{id}', 'BannerController@delete')->name('admin.banner.delete');

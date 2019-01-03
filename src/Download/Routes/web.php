<?php
Route::get('download/reset', 'DownloadController@reset')->name('admin.download.reset');
Route::get('download/export', 'DownloadController@export')->name('admin.download.export');
Route::post('download/switch', 'DownloadController@switch')->name('admin.download.switch');
Route::get('download', 'DownloadController@index')->name('admin.download.index');
Route::get('download/create', 'DownloadController@create')->name('admin.download.store');
Route::post('download/create', 'DownloadController@store');
Route::get('download/{id}', 'DownloadController@edit')->name('admin.download.edit');
Route::post('download/{id}', 'DownloadController@update')->name('admin.download.update');
Route::post('download/delete/{id}', 'DownloadController@delete')->name('admin.download.delete');

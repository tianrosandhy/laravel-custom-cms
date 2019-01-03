<?php
Route::get('project/export', 'ProjectController@export')->name('admin.project.export');
Route::post('project/switch', 'ProjectController@switch')->name('admin.project.switch');
Route::get('project', 'ProjectController@index')->name('admin.project.index');
Route::get('project/create', 'ProjectController@create')->name('admin.project.store');
Route::post('project/create', 'ProjectController@store');
Route::get('project/{id}', 'ProjectController@edit')->name('admin.project.edit');
Route::post('project/{id}', 'ProjectController@update')->name('admin.project.update');
Route::post('project/delete/{id}', 'ProjectController@delete')->name('admin.project.delete');

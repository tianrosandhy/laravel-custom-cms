<?php
Route::post('api/store-images', 'Api\ImageStore@index');
Route::post('api/store-tinymce', 'Api\ImageStore@tinyMce');
Route::post('api/remove-images', 'Api\ImageStore@removeImages');
Route::post('api/store-files', 'Api\FileStore@index');
Route::post('api/remove-files', 'Api\FileStore@removeImages');


//datatable
Route::post('setting/table/user', 'UserManagementController@table')->name('admin.user.datatable');
Route::post('setting/table/log', 'LogController@table')->name('admin.log.datatable');
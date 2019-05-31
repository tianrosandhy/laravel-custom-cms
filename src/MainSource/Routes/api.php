<?php
Route::post('api/store-images', config('cms.controller.api-store-image', 'Api\ImageStore@index'));
Route::post('api/store-tinymce', config('cms.controller.api-store-tinymce', 'Api\ImageStore@tinyMce'));
Route::post('api/remove-images', config('cms.controller.api-remove-image', 'Api\ImageStore@removeImages'));
Route::post('api/store-files', config('cms.controller.api-store-file', 'Api\FileStore@index'));
Route::post('api/remove-files', config('cms.controller.api-remove-file', 'Api\FileStore@removeImages'));
Route::post('api/cropper', config('cms.controller.api-cropper', 'Api\ImageStore@cropper'))->name('api.cropper');

//datatable
Route::post('setting/table/user', config('cms.controller-datatable-user', 'UserManagementController@table'))->name('admin.user.datatable');

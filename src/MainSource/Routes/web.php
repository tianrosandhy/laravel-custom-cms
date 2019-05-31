<?php
Route::get('/', config('cms.controller.dashboard', 'MainController@index'))->name('admin.splash');
Route::get('login', config('cms.controller.login', 'Auth\LoginController@showLoginForm'));
Route::post('login', config('cms.controller.login-post', 'Auth\LoginController@login'));
Route::match(['get', 'post'], 'logout', config('cms.controller.logout', 'Auth\LoginController@logout'));

Route::get('register', config('cms.controller.register', 'Auth\RegisterController@showRegistrationForm'));
Route::post('register', config('cms.controller.register-post', 'Auth\RegisterController@register'));

Route::get('activate/{hash}', config('cms.controller.activate', 'Auth\ActivationController@index'));
Route::post('resend-validation', config('cms.controller.resend-validation', 'Auth\ActivationController@resend'));
Route::post('reset-password', config('cms.controller.reset-password', 'Auth\ForgotPasswordController@index'));
Route::get('reset-password/{hash}', config('cms.controller.reset-password-validate', 'Auth\ForgotPasswordController@changePassword'));
Route::post('reset-password/{hash}', config('cms.controller.reset-password-process', 'Auth\ForgotPasswordController@applyPassword'));


Route::get('my-profile', config('cms.controller.my-profile', 'Auth\ProfileController@index'));
Route::post('my-profile', config('cms.controller.my-profile-post', 'Auth\ProfileController@store'));
Route::post('lang/{type}', config('cms.controller.switch-lang', 'MainController@switchLang'));


Route::get('setting', config('cms.controller.setting', 'SettingController@index'))->name('admin.setting.index');
Route::post('setting', config('cms.controller.setting-post', 'SettingController@store'))->name('admin.setting.store');
Route::post('setting/update', config('cms.controller.setting-update', 'SettingController@update'))->name('admin.setting.update');
Route::post('setting/delete/{id}', config('cms.controller.setting-delete', 'SettingController@delete'))->name('admin.setting.delete');
Route::post('setting/artisan', config('cms.controller.artisan', 'SettingController@postArtisan'))->name('admin.maintenance.artisan');


Route::get('setting/permission', config('cms.controller.permission', 'PermissionController@index'))->name('admin.permission.index');
Route::post('setting/permission', config('cms.controller.permission-post', 'PermissionController@store'))->name('admin.permission.store');
Route::post('setting/permission/update/{id}', config('cms.controller.permission-update', 'PermissionController@update'))->name('admin.permission.update');
Route::post('setting/show-permission/{id}', config('cms.controller.permission-show', 'PermissionController@showPermission'))->name('admin.permission.manage');
Route::post('setting/permission/delete/{id}', config('cms.controller.permission-delete', 'PermissionController@delete'))->name('admin.permission.delete');
Route::post('setting/save-permission/{id}', config('cms.controller.permission-save', 'PermissionController@savePermission'));


Route::get('setting/user/export', config('cms.controller.user-export', 'UserManagementController@export'))->name('admin.user.export');
Route::get('setting/user', config('cms.controller.user', 'UserManagementController@index'))->name('admin.user.index');
Route::get('setting/user/create', config('cms.controller.user-create', 'UserManagementController@create'))->name('admin.user.store');
Route::post('setting/user/create', config('cms.controller.user-store', 'UserManagementController@store'));
Route::get('setting/user/{id}', config('cms.controller.user-edit', 'UserManagementController@edit'))->name('admin.user.edit');
Route::post('setting/user/{id}', config('cms.controller.user-update', 'UserManagementController@update'))->name('admin.user.update');
Route::post('setting/user/delete/{id}', config('cms.controller.user-delete', 'UserManagementController@delete'))->name('admin.user.delete');

Route::get('log', config('cms.controller.log', 'LogController@index'))->name('admin.log.index');
Route::get('log/export', config('cms.controller.log-export', 'LogController@export'))->name('admin.log.export');
Route::post('setting/log/delete/{id}', config('cms.controller.log-delete', 'LogController@delete'))->name('admin.log.delete');

<?php
Route::get('install', 'InstallController@index');
Route::post('install', 'InstallController@process');
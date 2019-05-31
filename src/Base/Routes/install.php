<?php
Route::get('install', 'BaseController@index');
Route::post('install', 'BaseController@process');
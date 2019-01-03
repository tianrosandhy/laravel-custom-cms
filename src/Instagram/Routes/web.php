<?php
Route::post('instagram/switch', 'InstagramController@switch')->name('admin.instagram.switch');
Route::get('instagram', 'InstagramController@index')->name('admin.instagram.index');
Route::get('instagram/grab', 'InstagramController@grab')->name('admin.instagram.grab');
Route::post('instagram/grab', 'InstagramController@grabProcess')->name('admin.instagram.process');
Route::post('instagram/grab/loadmore', 'InstagramController@loadNextGrab')->name('admin.instagram.loadmore');

Route::get('instagram/import/{id}', 'InstagramController@import')->name('admin.instagram.import');
Route::get('instagram/remove/{id}', 'InstagramController@removeImport')->name('admin.instagram.remove');

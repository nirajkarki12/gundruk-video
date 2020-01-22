<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin/videos')->middleware('admin')->group(function() {
    Route::get('/', 'VideoController@index')->name('admin.videos');

    Route::get('/delete/{slug}','VideoController@destroy')->name('admin.video.delete');
    Route::get('/delete/parmanent/{slug}','VideoController@parmanentDestroy')->name('admin.video.delete.parmanent');
    Route::get('/show/deleted', 'VideoController@deleted')->name('admin.video.deleted');
    Route::get('/undelete/{slug}','VideoController@unDelete')->name('admin.video.undelete');

    Route::get('/create','VideoController@create')->name('admin.video.create');
    Route::post('/create','VideoController@store')->name('admin.video.store');
    Route::get('/show/{slug}','VideoController@show')->name('admin.video.show');


    Route::get('/stream/{slug}','VideoController@stream')->name('admin.video.stream');
    Route::get('/list','VideoController@list');

});

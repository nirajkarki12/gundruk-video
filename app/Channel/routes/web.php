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

Route::prefix('admin/channel')->middleware('admin')->group(function() {
    Route::get('/', 'ChannelController@index')->name('admin.channels');
    Route::get('/create', 'ChannelController@create')->name('admin.channel.create');
    Route::post('/store', 'ChannelController@store')->name('admin.channel.store');
});

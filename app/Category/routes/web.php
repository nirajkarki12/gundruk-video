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

Route::prefix('admin/category')->middleware('admin')->group(function() {
  Route::get('/', 'CategoryController@index')->name('admin.category');
	Route::get('add', 'CategoryController@create')->name('admin.category.add');
	Route::get('edit/{slug}', 'CategoryController@store')->name('admin.category.edit');
	Route::get('delete/{slug}', 'CategoryController@destroy')->name('admin.category.delete');
	Route::get('view/{slug}', 'CategoryController@show')->name('admin.category.view');
});
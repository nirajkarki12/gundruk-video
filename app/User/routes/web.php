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

// Route::prefix('user')->group(function() {
//     Route::get('/', 'UserController@index');
// });

Route::group(['prefix' => 'admin'], function(){
  Route::get('login', 'Auth\AdminAuthController@showLoginForm')->name('admin.login');
  Route::post('login', 'Auth\AdminAuthController@login')->name('admin.login.post');

	Route::middleware('admin')->group(function() {
	  Route::get('profile', 'AdminController@profile')->name('admin.profile');
		Route::post('/profile/save', 'AdminController@profileSave')->name('admin.profile.save');
		Route::post('/change/password', 'AdminController@changePassword')->name('admin.change.password');
	  Route::get('logout', 'Auth\AdminAuthController@logout')->name('admin.logout');
	});

});
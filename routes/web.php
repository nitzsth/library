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

Auth::routes(['register' => false, 'verify' => true]);

Route::middleware(['auth', 'verified'])->group(function() {
	Route::view('/', 'dashboard')->name('dashboard');

	Route::post('users/{user}/upload', 'UserController@upload')->name('users.upload');
	Route::resource('users', 'UserController');
});

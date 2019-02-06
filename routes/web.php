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
	Route::post('authors/{author}/upload', 'AuthorController@upload')->name('authors.upload');
	Route::resource('authors', 'AuthorController');

	Route::resource('categories', 'CategoryController');

	Route::view('/', 'dashboard')->name('dashboard');

	Route::post('users/{user}/upload', 'UserController@upload')->name('users.upload');
	Route::resource('users', 'UserController');
});

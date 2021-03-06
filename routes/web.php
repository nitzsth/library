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

Auth::routes([ 'register' => false, 'verify' => true ]);

Route::middleware([ 'auth', 'verified' ])->group(function ()
{
    Route::post('authors/{author}/upload', 'AuthorController@upload')
        ->name('authors.upload');
    Route::resource('authors', 'AuthorController');

    Route::post('books/{book}/book-copy', 'BookController@addCopy')
        ->name('books.copy.store');
    Route::post('books/{book}/upload', 'BookController@upload')
        ->name('books.upload');
    Route::resource('books', 'BookController');

    Route::resource('book-copies', 'BookCopyController')->only([
        'show',
        'update',
    ]);

    Route::resource('categories', 'CategoryController');

    Route::get('/', 'DashboardController@show')->name('dashboard');

    Route::post('users/{user}/book-copies/{book_copy}/return', 'UserController@bookCopyReturn')
        ->name('users.books.copy.return');
    Route::post('users/{user}/upload', 'UserController@upload')
        ->name('users.upload');
    Route::post('users/{user}/borrow', 'UserController@borrow')
        ->name('users.borrow');
    Route::resource('users', 'UserController');
});

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

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/test', function () {
    return view('test');
});

Route::get('/projects/create', 'ProjectsController@create');
Route::get('/projects', 'ProjectsController@index');
Route::post('/projects', 'ProjectsController@store');

Route::get('/books/create', 'BooksController@create');
Route::get('/books', 'BooksController@index');
Route::get('/books/notfound', 'BooksController@notfound');
Route::post('/books', 'BooksController@store');
Route::get('/books/{book}', "BooksController@show");
Route::post('/books/{book}/archived', 'BooksController@archive');

Route::post('/books/{book}/refs', 'BookRefsController@store');
Route::post('/books/{book}/refs/zip', 'BookRefsController@zip');
//Route::patch('/books/{book}/refs/{ref}', 'BookRefsController@update');
Route::get('books/refs', 'BookRefsController@show');
Route::patch('/refs/{ref}', 'BookRefsController@update');


Route::get('/groups', 'GroupsController@index');
Route::post('/groups', 'GroupsController@store');
Route::patch('/groups/{group}', 'UsersController@update');


Route::get('/home', 'HomeController@index')->name('home');
Route::patch('/notification/{notification}', 'NotificationController@read');
Route::delete('/notification/{notification}', 'NotificationController@delete');

Route::post('/watchlist', 'WatchlistController@store');
Route::patch('/watchlist/{watchlist}', 'WatchlistController@update');


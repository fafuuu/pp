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
Route::patch('/refs/{ref}/edit', 'BookRefsController@edit');

Route::get('/groups', 'GroupsController@index');
Route::get('/group/search', 'GroupsController@search');
Route::get('/groups/{group}', 'GroupsController@show');
Route::post('/groups', 'GroupsController@store');
Route::patch('/groups/{group}', 'UsersController@update');

Route::get('/profile/{username}', 'UsersController@profile');
Route::patch('/profile/{username}', 'UsersController@update_avatar');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/settings', 'UsersController@settings');
Route::patch('/notifications/{notification}', 'NotificationController@read');
Route::patch('/notifications', 'NotificationController@all_read');
Route::delete('/notifications', 'NotificationController@delete_all');
Route::delete('/notifications/{notification}', 'NotificationController@delete');

Route::post('/watchlist', 'WatchlistController@store');
Route::patch('/watchlist/{watchlist}', 'WatchlistController@update');

Route::get('/home/notifications', 'HomeController@notifications');
Route::get('/home/settings', 'HomeController@settings');
Route::get('/home/statistics', 'HomeController@statistics');
Route::get('/home/watchlist', 'HomeController@watchlist');
Route::get('/home/collections', 'HomeController@collections');
Route::delete('/watchlist/{entry}', 'WatchlistController@delete_entry');

//Messages
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
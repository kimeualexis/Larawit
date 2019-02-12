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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'QuestionsController@index')->name('questions-index');
Route::post('/user-profile', 'UsersController@index')->name('user-profile');
Route::post('/view-question', 'QuestionsController@show')->name('view-question');
Route::post('/add-comment', 'CommentsController@index')->name('add-comment');
Route::post('/send-message', 'MessagesController@index')->name('send-message');
Route::get('/view-messages', 'MessagesController@show')->name('view-message');
Route::post('/ask-question', 'QuestionsController@create')->name('ask-question');
Route::post('/profile-update', 'UsersController@update')->name('profile-update');
Route::get('user-profile/{id}', 'UsersController@show')->name('user-profile');
Route::get('read-message/{id}', 'MessagesController@read')->name('read-message');
Route::post('/update-question', 'QuestionsController@update')->name('update-question');
Route::post('delete-question/{id}', 'QuestionsController@destroy')->name('delete-question');
Route::get('/admin', 'AdminsController@index')->name('admin');
/*

Route::resource('questions', QuestionsController);
Route::resource('comments', CommentsController);
Route::resource('roles', RolesController);
Route::resource('users', UsersController);
*/

//Route::resource('questions', 'QuestionsController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

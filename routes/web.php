<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	return redirect()->route('login');
    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/pusher/auth', [
	'uses' => 'HomeController@pusherAuth',
	'as' => 'pusher.auth'
	]);

Route::post('/search', [
	'uses' => 'HomeController@search',
	'as' => 'search'
	]);

Route::get('/add-contact/user/{id}', [
	'uses' => 'UserController@addContact',
	'as' => 'contact.add',
	'middleware' => 'auth'
	]);

Route::get('/conversation/{id}', [
	'uses' => 'HomeController@openConversation',
	'as' => 'conversation.open',
	'middleware' => 'auth'
	]);

Route::get('message/new/{id}', [
	'uses' => 'UserController@newMessage',
	'as' => 'message.new',
	'middleware' => 'auth'
	]);

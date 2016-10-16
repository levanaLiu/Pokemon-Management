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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/profile/{id}','ProfilesController@index');
Route::post('/profile/{id}','ProfilesController@edit');
Route::get('/admin','PokemonController@index');
Route::post('/admin','PokemonController@edit');
Route::post('/home','HomeController@search');
Route::get('/search/{name}','PokemonController@search');

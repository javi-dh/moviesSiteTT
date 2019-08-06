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

Route::get('/', function ($value='') {
	return redirect('/movies');
});

Route::get('/movies', 'MoviesController@index');
Route::get('/movies/create', 'MoviesController@create')->middleware('auth');
Route::post('/movies/store', 'MoviesController@store');
Route::get('/movies/{id}', 'MoviesController@show');
Route::delete('/movies/{id}', 'MoviesController@destroy');
Route::get('/movies/edit/{id}', 'MoviesController@edit');
Route::put('/movies/{id}', 'MoviesController@update');

Route::get('/genres', 'GenresController@mostrarTodos');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('movies',['uses'=>'MoviesController@listMovies']);
Route::get('genres',['uses'=>'GenresController@listGenres']);
Route::get('movies/create', 'MoviesController@addMovie')->name('movies.create');
Route::post('movies/create', 'MoviesController@saveMovie');
Route::get('movies/{movie}',['uses'=>'MoviesController@getMovie', 'as' => 'movies.show']);
Route::get('movies/{movie}/edit',['uses'=>'MoviesController@editMovie', 'as' => 'movies.edit']);
Route::post('movies/{movie}/edit',['uses'=>'MoviesController@updateMovie']);
Route::delete('movies/{movie}', ['uses' => 'MoviesController@deleteMovie'])->name('movies.delete');
Route::post('movies/{movie}', ['uses' => 'MoviesController@markMovie'])->name('movies.mark');
/*
Route::group(['prefix' => 'admin'], function() {
    Route::get('login', ['uses' => 'Auth\LoginController@showLoginForm', 'as' => 'admin.login']);
    Route::post('login', ['uses' => 'Auth\LoginController@login']);
});
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

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

use App\Http\Controllers\MovieController;

Route::get('/', 'MovieController@index');
Route::get('movie-weapons', 'MovieController@getMovieFirearms');
Route::post('save-to-favorites', 'MovieController@saveWeaponToFavorites');
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

Route::get('/', 'ScrapperController@index');

Route::get('imfdb', 'MovieController@index');
Route::get('imfdb/weapons', 'MovieController@getMovieFirearms');
Route::post('imfdb/save-to-favorites', 'MovieController@saveWeaponToFavorites');

Route::get('mercadolibre', 'ProductosMercadolibreController@index');
Route::post('mercadolibre/get-product-data', 'ProductosMercadolibreController@getProductData');
Route::get('mercadolibre/download-image', 'ProductosMercadolibreController@downloadProductImage');

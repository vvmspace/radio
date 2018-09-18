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

Route::get('/', 'StationController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/countries', 'CountryController@index')->name('countries');
Route::get('/genres', 'GenreController@index')->name('genres');

Route::get('/like-{slug}', 'GenreController@show')->where('slug', '(.*)');
Route::get('/from-{slug}', 'CountryController@show')->where('slug', '(.*)');
Route::get('/{slug}-online', 'StationController@show')->where('slug', '(.*)');
Route::get('/m3u/{slug}_Radio.VVM.SPACE.m3u', 'StationController@m3u')->where('slug', '(.*)');

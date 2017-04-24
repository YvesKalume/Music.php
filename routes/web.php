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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/admin', 'HomeController@admin');
Route::get('/client/{url?}/{url2?}', 'ClientController')->name('client');
Route::get('/home', 'HomeController@index');
Route::get('/tracks/audio/{track}', 'TrackController@audio');
Route::get('/tracks/queue', 'TrackController@queue')->name('tracks.queue');

Route::resource('artists', 'ArtistController');
Route::resource('tracks', 'TrackController');

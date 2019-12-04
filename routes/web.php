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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/videos', 'VideoController@index')->name('video.index');
Route::get('/videos/create', 'VideoController@create')->name('video.create');
Route::post('/videos/store', 'VideoController@store')->name('video.store');
Route::get('/videos/edit/{entry_id}', 'VideoController@edit')->name('video.edit');
Route::delete('/videos/delete/{entry_id}', 'VideoController@delete')->name('video.delete');
Route::get('/videos/preview/{entry_id}', 'VideoController@preview')->name('video.preview');

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

Route::get('/timers','TimersController@index')->name('timers.index');
Route::post('/timers/show','TimersController@unregistered')->name('timers.unregistered');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/mypage','TimersController@mypage')->name('timers.mypage');
    Route::get('/show/{id}','TimersController@show')->name('timers.show');
    Route::get('/timers/{id}/edit','TimersController@edit')->name('timers.edit');
    Route::post('/timers/create','TimersController@create')->name('timers.create');
    Route::post('/timers/{id}','TimersController@update')->name('timers.update');
    Route::post('/timers/{id}/delete','TimersController@destroy')->name('timers.delete');
    Route::post('/mypage','TimersController@clear')->name('timers.reset');

});

Route::get('/home', 'HomeController@index')->name('home');

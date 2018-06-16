<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/daily', 'DailyController')->middleware('auth');
Route::resource('/scores', 'ScoreController')->middleware('auth');
Route::get('/users/search', 'UserController@search')->middleware('auth');
Route::post('/users/add', 'UserController@add')->middleware('auth');
Route::resource('/users', 'UserController')->middleware('auth');
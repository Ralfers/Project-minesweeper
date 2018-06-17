<?php


Route::get('/', 'HomeController@index');

Auth::routes();

Route::resource('/scores', 'ScoreController')->middleware('auth');
Route::post('/users/change-avatar', 'UserController@changeAvatar')->middleware('auth');
Route::post('/users/change-home', 'UserController@changeHome')->middleware('auth');
Route::get('/users/search', 'UserController@search')->middleware('auth');
Route::post('/users/add', 'UserController@add')->middleware('auth');
Route::resource('/users', 'UserController')->middleware('auth');

Route::get('/seed', 'GameController@seededGame');
Route::get('/game', 'GameController@randomGame');
Route::get('/daily', 'GameController@dailyGame')->middleware('auth');
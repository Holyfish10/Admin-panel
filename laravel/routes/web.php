<?php

use Illuminate\Support\Facades\Route;

//Register false
Auth::routes(['register' => false]);

//HomeController url's
Route::get('/','HomeController@home')->name('home');

//Calendar
Route::post('/create','CalendarController@create');
Route::post('/update','CalendarController@update');
Route::post('/delete','CalendarController@destroy');

//PostsController
Route::resource('posts', 'PostsController');


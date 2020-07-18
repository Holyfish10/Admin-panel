<?php

use Illuminate\Support\Facades\Route;

//Register false
Auth::routes(['register' => false]);

//HomeController url's
Route::get('/','HomeController@home')->name('home');
//PostsController
Route::resource('posts', 'PostsController');
//Calendar
Route::post('/create','CalendarController@create');
Route::post('/update','CalendarController@update');
Route::post('/delete','CalendarController@destroy');



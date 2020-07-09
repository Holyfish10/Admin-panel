<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');
Route::get('/form-basic', 'HomeController@formBasic')->name('form-basic');

//Disable register
Auth::routes(['register' => false]);

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

//Disable register
Auth::routes(['register' => false]);

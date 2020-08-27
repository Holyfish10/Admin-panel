<?php

use Illuminate\Support\Facades\Route;

//Register false
Auth::routes(['register' => false]);

//HomeController url's
Route::get('/','HomeController@home')->name('home');
Route::get('/timer', 'HomeController@projects')->name('timer');
//PostsController
Route::resource('posts', 'PostsController')->middleware('admin');
//TodoController
Route::resource('todo', 'TodoController');
Route::post('todo/{id}/edit', 'TodoController@update');
//SitesController
Route::resource('sites', 'SiteController');
//InvoiceController
Route::resource('invoices', 'InvoiceController');
Route::delete('bulkDestroy', ['as'=>'invoices.multiple-delete','uses'=>'InvoiceController@bulkDestroy']);
Route::get('/downloadPDF/{id}','InvoiceController@downloadPDF');
//ClientController
Route::resource('clients', 'ClientController');
Route::delete('bulkDestroyClients', ['as'=>'clients.multiple-delete','uses'=>'ClientController@bulkDestroy']);
//ProjectsController url's
Route::get('/projects', 'ProjectsController@index');
Route::post('/projects', 'ProjectsController@store');
Route::post('/projects/{id}/timers/stop', 'TimerController@stopRunning');
Route::post('/projects/{id}/timers/update', 'TimerController@update');
Route::post('/projects/{id}/timers', 'TimerController@store');
Route::get('/projects/timers/active', 'TimerController@running');
//Calendar
Route::post('/create','CalendarController@create');
Route::post('/update','CalendarController@update');
Route::post('/delete','CalendarController@destroy');
//Tickets
Route::get('/tickets', 'TicketsController@index');
Route::get('/tickets/create', 'TicketsController@create')->name('tickets.create');
Route::post('/tickets/create', 'TicketsController@store')->name('tickets.store');
Route::get('/tickets/{ticket_id}', 'TicketsController@show')->name('tickets.show');
Route::delete('/tickets/{id}', 'TicketsController@destroy');
Route::post('/tickets/{ticket_id}/close', 'TicketsController@closeTicket')->name('ticket.close');



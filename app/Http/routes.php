<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

/**
 * Task Route
 */
Route::delete('/tasks/{tasks}','TasksController@destroy');
Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store');
Route::get('/tasks/create','TasksController@create');

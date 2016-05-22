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

Route::get('/', 'TasksController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

#Task
Route::delete('/tasks/{tasks}','TasksController@destroy');
Route::get('/tasks/{tasks}','TasksController@show');
Route::get('/tasks','TasksController@index');
Route::get('/usertasks','TasksController@userTasks');
Route::post('/tasks','TasksController@store');
Route::get('/tasks/take/{tasks}','TasksController@take');
Route::get('/tasks/confirm/{tasks}','TasksController@confirm');
Route::get('/tasks/remove/{tasks}','TasksController@remove');
Route::get('/tasks/create','TasksController@create');

#Point
Route::get('/points/user','PointsController@index');

#Garden
Route::get('/gardens/get','GardensController@get');

#Profile
Route::get('/profile/{user}','ProfilesController@index');
Route::patch('/profile/{profile}','ProfilesController@update');
Route::get('/profile/edit/{user}','ProfilesController@edit');
Route::get('profile/invitecode/{profile}','ProfilesController@inviteCode');

#Comments
Route::post('/comments/{tasks}','CommentsController@store');

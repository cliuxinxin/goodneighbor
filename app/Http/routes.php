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
Route::get('/receivetasks','TasksController@receiveTasks');
Route::get('/gardentasks','TasksController@gardenTasks');
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

#Timelines
Route::get('timelines/generate','TimelinesController@generate');
Route::get('timelines/{user}','TimelinesController@show');

#Admin
Route::get('admin','AdminController@index');
Route::get('admin/gardens','AdminController@gardens');
Route::get('admin/gardens/create','AdminController@gardensCreate');
Route::post('admin/gardens/create','AdminController@gardensStore');
Route::delete('admin/gardens/delete/{gardens}','AdminController@gardensDelete');

#Topic
Route::get('topics/get','TopicsController@get');
Route::get('topics/index','TopicsController@index');
Route::get('topics/xunbo','TopicsController@xunbo');
Route::get('topics/test','TopicsController@test');
Route::get('topics/seen/{topics}','TopicsController@seen');
Route::get('topics/unseen/{topics}','TopicsController@unseen');

#Location
Route::get('locations/get','LocationsController@get');
Route::post('locations/save','LocationsController@save');

#Bible
Route::get('bibles/get','BiblesController@get');

#New Concept English
Route::get('nce/get','NcesController@get');


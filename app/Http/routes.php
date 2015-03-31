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

Route::get('/', 'TimelineController@index');
Route::get('timeline/{month}', 'TimelineController@index');
Route::get('pages/track/{topic_id}/{chapter_id}', 'TimelineController@track');
Route::get('timeline/view_topic/{topic_id}', 'TimelineController@timeline_topic_details');
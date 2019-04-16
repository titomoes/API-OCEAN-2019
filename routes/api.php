<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'Auth\RegisterController@postRegister');
Route::post('login', 'Auth\LoginController@login');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    //CRUD Events
    Route::apiResource('events', 'EventController');
    //Search for name Events
    Route::get('event/{name}', 'EventController@search_name')->name('events.name');
    //Search for day Events
    Route::get('events/day/{day}', 'EventController@search_day')->name('events.day');
    //Search for mouth Events
    Route::get('events/month/{month}', 'EventController@search_month')->name('events.month');
    //Search for year Events
    Route::get('events/year/{year}', 'EventController@search_year')->name('events.year');
    //CRUD Users
    Route::apiResource('users', 'UserController');
    //Search for name Users
    Route::get('user/{name}', 'UserController@search_name')->name('users.name');
    //Subscribe User on Event
    Route::post('event/{event_id}/user/{user_id}', 'SubscriptionController@store')->name('subscriptions.store');
    //Check-in
    Route::get('event/{id}/lat/{lat}/lng/{lng}', 'EventController@check')->name('events.check');

});


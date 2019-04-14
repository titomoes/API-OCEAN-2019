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
Route::post('logout', 'Auth\LoginController@logout');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:api'], function () {
    //CRUD Eventos
    Route::apiResource('events', 'EventController');
//    Route::get('events', 'EventController@index');
//    Route::get('events', 'EventController@index');
//    Route::post('event', 'EventController@store');
//    Route::get('events/{id}', 'EventController@show');
//    Route::put('events/{id}', 'EventController@update');
//    Route::delete('events/{id}', 'EventController@destroy');
});


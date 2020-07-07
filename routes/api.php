<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function(){
    dd('test');
});

Route::post('AddPerson', 'PersonController@store');

Route::get('GetPerson/{person_id?}', 'PersonController@show');

Route::get('GetPersonsBetweenDates/{date1?}/{date2?}', 'PersonController@betWeenDates');

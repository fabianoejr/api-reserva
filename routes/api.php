<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

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

Route::get('Novidades', 'App\Http\Controllers\ApiController@getAllNews');
Route::get('Novidades/{id}', 'App\Http\Controllers\ApiController@getUser');
Route::get('Usuario/{id}', 'App\Http\Controllers\ApiController@getUser');
Route::put('Usuario/{id}', 'App\Http\Controllers\ApiController@UpdateUser');
Route::get('Usuario', 'App\Http\Controllers\ApiController@getAllUsers');
Route::post('Novidades', 'App\Http\Controllers\ApiController@createNews');
Route::put('Novidades/{id}', 'App\Http\Controllers\ApiController@updateNews');
Route::delete('Novidades/{id}', 'App\Http\Controllers\ApiController@deleteNews');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('verifyEmail', 'App\Http\Controllers\AuthController@verifyEmail');
    Route::post('recoveryPasswordEmail', 'App\Http\Controllers\AuthController@recoveryPasswordEmail');
    Route::post('recoveryPassword', 'App\Http\Controllers\AuthController@recoveryPassword');
    Route::post('getUserTerms', 'App\Http\Controllers\AuthController@getUserTerms');
});

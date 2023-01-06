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

/*
|--------------------------------------------------------------------------
| Usuários
|--------------------------------------------------------------------------
|
*/

Route::get('Usuario/{id}', 'App\Http\Controllers\ApiController@getUser');
Route::put('Usuario/{id}', 'App\Http\Controllers\ApiController@updateUser');
Route::get('Usuario', 'App\Http\Controllers\ApiController@getAllUsers');
Route::delete('Usuario/{id}', 'App\Http\Controllers\ApiController@deleteUser');

/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
|
*/

Route::post('Cliente', 'App\Http\Controllers\ApiController@createClient');
Route::get('Cliente/{id}', 'App\Http\Controllers\ApiController@getClient');
Route::put('Cliente/{id}', 'App\Http\Controllers\ApiController@updateClient');
Route::get('Cliente', 'App\Http\Controllers\ApiController@getAllClients');
Route::delete('Cliente/{id}', 'App\Http\Controllers\ApiController@deleteClient');

/*
|--------------------------------------------------------------------------
| Relacionamento Usuários com Clientes (Relationship)
|--------------------------------------------------------------------------
|
*/

Route::post('Relacionamento', 'App\Http\Controllers\ApiController@createRelationship');
Route::get('Relacionamento/{id}', 'App\Http\Controllers\ApiController@getRelationship');
Route::get('RelacionamentoUsuario/{user}', 'App\Http\Controllers\ApiController@getRelationshipUser');
Route::get('Relacionamento', 'App\Http\Controllers\ApiController@getAllRelationship');
Route::put('Relacionamento/{id}', 'App\Http\Controllers\ApiController@updateRelationship');
Route::delete('Relacionamento/{id}', 'App\Http\Controllers\ApiController@deleteRelationship');

/*
|--------------------------------------------------------------------------
| Conveniadas
|--------------------------------------------------------------------------
|
*/

Route::post('Conveniada', 'App\Http\Controllers\ApiController@createAffiliated');
Route::get('Conveniada/{id}', 'App\Http\Controllers\ApiController@getAffiliated');
Route::get('Conveniada', 'App\Http\Controllers\ApiController@getAllAffiliated');
Route::put('Conveniada/{id}', 'App\Http\Controllers\ApiController@updateAffiliated');
Route::delete('Conveniada/{id}', 'App\Http\Controllers\ApiController@deleteAffiliated');

/*
|--------------------------------------------------------------------------
| Ambientes
|--------------------------------------------------------------------------
|
*/

Route::post('Ambiente', 'App\Http\Controllers\ApiController@createEnvironment');
Route::get('Ambiente/{id}', 'App\Http\Controllers\ApiController@getEnvironment');
Route::get('AmbienteCliente/{client}', 'App\Http\Controllers\ApiController@getEnvironmentClient');
Route::get('Ambiente', 'App\Http\Controllers\ApiController@getAllEnvironments');
Route::put('Ambiente/{id}', 'App\Http\Controllers\ApiController@updateEnvironment');
Route::delete('Ambiente/{id}', 'App\Http\Controllers\ApiController@deleteEnvironment');

/*
|--------------------------------------------------------------------------
| Usuários do Cliente
|--------------------------------------------------------------------------
|
*/

Route::post('Ligacao', 'App\Http\Controllers\ApiController@createLinkUser');
Route::get('Ligacao/{id}', 'App\Http\Controllers\ApiController@getLinkUser');
Route::get('LigacaoCliente/{client}', 'App\Http\Controllers\ApiController@getLinkUserClient');
Route::get('Ligacao', 'App\Http\Controllers\ApiController@getAllLinkUser');
Route::put('Ligacao/{id}', 'App\Http\Controllers\ApiController@updateLinkUser');
Route::delete('Ligacao/{id}', 'App\Http\Controllers\ApiController@deleteLinkUser');

/*
|--------------------------------------------------------------------------
| Reservas
|--------------------------------------------------------------------------
|
*/

Route::post('Reserva', 'App\Http\Controllers\ApiController@createReservation');
Route::get('Reserva/{id}', 'App\Http\Controllers\ApiController@getReservation');
Route::get('ReservaCliente/{client}', 'App\Http\Controllers\ApiController@getClientReservation');
Route::get('ReservaUsuario/{user}', 'App\Http\Controllers\ApiController@getUserReservation');
Route::get('ReservaAmbiente/{idenvironment}', 'App\Http\Controllers\ApiController@getEnvironmentReservation');
Route::get('Reserva', 'App\Http\Controllers\ApiController@getAllReservations');
Route::put('Reserva/{id}', 'App\Http\Controllers\ApiController@updateReservation');
Route::delete('Reserva/{id}', 'App\Http\Controllers\ApiController@deleteReservation');

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
    Route::get('getUserTerms', 'App\Http\Controllers\AuthController@getUserTerms');
});

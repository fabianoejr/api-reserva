<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sendmail', 'App\Http\Controllers\MailController@sendMail');
Route::get('/validateEmail/{hash}', 'App\Http\Controllers\AuthController@verifyEmail');
Route::get('/recoveryPassword/{hash}', function (){
    return view('RecoveryPassword');
});
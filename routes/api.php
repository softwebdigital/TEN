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

Route::group(['middleware'=>['auth:sanctum']], function(){
	Route::get('details', 'UserController@profile');
	Route::apiResource('beneficiaries', 'BeneficiaryController');
	Route::apiResource('groups', 'GroupController');
	Route::apiResource('payments', 'PaymentController')->only('index');
	Route::apiResource('thrifts', 'ThriftController')->only(['index', 'store']);
	Route::apiResource('tokens', 'VerificationTokenController');
	Route::put('token/verify', 'VerificationTokenController@verifyApi');
	Route::post('/update', 'UserController@update');
	Route::get('/getbanks', 'Utility@getBanks');
	Route::get('/getCountries', 'Utility@getCountries');
});

Route::group(['prefix'=>'auth'], function(){
	Route::post('login', 'UserController@login');
	Route::post('register', 'Auth\RegisterController@createApi');
});

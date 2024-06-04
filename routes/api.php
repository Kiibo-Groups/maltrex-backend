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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//  return $request->user();

Route::group(array('namespace' => 'App\Http\Controllers\Api'), function () {

    /**
     * Bienvenida y datos iniciales
     */
    Route::get('welcome','ApiController@welcome');
    Route::get('getDataInit','ApiController@getDataInit');

    /**
     * Datos iniciales para usuarios registrados
     */ 
    Route::get('homepage_init/{city}','ApiController@homepage_init');

    /**
     * Funciones de registro
     */
    Route::post('signup','ApiController@signup');
    Route::post('signupOP','ApiController@signupOP');
    Route::post('sendOTP','ApiController@sendOTP');
    Route::post('SignPhone','ApiController@SignPhone');

     /**
     * Funciones de inicio de sesion y validacion de usuario
     */
    Route::post('login','ApiController@login');
    Route::post('chkUser','ApiController@chkUser');
    Route::post('Newlogin','ApiController@Newlogin');
    Route::get('userinfo/{id}','ApiController@userinfo');
    Route::post('updateInfo/{id}','ApiController@updateInfo');

    Route::post('getToken','ApiController@getToken'); 
    Route::get('getDevice','ApiController@getDevice');
   

    /**
     * Funciones para vista y obtencion de Asignaciones / Levantamientos
     */
    Route::get('getAssignments/{user_id}','ApiController@getAssignments');
    Route::get('getEvidences/{user_id}','ApiController@getEvidences');
    Route::post('CreateEvidence','ApiController@CreateEvidence');

    
});

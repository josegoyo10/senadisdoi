<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


/**
 * Mensajeria
 */


Route::get('mensajes','MensajeriaController@index');
Route::get('/mensajes/{id}/responder','MensajeriaController@responder');
Route::put('/mensajes/guardar-respuesta/{id}','MensajeriaController@guardarRespuesta');
Route::resource('mensajes','MensajeriaController');

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


/* Admin */
//Route::get('/', 'AdminController@index');

/* Roles */
// Se deshabilita porque debe conocerse bien la administeación
// Si en algun momento desean habilitarlo para algun administrador
// pueden habilitar las rutas y las opciones en el menú. 
//	- Por: jose.escalante - 01/03/2017 / Kibernum.
/*
Route::resource('roles', 'RoleController');
Route::get('roles/destroy/{id}', 'RoleController@destroy');
Route::post('roles/{id}/update', 'RoleController@update');
Route::post('roles/store', 'RoleController@store');
*/

/* Users */
Route::resource('users', 'UserController');
Route::get('users/destroy/{id}', 'UserController@destroy');
Route::post('users/{id}/update', 'UserController@update');

/* Users */
Route::post('usuarios/{id}/update', 'UsuariosController@update');
Route::resource('usuarios', 'UsuariosController');

/* Envío Mail*/

Route::get('resetpassword/{id}/{token}','UsuariosController@sendMailPassword');



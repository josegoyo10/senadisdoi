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

/*
 * Mantenedores
 */

Route::get('usuarios','UserController@mantenedorUsuarios');

// Mantenedor Instituciones
Route::get('/instituciones', function () {
    return view('instituciones.index');
});

// Mantenedor Periodos
Route::get('/periodos', function () {
    return view('periodos.index');
});



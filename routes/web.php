<?php

// Home
Route::ANY('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// NOTA: Definir las rutas dentro de group - j.escalante - 26/12/2016.
Route::group(['middleware' => 'auth'], function () {
    // Encuesta
    Route::resource('encuesta','EncuestaController');
    Route::get('reactivar_encuesta/{id}','EncuestaController@reactivar');
    Route::get('resumen_encuesta','EncuestaController@verResumenEncuesta');
    Route::post('enviar_encuesta/','EncuestaController@enviar');


    //Rechazo Encuesta
    Route::post('/enviar/rechazo_encuesta','EncuestaController@rechazoEncuesta');
    
    //Aprobar Encuesta  
    Route::post('/enviar/aprobacion_encuesta','EncuestaController@aprobarEncuesta');

    // Envío de mail
    Route::get('mail','EncuestaController@sendMail');

    // Convenios
    Route::resource('convenios','ConveniosController');

    // Admin encuestas
    Route::resource('formulario-encuesta','FormularioEncuestaController');

    // Dimensiones
    Route::resource('dimension','DimensionController');
    Route::delete('dimension/{id_dimension}/{id_encuesta}', 'DimensionController@destroy');
    Route::get('dimension/create/{id_encuesta}', 'DimensionController@create');

    //Factores
     Route::resource('factores-encuesta','FactorController');
     Route::get('factor/create/{id_dimension}/{id_encuesta}', 'FactorController@create');
     Route::get('factores-encuesta/edit/{id_factor}/{id_encuesta}', 'FactorController@edit');
     Route::POST('factores-encuesta/actualizar/{id_factor}/{id_encuesta}', 'FactorController@actualizar');
     Route::delete('factores-encuesta/{id_factor}/{id_encuesta}', 'FactorController@destroy');
     Route::get('factores-encuesta/show/{id_dimension}/{id_encuesta}', 'FactorController@show');
     Route::POST('factores-pregunta/save/{id_factor}/{id_encuesta}', 'FactorController@savePregunta');
     

     //Preguntas
      Route::resource('pregunta-encuesta','PreguntasController');
      Route::delete('pregunta-encuesta/{id_pregunta}/{id_factor}/{id_encuesta}', 'PreguntasController@destroy');
      Route::get('pregunta-encuesta/edit/{id_pregunta}/{id_factor}/{id_encuesta}/{contador_preg}', 'PreguntasController@edit');
      Route::POST('pregunta-encuesta/actualizar/{id_pregunta}/{id_factor}/{id_encuesta}', 'PreguntasController@actualizar');




      // Correos
    Route::get('enviar', ['as' => 'enviar', function () {
        $data = ['kibernum' => 'kibernum.com'];
        \Mail::send('mails.email', $data, function ($message) {
            $message->from('prueba@kibernum.com', 'Kibernum.com');
            $message->to('nmardones.fabre.21@gmail.com')->subject('Notificación');
        });
        return "Se envío el email";
    }]);
   //ficha Inscripcion
    Route::get('/institucion', 'FichaController@index');
    Route::post('institucion/crearInstitucion','FichaController@storeInstitucion');
 

   //Rutas para Reportes
    Route::get('reportes/municipios',  'ReporteController@municipiosPorcentaje');
    Route::ANY('reportes/porcentaje', 'ReporteController@municipiosPorcentaje');
    
    //
    Route::get('reportes/cumplimiento_dimension',  'ReporteController@PorcentajeDimension');
    Route::ANY('reportes/cumplimiento_dimension_btn',  'ReporteController@PorcentajeDimension');

    //menu 3
    Route::get('reportes/dimension_municipalidad',  'ReporteController@dimensionMunicipalidad');
    Route::get('reportes/dimension_municipalidad/ajax/{id}', 'ReporteController@dimensionMunicipalidadAjax');
    Route::ANY('reportes/dimension_municipalidad_btn', 'ReporteController@dimensionMunicipalidad');


    //
    Route::get('reportes/cumplimiento_factor','ReporteController@cumplimientoFactor');
    Route::ANY('reportes/cumplimiento_factor_btn','ReporteController@cumplimientoFactor');


   //
    Route::get('reportes/factor_municipalidad/','ReporteController@factorMunicipalidad');
    Route::get('reportes/factor_municipalidad/ajax/{id}', 'ReporteController@factorMunicipalidadAjax');
    Route::ANY('reportes/factor_municipalidad_btn','ReporteController@factorMunicipalidad');

    
    //Rutas para Reportes con Highcharts

    //Menu 1
    Route::POST('reportes/reportes_ajax/porcentaje/', 'ReporteController@porcentajeMunicipioAjax');
    //Menu 2
    Route::POST('reportes/reportes_ajax/cumplimiento_dimension', 'ReporteController@porcentajeDimensionAjax');

    //Menu 3
     Route::POST('reportes/reportes_ajax/dimension_municipalidad', 'ReporteController@porcentajeDimensionmunicipalidadAjax');

    //Menu 4
     Route::POST('reportes/reportes_ajax/cumplimiento_factor', 'ReporteController@porcentajeFactorAjax');

    //Menu 5
      Route::POST('reportes/reportes_ajax/factor_municipalidad/', 'ReporteController@porcentajefactormunicipalidadAjax');

   //Glosariofactor_municipalidad
    Route::get('glosario','GlosarioController@index');


});



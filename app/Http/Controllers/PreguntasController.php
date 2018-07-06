<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Preguntas;
use App\Encuesta;
use App\Dimension;
use App\Factores;


class PreguntasController extends Controller
{
   
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

  
    public function show($id)
    {
        //
    }

 
    public function edit($id_pregunta,$id_factor,$id_encuesta,$cont_preg)
    {
        //

       $factor    = Factores::find($id_factor);
       $edit_pregunta = Preguntas::select('id', 'desc_pregunta', 'ponderador','factores_id','unidades_municipales_id','req_medio_verificacion')
                           ->where('id', '=', $id_pregunta)
                           ->get();

       $preguntas = Preguntas::select('id', 'desc_pregunta', 'ponderador','factores_id','unidades_municipales_id','req_medio_verificacion')
                           ->where('factores_id', '=', $id_factor)
                           ->get();
        $encuesta = Encuesta::find($id_encuesta);
        $dimension = Dimension::find($factor->dimensiones_id);
        $accion    = 'Editar';
       
        return view('factores.showFactores', ['factor'       =>$factor,
                                             'id_pregunta'  =>$id_pregunta,
                                             'id_factor'    =>$id_factor,
                                             'id_encuesta'  =>$id_encuesta,
                                             'edit_pregunta'=>$edit_pregunta,
                                             'preguntas'    =>$preguntas,
                                             'accion'       =>$accion,
                                             'nombre_encuesta' => $encuesta->nombre,
                                             'nombre_dimension' => $dimension->nombre,
                                             'cont_preg'    => $cont_preg
                                             ]);
    }


       public function actualizar(Request $request,$id_pregunta,$id_factor,$id_encuesta)
    {
        //
        $pregunta = Preguntas::find($id_pregunta);
        $pregunta->desc_pregunta = $request->desc_pregunta;
        $pregunta->ponderador    = $request->ponderador;
        $pregunta->req_medio_verificacion    = (($request->req_medio_verificacion == null) ? 0:$request->req_medio_verificacion);
        $pregunta->save();
        return redirect('/factores-encuesta/show/'.$id_factor.'/'.$id_encuesta)->with('success','Registro actualizado correctamente');
    }

 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id_pregunta,$id_factor,$id_encuesta)
    {
        //
        $count = 0;
        $encuesta = Encuesta::find($id_encuesta);
        $count += $encuesta->encuestaRespuesta->count();
        
        if($count > 0) {
             return redirect('/factores-encuesta/show/'.$id_factor.'/'.$id_encuesta)->with('errors_validacion','La Pregunta no puede ser eliminada. Posee respuestas asociadas');
        } else {
                Preguntas::destroy($id_pregunta);
                return redirect('/factores-encuesta/show/'.$id_factor.'/'.$id_encuesta)->with('success','La Pregunta fue eliminada');
        }

    
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Encuesta;
use App\Dimension;
use App\Factores;
use App\Preguntas;

class FactorController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id,$id_encuesta)
    {
        return view('factores.newFactores',['id_dimension' => $id,'id_encuesta' =>$id_encuesta]);
    }

    public function store(Request $request)
    {
        

        $factor = new Factores;
        $encuesta_ID = Input::get('encuentas_id');
        $factor->create($request->all());
        return redirect('/formulario-encuesta/'.$encuesta_ID.'')->with('success','Registro ingresado correctamente');
    }

    public function show($id,$id_encuesta)
    {
        $factor     = Factores::find($id);
        $preguntas = Preguntas::select('id', 'desc_pregunta', 'ponderador','factores_id','unidades_municipales_id','req_medio_verificacion')
                           ->where('factores_id', '=', $id)
                           ->get();
        $encuesta = Encuesta::find($id_encuesta);
        $dimension = Dimension::find($factor->dimensiones_id);
        $accion    = 'Nuevo';
        return view('factores.showFactores',['id_factor'    => $id,
                                             'id_encuesta'  => $id_encuesta,
                                             'factor'       => $factor,
                                             'preguntas'    => $preguntas,
                                             'accion'       => $accion,
                                             'nombre_encuesta' => $encuesta->nombre,
                                             'nombre_dimension' => $dimension->nombre
                                            ]);
    }

    public function edit($id,$id_encuesta)
    {
        
       $factor = Factores::find($id);
       return view('factores.editFactores', ['factor' => $factor,
                                             'id_encuesta'=>$id_encuesta]
                                             );
    }

    public function actualizar(Request $request,$id,$id_encuesta)
    {
        $factor = Factores::find($id);
        $factor->nombre = $request->nombre;
        $factor->save();
        return redirect('/formulario-encuesta/'.$id_encuesta.'')->with('success','Registro actualizado correctamente');
    }

    public function destroy($id,$id_encuesta)
    {
     
       //dd($id);
        $count = 0;
        $encuesta = Encuesta::find($id_encuesta);
        $count += $encuesta->encuestaRespuesta->count();

        if($count > 0) {
             return redirect('/formulario-encuesta/'.$id_encuesta.'')->with('errors_validacion','El Factor no puede ser eliminada. Posee respuestas asociadas');
        } else {
                Factores::destroy($id);
                return redirect('/formulario-encuesta/'.$id_encuesta.'')->with('success','El factor fue eliminada junto con sus Preguntas');
        }
    }



    public function savePregunta(Request $request,$id,$id_encuesta)
    {
        //
        $count = 0;
        $encuesta = Encuesta::find($id_encuesta);
        $count += $encuesta->encuestaRespuesta->count();

        if($count > 0) {
             return redirect('/factores-encuesta/show/'.$id.'/'.$id_encuesta)->with('errors_validacion','La Pregunta no puede ser agregada debido a que la encuesta esta iniciada');
        }else{  


        $factor_pregunta = new Preguntas;
        $factor_pregunta->desc_pregunta                = $request->desc_pregunta;
        $factor_pregunta->ponderador                   = $request->ponderador;
        $factor_pregunta->factores_id                  = $id;
        $factor_pregunta->unidades_municipales_id      = 1;
        $factor_pregunta->req_medio_verificacion       = ($request->req_medio_verificacion == "" ? 0:$request->req_medio_verificacion);

        $factor_pregunta->save();
        return redirect('/factores-encuesta/show/'.$id.'/'.$id_encuesta)->with('success','Registro ingresado correctamente');

        }

   }


}//fin class

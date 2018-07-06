<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convenios;
use App\Encuesta;
use App\Dimension;
use App\Factores;
use App\Preguntas;
use App\Instituciones;
use Illuminate\Support\Facades\Auth;

class FormularioEncuestaController extends Controller
{

    public function index()
    {
        $encuesta = Encuesta::orderBy('id', 'desc')->paginate(env('APP_REG_PAG'));
        return view('formularioEncuesta.index', compact('encuesta'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
            $v = \Validator::make($request->all(), [
                'nombre'                    => 'required|unique:encuestas',
            ]);
 
            if ($v->fails())
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $encuesta = new Encuesta;

            $encuesta->nombre   = $request->get("nombre");
            $encuesta->users_id = Auth::user()->id;
            $encuesta->estado   = 'AC';
            $encuesta->save();

            if ($request->has("clonar")) {
                $this->clonarEncuesta($request->get("encuesta_id"), $encuesta->id);
                return redirect('formulario-encuesta')->with('success','Registro clonado con exito!!');
            }

            return redirect('formulario-encuesta')->with('success','Registro agregado con exito!!');
    }
    
    // Recibe:
    // $id_origen: id de la encuesta origen.
    // $id_destino: id de la encuesta destino.
    // Autor: José Escalante - 22-02-2017.
    public function clonarEncuesta($id_origen, $id_destino)
    {
        // Buscar las dimensiones origen
        $dimension_origen = Dimension::where('encuentas_id',$id_origen)->get();
        foreach ($dimension_origen as $row) {
            $dimension_destino = new Dimension;
            $dimension_destino->nombre = $row->nombre;
            $dimension_destino->encuentas_id = $id_destino;                 // id generado
            $dimension_destino->save();

            // Buscar los factores
            $factor_origen = Factores::where('dimensiones_id',$row->id)->get();
            foreach ($factor_origen as $row) {
                $factor_destino = new Factores;
                $factor_destino->nombre = $row->nombre;
                $factor_destino->dimensiones_id = $dimension_destino->id;   // id generado
                $factor_destino->save();

                // Buscar las preguntas
                $pregunta_origen = Preguntas::where('factores_id',$row->id)->get();
                foreach ($pregunta_origen as $row) {
                    $pregunta_destino = new Preguntas;
                    $pregunta_destino->desc_pregunta = $row->desc_pregunta;
                    $pregunta_destino->ponderador = $row->ponderador;
                    $pregunta_destino->factores_id = $factor_destino->id;  // id generado
                    $pregunta_destino->unidades_municipales_id = $row->unidades_municipales_id;
                    $pregunta_destino->req_medio_verificacion = $row->req_medio_verificacion;
                    $pregunta_destino->save();
                }
            }
        }
        return true;
    }


    // LLama a la vista con el listado de dimesiones y factores  
    public function show($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        return view('formularioEncuesta.showDimensionEncuesta', compact('encuesta'));
    }

    // Envia los datos al formulario de editar
    public function edit($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        return view('formularioEncuesta.editEncuesta', ['encuesta' => $encuesta]);
    }

    // Actualiza en base de datos
    public function update(Request $request, $id)
    {
        $encuesta = Encuesta::find($id);
        $encuesta->nombre = $request->nombre;
        $encuesta->save();
        return redirect('/formulario-encuesta')->with('success','Registro actualizado correctamente');
    }

    // Elimina de la base de datos
    public function destroy($id)
    {
        $count=0;
        $encuesta = Encuesta::find($id);

        // Validar que no exista respuestas
        $count += $encuesta->encuestaRespuesta->count();
        if($count > 0) {
             return redirect('/formulario-encuesta')->with('errors_validacion','La Encuesta no puede ser eliminada. Posee respuestas asociadas');
        } 
        
        // Validar que no exista en convenios
        $count += $encuesta->convenios->count();

        if($count > 0) {
             return redirect('/formulario-encuesta')->with('errors_validacion','La Encuesta no puede ser eliminada. Posee convenios asociados');
        } else {
                Encuesta::destroy($id);
                             
                return redirect('/formulario-encuesta')->with('success','El registro fue eliminado');
        }
    }


}

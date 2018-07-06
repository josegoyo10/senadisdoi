<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dimension;
use App\Encuesta;
use App\EncuestaRespuesta;
use App\Convenios;
use DB;
use Input;

class DimensionController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)

    {
        return view('dimension.newDimension',['id_encuesta' => $id]);
    }

    public function store(Request $request)
    {
        $dimension = new Dimension;
        $encuesta_ID = Input::get('encuentas_id');
        $dimension->create($request->all());
        return redirect('/formulario-encuesta/'.$encuesta_ID.'')->with('success','Registro ingresado correctamente');
    }

    public function show($id)
    {

    }
    
    public function edit($id)
    {
        $dimension = Dimension::findOrFail($id);
        return view('dimension.editDimension', ['dimension' => $dimension]);
    }


    public function update(Request $request, $id)
    {
        //
        $dimension = Dimension::find($id);
        $dimension->nombre = $request->nombre;
        $dimension->save();
        return redirect('/formulario-encuesta/'.$dimension->encuentas_id.'')->with('success','Registro actualizado correctamente');
    }

    public function destroy($id,$id_encuesta)
    {  
        $count=0;
        $encuesta = Encuesta::find($id_encuesta);
        $count += $encuesta->encuestaRespuesta->count();

        if($count > 0) {
             return redirect('/formulario-encuesta/'.$id_encuesta.'')->with('errors_validacion','La Dimensión no puede ser eliminada. Posee respuestas asociadas');
        } else {
              Dimension::destroy($id);
              return redirect('/formulario-encuesta/'.$id_encuesta.'')->with('success','La Dimensión fue eliminada junto con sus Factores');
        }
    }
          
}

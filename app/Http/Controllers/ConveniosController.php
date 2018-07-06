<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convenios;
use App\Encuesta;
use App\EncuestaRespuesta;
use App\Instituciones;
use App\Periodo;

class ConveniosController extends Controller
{

        public function index()
        {
            $convenios = Convenios::orderBy('id', 'desc')->paginate(env('APP_REG_PAG'));
            $encuestas      = Encuesta::all();
            $instituciones      = Instituciones::where('id','<>',1)->orderBy('nombre', 'ASC')->get();
            return view('convenios.index', compact('convenios', 'encuestas', 'instituciones'));
        }

        public function store(Request $request)
        {
     
            $v = \Validator::make($request->all(), [
                'encuestas_id'              => 'required',
                'nombre'                    => 'required',
                'inicio_primera_aplicacion' => 'required',
                'fin_primera_aplicacion'    => 'required',
                'inicio_segunda_aplicacion' => 'required',
                'fin_segunda_aplicacion'    => 'required',
            ]);
 
            if ($v->fails())
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $convenios = new Convenios;

            $convenios->encuestas_id = $request->get("encuestas_id");
            $convenios->nombre = $request->get("nombre");
            $convenios->estado = 'AC';
            $convenios->save();

            $convenios->instituciones()->attach($request->get("convenio_institucion"));

            $periodos = new Periodo;            
            $periodos->convenios_id = $convenios->id;
            $periodos->tipo = 1;
            $periodos->nombre = 'Primera aplicación - '.$request->get("nombre");
            $periodos->fecha_inicio = $request->get("inicio_primera_aplicacion");
            $periodos->fecha_fin = $request->get("fin_primera_aplicacion");
            $periodos->estado = "AB";
            $periodos->save();

            $periodos = new Periodo;            
            $periodos->convenios_id = $convenios->id;
            $periodos->tipo = 2;
            $periodos->nombre = 'Segunda aplicación - '.$request->get("nombre");
            $periodos->fecha_inicio = $request->get("inicio_segunda_aplicacion");
            $periodos->fecha_fin = $request->get("fin_segunda_aplicacion");
            $periodos->estado = "AB";
            $periodos->save();

            return redirect('convenios')->with('success','Registro agregado con exito!!');
       }

        // Envia los datos al formulario de editar
        public function edit($id)
        {
            $convenio = Convenios::findOrFail($id);
            $encuestas      = Encuesta::all();
            // Diferente de 1 para que no muestre a SENADIS.
            $instituciones      = Instituciones::where('id','<>',1)->orderBy('nombre', 'ASC')->get();
            return view('convenios.edit', compact('convenio', 'encuestas', 'instituciones'));
        }
 
        public function update(Request $request, $id) {
            $v = \Validator::make($request->all(), [
                'encuestas_id'              => 'required',
                'nombre'                    => 'required',
                'inicio_primera_aplicacion' => 'required',
                'fin_primera_aplicacion'    => 'required',
                'inicio_segunda_aplicacion' => 'required',
                'fin_segunda_aplicacion'    => 'required',
            ]);
 
            if ($v->fails())
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $convenios = Convenios::findOrFail($id);

            $convenios->encuestas_id = $request->get("encuestas_id");
            $convenios->nombre = $request->get("nombre");
            $convenios->estado = 'AC';
            $convenios->save();

            if ($request->get("convenio_institucion")) {
                $convenios->instituciones()->sync($request->get("convenio_institucion"));
            } else {
                $convenios->instituciones()->detach();
            } 

            $periodos = Periodo::findOrFail($convenios->periodo[0]->id);            
            $periodos->nombre = 'Primera aplicación - '.$request->get("nombre");
            $periodos->fecha_inicio = $request->get("inicio_primera_aplicacion");
            $periodos->fecha_fin = $request->get("fin_primera_aplicacion");
            $periodos->estado = "AB";
            $periodos->save();

            $periodos = Periodo::findOrFail($convenios->periodo[1]->id);            
            $periodos->nombre = 'Segunda aplicación - '.$request->get("nombre");
            $periodos->fecha_inicio = $request->get("inicio_segunda_aplicacion");
            $periodos->fecha_fin = $request->get("fin_segunda_aplicacion");
            $periodos->estado = "AB";
            $periodos->save();

            return redirect('convenios')->with('success','Registro modificado con exito!!');
        }

        // Elimina de la base de datos en cascada.
        // Borrar tambien en periodos.
        // Si tiene encuestas con respuestas no permite borrarlas.
        public function destroy($id)
        {

                $count=0;

                $convenio = Convenios::findOrFail($id);

                $encuestaRespuestas = EncuestaRespuesta::where('periodos_id', '=', $convenio->periodo[0]->id);
                $count += $encuestaRespuestas->count();
                
                $encuestaRespuestas = EncuestaRespuesta::where('periodos_id', '=', $convenio->periodo[1]->id);
                $count += $encuestaRespuestas->count();

                if($count > 0) {
                    return redirect('/convenios')->with('errors_validacion','El convenio no puede ser eliminado. Posee ('.$count.') encuestas respondidas.');
                }

                $convenio->instituciones()->detach();  // ELimina lo que tiene la tabla

                Convenios::destroy($id);
                
                return redirect('/convenios')->with('success','El registro fue eliminado');
        }
} 

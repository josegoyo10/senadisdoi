<?php

namespace App\Http\Controllers;
use App\Http\Requests\EncuestaRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Dimension;
use App\Preguntas;
use App\Factores;
use App\Periodo;
use App\Encuesta;

use App\EncuestaRespuesta;
use App\Respuestas;
use Carbon\Carbon;
use Mail;

use App\PersonaRespondeDimension;

use Illuminate\Support\Facades\Auth;

use DB;
use File;
use App\Role;
use App\User;
use App\Http\Requests;
use Response;
use App\PorcentajeFactor;
use App\PorcentajeDimension;



class EncuestaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /*
     * Send Basic Mail
     */
    public function sendMail()
    {
        $data = ['kibernum' => 'kibernum.com'];

        \Mail::send('mails.email', $data, function ($message) {
            $message->from('prueba@kibernum.com', 'Admin IMDIS');
            $message->to(Auth::user()->email)->subject('Aviso IMDIS');
      });

        // Enviar email a los administradores
        $users_admin = Auth::user()->obtenerAdmin();
        $fecha_envio = date('d/m/Y');
        $name_user = Auth::user()->name;
        $nombre_institucion = Auth::user()->nombreInstitucionUsuario();

        foreach ($users_admin AS $user) {

            \Mail::send('mails.emailAdmin', ['name_user' => $name_user,
                                              'nombre_institucion' => $nombre_institucion,
                                              'fecha_envio' => $fecha_envio
                                            ], function ($message) use($user) {
                $message->from('prueba@kibernum.com', 'Admin SENADIS');
                $message->to($user->email)->subject('Encuesta Enviada: ' . Auth::user()->nombreInstitucionUsuario());
            });
            
        }
        //die();
        return redirect('encuesta')->with('success','Send Mail ok!');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = Input::get('id');

        // OJO: Validar que solo exista un periodo activo para un convenio, que no se solapen los periodos
        //$encuestas  = Encuesta::where('estado','AC')->first();
        $encuestaRespuestas = EncuestaRespuesta::find($id);
        if ($encuestaRespuestas) {
          $encuesta_id = $encuestaRespuestas->encuesta_id;
        } else {
          $encuesta_id  = Encuesta::buscarEncuestaActiva(Auth::user()->instituciones_id);
        }
        //$encuesta_id  = Encuesta::buscarEncuestaActiva(Auth::user()->instituciones_id);
        //   $encuesta_id  = 3;
        // } else {
        //  $encuesta_id  = Encuesta::buscarEncuestaActiva(Auth::user()->instituciones_id);
        // }

        $dimension  = Dimension::where('encuentas_id', $encuesta_id)->orderBy('id', 'ASC')->get();
        $dimension_inicial = Dimension::where('encuentas_id', $encuesta_id)->orderBy('id', 'ASC')->first();

        $id_dimension_inicial = $dimension_inicial->id;
      
        $dimension_final      = Encuesta::find($encuesta_id)->dimension->last();
        $id_final             = $dimension_final->id;
        $total_dimensiones    = Encuesta::find($encuesta_id)->dimension->count();
        
        $total_preguntas      = Preguntas::getCantPreguntas($encuesta_id);
        $factor               = Factores::all();
        $periodo              = Periodo::all();
        
       
        if ($id == '') {
            $encuestaRespuestas = 0;
            $desbloqueda = 1;
            $desc_motivo = " ";
            $imdis = 0;
        }else{
            // Para validar que solo edite sus encuestas
            if (Auth::user()->hasRole('snds')){
              $encuestaRespuestas = EncuestaRespuesta::find($id)
                                ->getEstadoEncuestaRespuestas();
            }else{
              $encuestaRespuestas = EncuestaRespuesta::find($id)
                                ->getEstadoEncuestaRespuestas(Auth::user()->instituciones_id);
            }
             
            
            if ($encuestaRespuestas) 
            {
                $desbloqueda = $encuestaRespuestas->estados_encuesta_id;
            }else{
                return redirect('home')->with('errors_validacion',"Encuesta no pertenece a su municipalidad.");
            }

              
             if (($encuestaRespuestas->estados_encuesta_id === 1) && (Auth::user()->hasRole('oum')))
              {

               return redirect('home')->with('errors_validacion',"La Encuesta no esta completada por parte de su municipalidad.");
               }




            $descripcion_motivo = EncuestaRespuesta::select('motivo_rechazo')
                             ->where('id','=',$id)->firstOrFail();
            $desc_motivo = $descripcion_motivo->motivo_rechazo;

            $imdis = $encuestaRespuestas->imdis;
        }

        
        if ($desbloqueda == 1 ) { // Si esta en borrador esta desbloqueda
            $encuesta_bloqueda = '';
        } else {
            $encuesta_bloqueda = ' disabled ';
        }

        /**
         * Bloquear si el periodo esta cerrado.
         */
        $periodo_cerrado   = Periodo::buscarPeriodoActivo(Auth::user()->instituciones_id, $id);

        // Si es el periodo esta cerrado se bloquea
        if ($periodo_cerrado == 0) {
          $encuesta_bloqueda = ' disabled ';  // Bloquea la encuesta si esta. 
        }

        if (Auth::user()->hasRole('snds')) { // Si es senadis no edita
          $encuesta_bloqueda = ' disabled ';
        }
       
        return view('encuesta.encuesta',['dimension'            => $dimension ,
                                        'total_preguntas'       => $total_preguntas,
                                        'factor'                => $factor,
                                        'periodo'               => $periodo,
                                        'escuesta_bloqueda'     => $encuesta_bloqueda,
                                        'encuestaRespuestas'    => $encuestaRespuestas,
                                        'desc_motivo'           => $desc_motivo,
                                        'desbloqueda'           => $desbloqueda,
                                        'id_dimension_inicial'  => $id_dimension_inicial,
                                        'encuestas_id'          => $encuesta_id,
                                        'id_final'              => $id_final,
                                        'total_dimensiones'     => $total_dimensiones,
                                        'imdis'                 => $imdis,
                                       
                                        ]);
    }


    public function verResumenEncuesta()
    {
        
        // OJO: Validar que solo exista un periodo activo para un convenio, que no se solapen los periodos
        //$encuestas  = Encuesta::where('estado','AC')->first();
        $encuesta_id  = Encuesta::buscarEncuestaActiva(Auth::user()->instituciones_id);

        $dimension  = Dimension::where('encuentas_id', $encuesta_id)->orderBy('id', 'ASC')->get();
        
        $total_preguntas  = Preguntas::getCantPreguntas($encuesta_id);
        
        $factor     = Factores::all();
        $periodo    = Periodo::all();

        $id = Input::get('id');


        $encuestaRespuestas = EncuestaRespuesta::find($id)->getEstadoEncuestaRespuestas(Auth::user()->instituciones_id);
        
        $descripcion_motivo = EncuestaRespuesta::select('motivo_rechazo')
                             ->Where('id','=',$id)->first();
        $desc_motivo = $descripcion_motivo->motivo_rechazo;
        
        $desbloqueda = $encuestaRespuestas->estados_encuesta_id;
        
        $imdis = $encuestaRespuestas->imdis;

        $dimension_inicial = Dimension::where('encuentas_id', $encuesta_id)->orderBy('id', 'ASC')->first();
        $id_dimension_inicial = $dimension_inicial->id;

        $dimension_final      = Encuesta::find($encuesta_id)->dimension->last();
        $id_final             = $dimension_final->id;
        $total_dimensiones  = Encuesta::find($encuesta_id)->dimension->count();

        // Como es resumen no puede editarla
        $escuesta_bloqueda = ' disabled ';

        return view('encuesta.encuesta',['dimension'            => $dimension ,
                                        'total_preguntas'       => $total_preguntas,
                                        'factor'                => $factor,
                                        'periodo'               => $periodo,
                                        'escuesta_bloqueda'     => $escuesta_bloqueda,
                                        'encuestaRespuestas'    => $encuestaRespuestas,
                                        'desc_motivo'           => $desc_motivo,
                                        'desbloqueda'           => $desbloqueda,
                                        'id_dimension_inicial'  => $id_dimension_inicial,
                                        'encuestas_id'          => $encuesta_id,
                                        'id_final'              => $id_final,
                                        'total_dimensiones'     => $total_dimensiones,
                                        'imdis'                 => $imdis
                                        ]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // OJO: Validar que solo exista un periodo activo para un convenio.
        $encuesta_id  = Encuesta::buscarEncuestaActiva(Auth::user()->instituciones_id);
        $periodo_id   = Periodo::buscarPeriodoActivo(Auth::user()->instituciones_id);
        $indice_gral  = Input::get('grafico_gral_imdis');

        // Busca la Encuesta, si existe la modifica si no existe la crea.
        $EncuestaRespuestas = EncuestaRespuesta::find($request->get('id_encuesta_enviar'));
        if(!$EncuestaRespuestas) { // Si no existe crea una nueva
            $EncuestaRespuestas = new EncuestaRespuesta;
            $EncuestaRespuestas->instituciones_id = Auth::user()->instituciones_id;
            $EncuestaRespuestas->users_responde_id = Auth::user()->id;
    
            // Guarda en el maestro / Tabla encuesta_respuesta
            // OJO: Cambiar al periodo que este abierto.
            $EncuestaRespuestas->periodos_id = $periodo_id;
            $EncuestaRespuestas->encuesta_id = $encuesta_id;
            $EncuestaRespuestas->estados_encuesta_id = 1; // Guarda estado Enviado.
           
           
        }


        $EncuestaRespuestas->imdis =  $indice_gral;
        $EncuestaRespuestas->save();
        

        // Respuestas
        if (!is_null($request->get("preguntas"))) { // Si envia preguntas
            foreach ( $request->get("preguntas") as $key => $value) {
                $respuestas = Respuestas::where('preguntas_id', $key)
                                        ->where('encuestas_respuestas_id', $request->get('id_encuesta_enviar'))->first();

                if($respuestas) { // Si existe busca y edita
                    $respuestas = Respuestas::find($respuestas->id);
                } else {            // Si no existe crea una respuesta nueva
                    $respuestas = new Respuestas;
                }

                // Guarda en el detalle
                $respuestas->valor = $value;
                $respuestas->preguntas_id = $key;
                $respuestas->observacion = $request->get("observacion_"."$key");
                $respuestas->encuestas_respuestas_id = $EncuestaRespuestas->id; // Guarda estado guardado.
                if ($value == 0) // Si responde no se borra nombre del archivo.
                {
                    $respuestas->medio_verificacion = "";
                }
                $respuestas->save();    
            }
        }


        // Imagenes

        $destinationPath = env('APP_DIR_MEDIOS_VERIFICACION');

        if (!is_null(Input::file('image'))) { // Si envia archivos
            foreach ( Input::file('image') as $key => $value) {
              $respuestas = Respuestas::where("preguntas_id",$key)
                                      ->where("encuestas_respuestas_id",  
                                          $EncuestaRespuestas->id)->get();
              $respuestas = each($respuestas);

              $respuestas = Respuestas::findOrfail($respuestas[1][0]->id);
              $extension = $value->getClientOriginalName();
              $fileName = date('Ymd').rand(11111,99999).'.'.$extension;
              $value->move($destinationPath, $fileName);
               
              if($respuestas->medio_verificacion != '') {
                File::delete($destinationPath.$respuestas->medio_verificacion);
              }

               $respuestas->medio_verificacion = $fileName;
               $respuestas->save();
            }
        }

        // Guardar Identificacion Evaluacion.
       if (!is_null($request->get("nombre_responde"))) {
        foreach ( $request->get("nombre_responde") as $key => $value) {
            if($value != '' && $request->get("correo_responde")[$key] != '' && $request->get("telefono_responde")[$key] != '') {
              $personaRespondeDimension = PersonaRespondeDimension::where('encuesta_respuesta_id' , $request->get('id_encuesta_enviar'))
                                                                    ->where('dimension_id' , $key)->first();
              if (!$personaRespondeDimension) { // Si no existe crea una nueva
                  $personaRespondeDimension = new PersonaRespondeDimension;
              }

              $personaRespondeDimension->nombre = $value;
              $personaRespondeDimension->correo = $request->get("correo_responde")[$key];
              $personaRespondeDimension->telefono = $request->get("telefono_responde")[$key];
              $personaRespondeDimension->cargo = $request->get("cargo_responde")[$key];
              $personaRespondeDimension->fecha_responde = $request->get("fecha_responde")[$key];
              $personaRespondeDimension->encuesta_respuesta_id = $EncuestaRespuestas->id;
              $personaRespondeDimension->dimension_id = $key;
              $personaRespondeDimension->save(); 

              $personaRespondeDimension->id; 

            }
        }
      }

      //Guarda en las Tabla PorcentajeFactor.
        $enc = $request->get('id_encuesta_enviar');
        $column_factor = Input::get('col_reporte');

        foreach($column_factor as $key => $n ) 
        {
           $procentaje = (($column_factor[$key] == '')? 0 : $column_factor[$key]);
            $arrData[] = array( 
                "encuesta_respuesta_id"  => $EncuestaRespuestas->id,
                "factor_id"                 => $key, 
                "porcentaje"           => $procentaje
                                     
            );

        }   
      
      if(!is_null($enc)) {
        $EncuestaRespuestas->porcentajeFactor()->detach();//ELimina lo que tiene la tabla
      }
       $EncuestaRespuestas->porcentajeFactor()->attach($arrData);//Guarda a en la tabla porcentaje factor relacion muchos a muchos

       //Guarda en las Tabla Porcentaje Dimension
       $column_dimension = Input::get('total_pond_reporte');

        foreach($column_dimension as $key => $n ) 
        {
            $arrDimension[] = array( 
                "encuesta_respuesta_id" => $EncuestaRespuestas->id,
                "dimension_id"          => $key, 
                "porcentaje"            => $column_dimension[$key]
                                     
            );

        }   

        if(!is_null($enc)) {
          $EncuestaRespuestas->porcentajeDimension()->detach();//ELimina lo que tiene la tabla
        }

        $EncuestaRespuestas->porcentajeDimension()->attach($arrDimension);//Guarda a en la tabla porcentaje dimension relacion muchos a muchos

        //if($request->get('btn_guardar_enviar')){
        if($request->get('btn_guardar_borrador')){ 
            
           // return redirect('resumen_encuesta?id='.$EncuestaRespuestas->id);
            return redirect('home')->with('success',trans('traduction.draft_save'));
        }else{

             return redirect('resumen_encuesta?id='.$EncuestaRespuestas->id);
        }
  }


    public function enviar(Request $request)
    {

      
        $EncuestaRespuestas = EncuestaRespuesta::find($request->get('id_encuesta_enviar'));

        $EncuestaRespuestas->estados_encuesta_id = 2; // Guarda estado guardado.

        // Guarda en el maestro
        $EncuestaRespuestas->save();
        
        $this->sendMail();
        return redirect('home')->with('success','El equipo de la Unidad de  Desarrollo Local Inclusivo de SENADIS revisará los datos enviados y notificará cuando ésta sea aceptada o rechazada.');
    }

    public function upFile(Request $request){


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function reactivar($id)
    {
        $EncuestaRespuesta = EncuestaRespuesta::find($id);
        $EncuestaRespuesta->estados_encuesta_id = 1;
        $EncuestaRespuesta->save();

        return redirect('home')->with('success','La encuesta fue reactivada.');
    }

   public function rechazoEncuesta(Request $request){


      $data = Input::all();
      $motivo = 'Rechazo'; 
      $preg_rechazadas = json_decode($_POST['preguntas'], TRUE);//esta en un arreglo las preguntas rechazadas
      $motivo_Rechazo = Input::get('motivo_rechazo');
    
      $EncuestaRespuesta = EncuestaRespuesta::find($data['id_encuesta_enviar']);
      $EncuestaRespuesta->motivo_rechazo = $EncuestaRespuesta->motivo_rechazo."-".Input::get('motivo_rechazo');
        
      $EncuestaRespuesta->save();
     
      
        //Se recorre todo los radios y se guarda su valor en la tabla respuesta
       foreach ($request->get("myRadio") as $key => $value) {
  
        $respuesta = Respuestas::find($key);
        $respuesta->medio_verificacion_aprobado =  (integer) $value;
        $respuesta->save();

        }

       $instituciones_id = EncuestaRespuesta::where('id', '=', $data['id_encuesta_enviar'])
            ->first() ;

        $email_users = User::select('email')
                           ->where('instituciones_id', '=', $instituciones_id->instituciones_id)
                           ->get();
        
        $correos  = array();
        foreach ($email_users as $emails) {
                $correos[]  = $emails;


        } 
    
       //Para actualizar el estado de la encuesta a rechazada.
       $estado = EncuestaRespuesta::where('id', '=', $data['id_encuesta_enviar'])
                ->update(['estados_encuesta_id' => 5]);

        $this->sendMailEncuestaValidada($correos,$motivo,$preg_rechazadas,$motivo_Rechazo);

        return Response::json( array(
            'datos' => 1, 
        ));
   
 }//

//aprobar Encuesta
 public function aprobarEncuesta(Request $request){
        $data = Input::all();
        
        $radios = $request->get("myRadio");
        //echo "Radio:".$valor."<br>";


        $motivo = 'Aprobacion'; 
            //Para actualizar el estado de la encuesta a rechazada.
        $estado = EncuestaRespuesta::where('id', '=', $data['id_encuesta_enviar'])
               ->update(['estados_encuesta_id' => 4]);
            //Para actualizar el estado de la encuesta a rechazada.
     
            //Se recorre todo los radios y se guarda su valor en la tabla respuesta
    if($radios != ''){
        foreach ($request->get("myRadio") as $key => $value) {
                $respuesta = Respuestas::find($key);
                $respuesta->medio_verificacion_aprobado =  (integer) $value;
                $respuesta->save();
           }
     }
            
            $instituciones_id = EncuestaRespuesta::where('id', '=', $data['id_encuesta_enviar'])
            ->first();

            $email_users = User::select('email')
                  ->where('instituciones_id', '=', $instituciones_id->instituciones_id)
                  ->get();
                         
            $correos  = array();

            foreach ($email_users as $emails) {
                $correos[]  = $emails;
            }
            
            $preg_rechazadas = "";
            $motivo_Rechazo = "";
            $this->sendMailEncuestaValidada($correos,$motivo,$preg_rechazadas,$motivo_Rechazo);

                  return Response::json( array(
                    'datos' => 1, 
         ));
   
}

  public function sendMailEncuestaValidada($correos,$motivo,$preg_rechazadas,$motivo_Rechazo)
  {

     $data = [
           'motivo'                 => $motivo,
           'lista_preg_rechazadas'  => $preg_rechazadas,
           'motivo_Rechazo'         => $motivo_Rechazo,
       ];
       
       // Enviar email a los administradores
        $users_admin = Auth::user()->obtenerAdmin();
        $fecha_envio = date('d/m/Y');
        $name_user = Auth::user()->name;
        $nombre_institucion = Auth::user()->nombreInstitucionUsuario();
      
        foreach ($correos AS $row) {
           
           \Mail::send('mails.emailValidacionEncuesta',$data, function ($message) use($row) {
                $message->from('prueba@kibernum.com', 'Admin SENADIS');
                $message->to($row->email)->subject('Encuesta Enviada: ' . Auth::user()->nombreInstitucionUsuario());
            });

            
        }
          
        return 1;
    } 

}//fin class

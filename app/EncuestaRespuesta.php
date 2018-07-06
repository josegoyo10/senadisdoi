<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use Illuminate\Support\Facades\Auth;


class EncuestaRespuesta extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'encuesta_respuestas';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'peridos_id',
        'encuesta_id',
        'instituciones_id',
        'estados_encuesta_id',
        'fecha_evaluacion',
        'users_evaluador_id'
    ];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }
    
    public function estadosEncuesta()
    {
        return $this->belongsTo(EstadosEncuesta::class, 'estados_encuesta_id', 'id');
    }

  
    public function porcentajeFactor()
    {
        return $this->belongsToMany('App\Factores','porcentaje_factor',
            'encuesta_respuesta_id','factor_id')->withPivot('porcentaje');
    }

       public function porcentajeDimension()
    {
        return $this->belongsToMany('App\Factores','porcentaje_dimension',
            'encuesta_respuesta_id','dimension_id')->withPivot('porcentaje');
    }


    public function getEstadoEncuestaRespuestas($instituciones_id = null) {
        if ($instituciones_id == null) {    // Si es una municipalidad
            return EncuestaRespuesta::where ('id' , $this->id)
                                ->first();
        } else { 
            return EncuestaRespuesta::where ('id' , $this->id)
                    ->where ('instituciones_id' , $instituciones_id)
                    ->first();
        }

    }

    static function getPorcentajeAvanceEncuesta($id) {

        if (!$id) {
            return 0; 
        }

        $encuestas  = Encuesta::where('estado','AC')->first();

        $total_preguntas  = Preguntas::getCantPreguntas($encuestas->id);

        $total_respondidas = Respuestas::where ('encuestas_respuestas_id' , $id)->count();

        $porcentaje_avance =  round(($total_respondidas * 100) / $total_preguntas);
        return $porcentaje_avance;
    }

    public function scopeNombreInstitucionEncuesta() {
        $institucionUsuario = Instituciones::where ('id' , $this->instituciones_id)->first();
        return $institucionUsuario->nombre;
    }

    public function scopeNombreUsuarioEncuesta() {
        $usuario = User::find($this->users_responde_id);
        if ($usuario) {
            return $usuario->name;
        } else {
            return "- Usuario no registrado en la base de datos -";
        }
    }

    public function scopeCantEncuestasEnviadas($query, $id_periodo) {

        $sql = "SELECT
                    count(*) AS cant
                    FROM
                    encuesta_respuestas
                    INNER JOIN periodos ON encuesta_respuestas.periodos_id = periodos.id
                WHERE encuesta_respuestas.estados_encuesta_id = 2
                    AND periodos.id = ".$id_periodo;
        $rs_encuestas = DB::select($sql);
        if ($rs_encuestas[0]->cant > 0) {
            return $rs_encuestas[0]->cant;
        } else {
            return "0 ";
        }
    }

    public function scopeCantEncuestasAceptadas($query, $id_periodo) {
        $sql = "SELECT COUNT(*) AS cant
                FROM encuesta_respuestas
                INNER JOIN periodos ON encuesta_respuestas.periodos_id = periodos.id
                WHERE  encuesta_respuestas.estados_encuesta_id = 4
                    AND periodos.id = ".$id_periodo;
        $rs_encuestas = DB::select($sql);

        if ($rs_encuestas[0]->cant > 0) {
            return $rs_encuestas[0]->cant;
        } else {
            return "0 ";
        }
    }

    public function scopeCantEncuestasRechazadas($query, $id_periodo) {
        $sql = "SELECT COUNT(*) AS cant
                FROM encuesta_respuestas
                INNER JOIN periodos ON encuesta_respuestas.periodos_id = periodos.id
                WHERE  encuesta_respuestas.estados_encuesta_id = 5
                    AND periodos.id = ".$id_periodo;
        $rs_encuestas = DB::select($sql);

        if ($rs_encuestas[0]->cant > 0) {
            return $rs_encuestas[0]->cant;
        } else {
            return "0 ";
        }
    }

    // Se usa en el DashBoard
    static function getEncuestasRespondidas($id_periodo = null) {
        
        $sql = "SELECT
                instituciones.nombre AS institucion,
                estados_encuestas.nombre AS estado,
                estados_encuestas.id AS id_estado_encuesta,
                periodos.nombre AS perido,
                encuesta_respuestas.id,
                periodos.fecha_inicio,
                periodos.fecha_fin,
                DATE_FORMAT(encuesta_respuestas.updated_at,'%d/%m/%Y') AS ultima_modificacion,
                convenios.nombre AS nombre_convenio
                FROM
                encuesta_respuestas
                INNER JOIN estados_encuestas ON encuesta_respuestas.estados_encuesta_id = estados_encuestas.id
                INNER JOIN instituciones ON encuesta_respuestas.instituciones_id = instituciones.id
                INNER JOIN periodos ON encuesta_respuestas.periodos_id = periodos.id
                INNER JOIN convenios ON periodos.convenios_id = convenios.id 
                WHERE encuesta_respuestas.periodos_id = ".$id_periodo.
                " ORDER BY encuesta_respuestas.id DESC ";

        $rs_encuestas = DB::select($sql);
        return $rs_encuestas;
    }

    // Retorna las escuentas de la institucion del usuario logeado.
    // Se usa en el Home.
    public function scopeEncuestasInstitucion() {

        $instituciones_id = Auth::user()->instituciones_id;

        $sql = "SELECT
                encuestas.id,
                convenios.nombre,
                periodos.nombre AS nombre_periodo,
                DATE_FORMAT(periodos.fecha_inicio,'%d/%m/%Y') AS fecha_inicio,
                DATE_FORMAT(periodos.fecha_fin,'%d/%m/%Y') AS fecha_fin,
                periodos.estado AS estado_periodo,
                encuesta_respuestas.id AS id_encuesta_respuestas,
                encuesta_respuestas.created_at,
                DATE_FORMAT(encuesta_respuestas.updated_at,'%d/%m/%Y') AS updated_at,
                estados_encuestas.id AS id_estado_encuesta,
                encuestas.nombre,
                estados_encuestas.nombre AS estado_encuesta,
                encuestas.nombre
            FROM
                convenios
                LEFT JOIN periodos ON periodos.convenios_id = convenios.id
                INNER JOIN convenios_instituciones ON convenios_instituciones.convenios_id = convenios.id
                INNER JOIN instituciones ON convenios_instituciones.instituciones_id = instituciones.id
                LEFT JOIN encuesta_respuestas ON encuesta_respuestas.periodos_id = periodos.id AND encuesta_respuestas.instituciones_id = instituciones.id
                LEFT JOIN estados_encuestas ON encuesta_respuestas.estados_encuesta_id = estados_encuestas.id
                INNER JOIN encuestas ON convenios.encuestas_id = encuestas.id
            WHERE instituciones.id = $instituciones_id
                        AND NOW() BETWEEN periodos.fecha_inicio AND periodos.fecha_fin
            ORDER BY encuesta_respuestas.id DESC";


        $rs_encuestas = DB::select($sql);
        return $rs_encuestas;
    }

    // Retorna las escuentas RESPONDIDAS de la institucion del usuario logeado.
    // Se usa en el Home.
    public function scopeEncuestasInstitucionRespondidas() {

        $instituciones_id = Auth::user()->instituciones_id;

        $sql = "SELECT
                    convenios.nombre,
                    periodos.nombre AS nombre_periodo,
                    DATE_FORMAT(periodos.fecha_inicio,'%d/%m/%Y') AS fecha_inicio,
                    DATE_FORMAT(periodos.fecha_fin,'%d/%m/%Y') AS fecha_fin,
                    periodos.estado AS estado_periodo,
                    encuesta_respuestas.id AS id_encuesta_respuestas,
                    encuesta_respuestas.created_at,
                    DATE_FORMAT(encuesta_respuestas.updated_at,'%d/%m/%Y') AS updated_at,
                    encuesta_respuestas.estados_encuesta_id AS estados_encuesta_id,
                    estados_encuestas.nombre AS estado_encuesta
                    FROM
                    convenios
                    INNER JOIN periodos ON periodos.convenios_id = convenios.id
                    INNER JOIN convenios_instituciones ON convenios_instituciones.convenios_id = convenios.id
                    INNER JOIN instituciones ON convenios_instituciones.instituciones_id = instituciones.id
                    INNER JOIN encuesta_respuestas ON encuesta_respuestas.periodos_id = periodos.id AND encuesta_respuestas.instituciones_id = instituciones.id
                    INNER JOIN estados_encuestas ON encuesta_respuestas.estados_encuesta_id = estados_encuestas.id
                    WHERE instituciones.id = ".$instituciones_id."
                            AND NOW() NOT BETWEEN periodos.fecha_inicio AND periodos.fecha_fin
                    ORDER BY encuesta_respuestas.id DESC";


        $rs_encuestas = DB::select($sql);
        return $rs_encuestas;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Preguntas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'preguntas';

    protected $primaryKey  = 'id';


    protected $fillable = [
        'desc_pregunta','ponderador','factores_id','unidades_municipales_id','req_medio_verificacion'
    ];

     // Para que no use los campos updated_at, created_at
    public $timestamps = false;

    // Obtener las respuestas de una pregunta segun 
    static function getRespuestas($preguntas_id,$encuestas_respuestas_id) {

        $respuestas = Respuestas::where('preguntas_id', $preguntas_id)
                            ->where('encuestas_respuestas_id', $encuestas_respuestas_id)
                            ->first(); 

        if($respuestas) { // Si existe busca y edita
            return $respuestas;
        } else {            // Si no existe crea una respuesta nueva
            return $respuestas = new Respuestas;
        }
       
    }  

    // Obtener la cantidad de preguntas de una encuestas 
    static function getCantPreguntas($encuentas_id) {
		$sql = "SELECT 	count(*) as cant
						FROM
							dimensiones
						INNER JOIN factores ON factores.dimensiones_id = dimensiones.id
						INNER JOIN preguntas ON preguntas.factores_id = factores.id
						where encuentas_id = ".$encuentas_id;

        $rs_cant = DB::select($sql);

        return $rs_cant[0]->cant; 
    }


    public function Respuestas() {
      return $this->hasMany('App\Respuestas');
    }








}

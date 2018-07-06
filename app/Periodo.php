<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Periodo extends Model
{
    protected $connection = 'mysql';
    protected $table = 'periodos';

    protected $primaryKey  = 'id';

    // Un Periodo pertenece a una Encuesta 
    public function encuestas()
    {
        return $this->belongsTo('App\Encuesta');
    }

     // Buscar si el periodo para una instituicion y/o id_encuesta especifica.
	static function buscarPeriodoActivo($id_instituciones, $id_encuesta = null)
    {
    	$sql = "SELECT
				periodos.id
				FROM
				convenios
				INNER JOIN convenios_instituciones ON convenios_instituciones.convenios_id = convenios.id
				INNER JOIN periodos ON periodos.convenios_id = convenios.id ";

                if ($id_encuesta != null) {        
                    $sql .= " INNER JOIN encuesta_respuestas ON encuesta_respuestas.periodos_id = periodos.id ";
                }
				
                $sql .= " WHERE convenios_instituciones.instituciones_id = ".$id_instituciones."
				        AND NOW() BETWEEN periodos.fecha_inicio AND periodos.fecha_fin ";

                if ($id_encuesta != null) {
                    $sql .= " AND encuesta_respuestas.id = ".$id_encuesta;
                }

        $rs = DB::select($sql);
        
        if (@$rs[0]->id > 0) {
            return $rs[0]->id;
        } else {
            return 0;
        }
    }

}

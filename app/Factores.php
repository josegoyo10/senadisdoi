<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Response;

class Factores extends Model
{
    protected $connection = 'mysql';
    protected $table = 'factores';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre','dimensiones_id'
    ];

    // Para que no use los campos updated_at, created_at
    public $timestamps = false;

    // Una factor pertenece a una dimensión.
    public function dimension()
    {
        return $this->belongsTo('App\Dimension');
    }

    static function getIdAttributeFactores($id)
    {

        $periodo_id = (($id == null ) ? 0:$id);

        $sql = "SELECT
                DISTINCT
                factores.nombre
                FROM
                factores
                INNER JOIN porcentaje_factor ON porcentaje_factor.factor_id = factores.id
                INNER JOIN encuesta_respuestas ON porcentaje_factor.encuesta_respuesta_id = encuesta_respuestas.id
                WHERE encuesta_respuestas.periodos_id = $periodo_id
                AND encuesta_respuestas.estados_encuesta_id = 4
                ORDER BY factores.nombre";

         $rs_factores = DB::select($sql);
          
        return $rs_factores;
    }

    // Menu 4.
   static function getCumplimientoFactor($id_periodo, $id_regiones)
   {
        $id_periodo = (($id_periodo == null) ? 0:$id_periodo);

        $id_regiones = (($id_regiones == null) ? 0:$id_regiones);

        // Considera solo las encuesta 4: Aceptadas.
        $sql = "SELECT
                factores.nombre as nombre,
                AVG(porcentaje_factor.porcentaje) as promedio
                FROM
                porcentaje_factor
                INNER JOIN factores ON factores.id = porcentaje_factor.factor_id
                INNER JOIN encuesta_respuestas ON encuesta_respuestas.id = porcentaje_factor.encuesta_respuesta_id ";
                if ($id_regiones != 0) {
                    $sql .= " INNER JOIN instituciones ON instituciones.id = encuesta_respuestas.instituciones_id ";
                }

                $sql .= " WHERE  encuesta_respuestas.periodos_id = $id_periodo AND encuesta_respuestas.estados_encuesta_id = 4";
                
                if ($id_regiones != 0) {
                    $sql .= " AND instituciones.regiones_id = $id_regiones ";
                }
                $sql .= " GROUP BY  factores.nombre
                            ORDER BY
                                promedio ASC ";

                $rs_query = DB::select($sql);

        return $rs_query;
   }

    // Un Factor tiene una o muchos preguntas
    public function preguntas()
    {
        return $this->hasMany('App\Preguntas');
    }
}
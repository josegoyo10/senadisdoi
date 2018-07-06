<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dimension extends Model
{
    protected $connection = 'mysql';
    protected $table = 'dimensiones';

    protected $primaryKey  = 'id';

    protected $fillable = [
    	'nombre','encuentas_id'
    ];

    // Para que no use los campos updated_at, created_at
    public $timestamps = false;


    // Una dimensioón pertenece a una encuesta.
    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta');
    }

    // Una Encuesta tiene muchos factores.
    public function factor()
    {
        return $this->hasMany('App\Factores','dimensiones_id');
    }

    /**
    *    Para filtrar por nombre
    */
    public function scopeNombre($query, $nombre) 
    {
        if (trim($nombre) != '') {
            $query->where('nombre', 'LIKE' , "$nombre%");
        }
    }

    /**
    *    Para filtrar por descripción
    */
    public function scopeDescripcion($query, $descripcion) 
    {
        if (trim($descripcion) != '') {
            $query->where('descripcion', 'LIKE' , "%$descripcion%");
        }
    }

    // Menu 3: Lista las dimensiones segun el periodo.
    static function getIdAttributeDimensiones($id_periodo)
    {
        $id_periodo= (($id_periodo == null) ? 0:$id_periodo);
        $sql = "SELECT
                    dimensiones.id,
                    dimensiones.nombre
                FROM
                    dimensiones
                INNER JOIN encuestas ON dimensiones.encuentas_id = encuestas.id
                INNER JOIN convenios ON convenios.encuestas_id = encuestas.id
                INNER JOIN periodos ON periodos.convenios_id = convenios.id";
                if ($id_periodo != 0) {
                    $sql .= " WHERE
                                periodos.id = $id_periodo ";
                }
                $sql .= " GROUP BY nombre
                            ORDER BY nombre ";

             $rs_dimensiones = DB::select($sql);
             return $rs_dimensiones;


     }

     // Menu: 2
    static function getPorcentajeDimension($id_periodo, $id_region)
    {
        $id_periodo= (($id_periodo == null) ? 0:$id_periodo);
        $id_region= (($id_region == null) ? " " :$id_region);

        // Considera solo las encuesta estado 4: Aceptadas.
        $sql = "SELECT
                    dimensiones.nombre AS nombre,
                    AVG(porcentaje_dimension.porcentaje) AS porcentaje
                FROM
                porcentaje_dimension
                INNER JOIN dimensiones ON dimensiones.id = porcentaje_dimension.dimension_id
                INNER JOIN encuesta_respuestas ON encuesta_respuestas.id = porcentaje_dimension.encuesta_respuesta_id ";
                if ($id_region != 0) {
                    $sql .= " INNER JOIN instituciones ON encuesta_respuestas.instituciones_id = instituciones.id ";
                }
                
                $sql .= " WHERE
                    encuesta_respuestas.periodos_id = $id_periodo
                AND encuesta_respuestas.estados_encuesta_id = 4 ";
                if ($id_region != 0) {
                    $sql .= " AND instituciones.regiones_id = $id_region ";
                }
                $sql .= " GROUP BY nombre
                ORDER BY 
                    porcentaje ASC ";

        $rs_dimension = DB::select($sql);
        return $rs_dimension;

    }






}
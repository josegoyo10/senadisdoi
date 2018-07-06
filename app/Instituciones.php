<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Instituciones extends Model
{
    protected $connection = 'mysql';
    protected $table = 'instituciones';

    protected $primaryKey  = 'id';
    public $timestamps = false;
    
      protected $fillable = [
        'regiones_id',
        'nombre',
        'comuna',
        'provincia',
        'persona_contacto',
        'correo_contacto',
        'telefono_contacto'
   
    ];


    // Instituciones tiene muchos usuarios
    public function users()
    {
        return $this->hasMany('App\User');
    }

     // Instituciones tiene muchos usuarios
    public function regiones()
    {
        return $this->belongsTo('App\Regiones');
    }

    // Menu 1.
    static function getMunicipiosPorcentajePost($id_periodo, $id_region)
    {

         $id_periodo = (($id_periodo == null) ? 0:$id_periodo);
         $id_region = (($id_region == null) ? 0:$id_region);
        

           $sql = "SELECT
                      instituciones.comuna AS nombre,
                      (CASE encuesta_respuestas.imdis WHEN encuesta_respuestas.imdis='NaN' THEN 0 ELSE encuesta_respuestas.imdis END) AS porcentaje
                    
                    FROM
                    instituciones
                    INNER JOIN encuesta_respuestas ON encuesta_respuestas.instituciones_id = instituciones.id
                    WHERE
                        encuesta_respuestas.periodos_id = $id_periodo
                    AND encuesta_respuestas.estados_encuesta_id = 4 ";
                    if ($id_region != 0) {
                        $sql .= " AND instituciones.regiones_id = $id_region ";

                    }
                    $sql .= " ORDER BY porcentaje ";


             $rs_municipios = DB::select($sql);
             

             return $rs_municipios;

    }

    // Menu 3: Dimensión por Municipalidad.
    static function getDimensionMunicipalidad($id_dimension,$id_periodo, $id_region)
    {
    

        $id_dimension  = (($id_dimension == null) ? 0:$id_dimension);

        $id_periodo    = (($id_periodo == null) ? 0:$id_periodo);

        $id_region    = (($id_region == null) ? 0:$id_region);
       
        $sql = "SELECT
                (CASE pd.porcentaje WHEN pd.porcentaje='NaN' THEN 0 ELSE pd.porcentaje END) AS porcentaje,
                    instituciones.comuna AS nombre
                FROM
                    porcentaje_dimension AS pd
                INNER JOIN encuesta_respuestas ON pd.encuesta_respuesta_id = encuesta_respuestas.id
                INNER JOIN instituciones ON encuesta_respuestas.instituciones_id = instituciones.id ";
                
                $sql .= " WHERE
                    pd.dimension_id = $id_dimension
                AND encuesta_respuestas.periodos_id = $id_periodo
                AND encuesta_respuestas.estados_encuesta_id = 4 ";

                if ($id_region != 0) {
                    $sql .= " AND instituciones.regiones_id = $id_region ";
                }
                $sql .= " GROUP BY
                            instituciones.comuna
                        ORDER BY porcentaje";

            //dd($sql);
            $rs_query = DB::select($sql);


             return $rs_query;

    }

    // Menu 5.
     static function getFactorMunicipalidad($nombre_factor,$id_combo, $id_region)
    {
      
      $nombre_factor = (($nombre_factor == null) ? "' '":$nombre_factor);
      $id_combo = (($id_combo == null)  ? 0:$id_combo);
      $id_region = (($id_region == null)  ? 0:$id_region);

        $sql = "SELECT
            pf.porcentaje AS porcentaje,
            instituciones.comuna AS nombre

        FROM
        porcentaje_factor AS pf
        INNER JOIN encuesta_respuestas ON pf.encuesta_respuesta_id = encuesta_respuestas.id
        INNER JOIN instituciones ON encuesta_respuestas.instituciones_id = instituciones.id
        WHERE pf.factor_id IN (
                                SELECT f.id FROM factores AS f
                                INNER JOIN dimensiones ON f.dimensiones_id = dimensiones.id
                                INNER JOIN encuestas ON dimensiones.encuentas_id = encuestas.id
                                INNER JOIN convenios ON convenios.encuestas_id = encuestas.id
                                INNER JOIN periodos ON periodos.convenios_id = convenios.id
                                WHERE f.nombre = '$nombre_factor'
                                AND periodos.id = $id_combo
                            )
        AND encuesta_respuestas.periodos_id = $id_combo
        AND encuesta_respuestas.estados_encuesta_id = 4 ";
        if ($id_region != 0) {
           $sql.= " AND instituciones.regiones_id = $id_region ";
        }
        $sql .= " GROUP BY
            instituciones.comuna ";

        $rs_query = DB::select($sql);

        return $rs_query;
    }

  
  static function getPromedioFactormunicipalidad($nombre_factor,$id_combo, $id_region){
  
     $nombre_factor = (($nombre_factor == null) ? "' '":$nombre_factor);
     $id_combo = (($id_combo == null)  ? 0:$id_combo);
     $id_region = (($id_region == null)  ? 0:$id_region);

            
   $sql = "SELECT
            AVG(pf.porcentaje) AS promedio
            
        FROM
        porcentaje_factor AS pf
        INNER JOIN encuesta_respuestas ON pf.encuesta_respuesta_id = encuesta_respuestas.id
        INNER JOIN instituciones ON encuesta_respuestas.instituciones_id = instituciones.id
        WHERE pf.factor_id IN (
                                SELECT f.id FROM factores AS f
                                INNER JOIN dimensiones ON f.dimensiones_id = dimensiones.id
                                INNER JOIN encuestas ON dimensiones.encuentas_id = encuestas.id
                                INNER JOIN convenios ON convenios.encuestas_id = encuestas.id
                                INNER JOIN periodos ON periodos.convenios_id = convenios.id
                                WHERE f.nombre = '$nombre_factor'
                                AND periodos.id = $id_combo
                            )
        AND encuesta_respuestas.periodos_id =$id_combo
        AND encuesta_respuestas.estados_encuesta_id = 4";
        if ($id_region != 0) {
           $sql.= " AND instituciones.regiones_id = $id_region ";
        }

         $rs_query = DB::select($sql);

        return $rs_query;



  }

}
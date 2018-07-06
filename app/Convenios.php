<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Convenios extends Model
{
    protected $connection = 'mysql';
    protected $table = 'convenios';

    protected $primaryKey  = 'id';

    // Un convenio pertenece a una encuesta
    public function encuestas()
    {
        return $this->belongsTo('App\Encuesta');
    }

    // Un convenio tiene uno o muchos periodos (2)
    public function periodo()
    {
        return $this->hasMany('App\Periodo');
    }

         // Un puede tener muchas instituciones
    public function instituciones()
    {
        return $this->belongsToMany('App\Instituciones','convenios_instituciones','convenios_id','instituciones_id');
    }


    // Se usa en todos los reportes
    static function getIdAttributeConvenios()
    {

        $sql = "SELECT
                periodos.id,
                periodos.nombre AS aplicacion
            FROM
            convenios
            JOIN periodos ON periodos.convenios_id = convenios.id 
             ORDER BY periodos.id ";
             $rs_periodos = DB::select($sql);
             return $rs_periodos;


    }



}

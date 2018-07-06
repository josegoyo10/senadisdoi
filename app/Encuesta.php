<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Encuesta extends Model
{
    protected $connection = 'mysql';
    protected $table = 'encuestas';

    protected $primaryKey  = 'id';

    public function encuestaRespuesta()
    {
        return $this->hasMany(EncuestaRespuesta::class);
    }

    // Una Encuesta puede pertenecer a muchos convenios.
    public function convenios()
    {
        return $this->hasMany('App\Convenios','encuestas_id');
    }

    // Una Encuesta pertenece a un usuario.
    public function users()
    {
        return $this->belongsTo('App\user');
    }

    // Una Encuesta tiene muchas dimensiones.
    public function dimension()
    {
        return $this->hasMany('App\Dimension','encuentas_id');
    }

    /**
     * Buscar una encuesta activa para una institucion
     * Se usa en el el store de EncuestaController
     */
    static function buscarEncuestaActiva($id_instituciones)
    {
        $sql = "SELECT
                convenios.encuestas_id
                FROM
                convenios
                INNER JOIN convenios_instituciones ON convenios_instituciones.convenios_id = convenios.id
                INNER JOIN periodos ON periodos.convenios_id = convenios.id
                WHERE convenios_instituciones.instituciones_id = ".$id_instituciones."
                    AND NOW() BETWEEN periodos.fecha_inicio AND periodos.fecha_fin";

        $rs = DB::select($sql);

        if (@$rs[0]->encuestas_id > 0) {
            return $rs[0]->encuestas_id;
        } else {
            return 0;
        }
    }

}

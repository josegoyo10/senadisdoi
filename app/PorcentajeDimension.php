<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PorcentajeDimension extends Model
{
    protected $connection = 'mysql';
    protected $table = 'porcentaje_dimension';

    protected $primaryKey  = 'encuesta_respuesta_id';
}

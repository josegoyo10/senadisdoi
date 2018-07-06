<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaRespondeDimension extends Model
{
     protected $connection = 'mysql';
    protected $table = 'persona_responde_dimensions';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'encuesta_respuesta_id',
        'dimension_id',
        'nombre',
        'correo',
        'telefono'
    ];}

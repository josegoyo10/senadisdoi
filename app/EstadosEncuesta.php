<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosEncuesta extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'estados_encuestas';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    public function encuestaRespuesta()
    {
        return $this->hasMany(EncuestaRespuesta::class, 'estados_encuesta_id', 'id');
    }
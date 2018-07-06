<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensajeria extends Model
{
    protected $connection = 'mysql';
    protected $table = 'mensajeria';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'mensajes',
        'users_id',
        'encuestas_respuestas_id'

    ];

    // Para que no use los campos updated_at, created_at
    public $timestamps = false;

    static function getMensajesSinResponder() {

        $mensajes_sin_responder = Mensajeria::where ('mensaje_respuesta','=' , NULL)->count();

        return $mensajes_sin_responder;
    }



}

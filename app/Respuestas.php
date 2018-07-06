<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{

    protected $connection = 'mysql';
    protected $table = 'respuestas';

    protected $primaryKey  = 'id';


    // Para que no use los campos updated_at, created_at
    public $timestamps = false;

    protected $fillable = [
    	'valor',
        'preguntas_id',
        'encuestas_respuestas_id'
    ];

   
      public function Pregunta()
    {
      return $this->belongsTo('App\Preguntas');
    }







}

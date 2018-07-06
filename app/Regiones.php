<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regiones extends Model
{
    protected $connection = 'mysql';
    protected $table = 'regiones';

    protected $primaryKey  = 'id';



        // Instituciones tiene muchos usuarios
    public function instituciones()
    {
        return $this->hasMany('App\Instituciones');
    }

    


      
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Auth;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // user has many posts
    public function posts()
    {
        return $this->hasMany('App\Posts','author_id');
    }

    // user has many comments
    public function comments()
    {
        return $this->hasMany('App\Comments','from_user');
    }

    // user pertenece a una institucion
    public function instituciones()
    {
        return $this->belongsTo('App\Instituciones');
    }

    // user crea muchas encuestas
    public function encuestas()
    {
        return $this->hasMany('App\Encuesta','users_id');
    }

    public function can_post()
    {
        //$role = $this->role;
        //if($role == 'author' || $role == 'admin')
        if(Auth::user()->can('administrador-SENADIS'))
        {
            return true;
        }
        return false;
    }

    // Para validar dentro de una pagina cosas pequeñas
    public function can_dashboard()
    {
        if(Auth::user()->can('administrador-SENADIS'))
        {
            return true;
        }
        return false;
    }

    public function is_admin()
    {
        //$role = $this->role;
        //if($role == 'admin')
        if(Auth::user()->can('administrador-SENADIS'))
        {
            return true;
        }
        return false;
    }
    //
    //
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    
    public function scopeNombreInstitucionUsuario() {
        $institucionUsuario = Instituciones::where ('id' , $this->instituciones_id)->first();
        return $institucionUsuario->nombre;
    }

    public function scopeNombreRegionInstitucion() {
        $institucionUsuario = Instituciones::where ('id' , $this->instituciones_id)->first();
        $region = Regiones::where ('id' , $institucionUsuario->regiones_id)->first();
        return $region->nombre_region;
    }

    /**
     *    Para filtrar por nombre
     */
    public function scopeNombre($query, $name)
    {
        if (trim($name) != '') {
            $query->where('name', 'LIKE' , "%$name%");
        }
    }

    // Retorna un arreglo con los administradores del sistema
    public function obtenerAdmin()
    {
        $sql = "SELECT
                    users.`name`,
                    users.email,
                    roles.display_name
                FROM
                    users
                INNER JOIN role_user ON users.id = role_user.user_id
                INNER JOIN roles ON role_user.role_id = roles.id
                WHERE
                    roles.`name` = 'snds'";

        $rs_admin = DB::select($sql);
        
        return $rs_admin;
    }

}

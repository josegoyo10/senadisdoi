<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function users(){
        return $this->belongsToMany('App\User');
    }



   static function getInsertarRoles($user_last,$user_rol){
   
     //dd($user_last);
   	return DB::table('role_user')->insert(
			            array('user_id' => $user_last,
			          		  'role_id' => $user_rol)
               );

       }


}

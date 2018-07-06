<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

class DashboardController extends Controller
{
    
    public function verDashboard()
    {
	   if (Auth::user()->can_dashboard() ) 
	   {
	        $rs_encuestas = EncuestaRespuesta::getEncuestasRespondidas(1);
	        return view('administracion.dashboard',['rs_encuestas' => $rs_encuestas, ]);
	    } else {
				return redirect('/')->with('error','Ud. no posee sufucientes permisos.');
	    }
    }
}

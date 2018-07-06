<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instituciones;
use App\Regiones;
//use Auth;
//use Request;

class FichaController extends Controller
{
  

	    public function index()
	    {
	      
	     $institucion = Instituciones::orderBy('id', 'desc')->paginate(env('APP_REG_PAG'));
         $regiones 		= Regiones::all();
	     return view('ficha/index', compact('institucion', 'regiones'));
	    }



	    public function storeInstitucion(Request $request)
	   {
	      

         $institucion = new Instituciones;
     
        $v = \Validator::make($request->all(), [
            
            'regiones_id' 	   	=> 'required',
            'nombre'      	   	=> 'required',
            'comuna'      	   	=> 'required',
            'provincia'   	   	=> 'required',
            'persona_contacto' 	=> 'required',
            'correo_contacto'  	=> 'required|email|unique:instituciones',
            'telefono_contacto' => 'required'
           
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }


          $institucion->create($request->all());
	      return redirect('institucion')->with('success','Institucion Agregada con exito!!');
	   }
 
} 

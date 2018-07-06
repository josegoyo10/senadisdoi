<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Dimension;
use App\Preguntas;
use App\Factor;
use App\Periodo;
use App\Role;
use App\Permission;
use App\RoleUser;
use App\Posts;

use App\Encuesta;

use App\EncuestaRespuesta;

use App\Convenios;

use DB;

use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */

    public function index(Request $request)
    {
        if(Auth::user()->can_dashboard()) {

            $id_periodo = $request->get('id_periodo');
            if ($id_periodo == null) {
                $id_periodo = 0;
            }
            $periodo = Convenios::getIdAttributeConvenios();

            $rs_encuestas = EncuestaRespuesta::getEncuestasRespondidas($id_periodo);
            return view('administracion.dashboard',compact('rs_encuestas',
                                                            'periodo',
                                                            'id_periodo'));

        } else {
                
                $rs_encuestas = EncuestaRespuesta::encuestasInstitucion();
                $rs_encuestas_respondidas = EncuestaRespuesta::encuestasInstitucionRespondidas();

                $periodo =  Periodo::all();
                $encuesta =  Encuesta::all();

                $posts = Posts::where('active','1')->orderBy('created_at','desc')->paginate(3);
                $title = '&Uacute;ltimas Publicaciones';
                                
                return view('home',[  'periodo'  => $periodo , 
                                                'encuesta' => $encuesta, 
                                                'rs_encuestas' => $rs_encuestas,
                                                'rs_encuestas_respondidas' => $rs_encuestas_respondidas,
                                                'title' =>  $title,
                                                'posts' => $posts
                                            ]);
        }


    }
}
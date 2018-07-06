<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Mensajeria;
use App\User;
use App\Http\Requests\MesajeriaRequest;
use DB;

class MensajeriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('administrador-SENADIS'))
        {
            $mensajeria  = Mensajeria::orderBy('id', 'DESC')->paginate(env('APP_REG_PAG'));
            $mensajes_sin_responder  = Mensajeria::where('mensaje_respuesta', NULL)
                                    ->count();
            $mensajes_total  = Mensajeria::count();
        } else {
            $mensajeria  = Mensajeria::where( 'users_id', Auth::user()->id )
                                        ->orderBy('id', 'DESC')->paginate(env('APP_REG_PAG'));
            $mensajes_sin_responder  = Mensajeria::where( 'users_id', Auth::user()->id )
                                                 ->where('mensaje_respuesta', NULL)
                                                 ->count();
            $mensajes_total  = Mensajeria::where( 'users_id', Auth::user()->id )
                                               ->count();
        }
        $users = User::all();
        //  $mensajes_sin_contestar = Mensajeria::all()->count();
        return view('mensajeria.mensajeria',['mensajeria'=> $mensajeria
                                            ,'mensajes_sin_responder'=> $mensajes_sin_responder
                                            ,'mensajes_total'=> $mensajes_total
                                            ,'users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MesajeriaRequest $request)
    {
        $mesaje = new Mensajeria;
        $mesaje->mensajes   = $request->get('message');
        $mesaje->users_id    = Auth::user()->id;
        $mesaje->encuestas_respuestas_id = 317;
        $mesaje->created_at = date("Y-m-d H:i:s");
        //$mesaje->delete_at  = date("Y-m-d H:i:s");
        $mesaje->save();
        return redirect('mensajes')->with('success','Mensaje creado correctamente');
    }


    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd("Editar mensajeria deshabilitado.");
        $mesaje = Mensajeria::find($id);
        return view('mensajeria.edit', ['mesaje' => $mesaje]);
    }

    public function responder($id)
    {
        $mesaje = Mensajeria::find($id);
        return view('mensajeria.responder', ['mesaje' => $mesaje]);
    }

    public function guardarRespuesta(MesajeriaRequest $request, $id)
    {
        //dd($request->all());
        $mesaje = Mensajeria::find($id);
        $mesaje->mensaje_respuesta = $request->get('message');
        $mesaje->save();
        return redirect('mensajes')->with('success', "El mensaje [#$id] ha sido respondida");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MesajeriaRequest $request, $id)
    {
        //dd($request->all());
        dd("Editar mensajeria deshabilitado.");
        $mesaje = Mensajeria::find($id);
        $mesaje->mensajes = $request->get('message');
        $mesaje->save();
        return redirect('mensajes')->with('success', 'Registro modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("Eliminar mensajeria deshabilitado.");
        $mesaje = Mensajeria::find($id);
        $mesaje->delete();
        return redirect('mensajes')->with('success', 'Registro elimiado correctamente');//
    }
}

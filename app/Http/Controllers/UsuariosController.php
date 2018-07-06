<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Posts;
use Hashids;
use App\Role;
use App\Instituciones;
use Auth;
use Mail;

use App\Http\Requests\UserRequest;



class UsuariosController extends Controller
{

    public function index(){
        return redirect('users')->with('success','Usuario Modificado correctamente');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decode = Hashids::decode($id)[0];
        $user = User::find($decode);
        $instituciones = Instituciones::orderBy('nombre', 'ASC')->get();
        return view('usuarios.index',compact('user','instituciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $decode = Hashids::decode($id)[0];
        $user = \App\User::find($decode);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->instituciones_id = $request->get('municipalidad');


        $user->save();
        $nombre = $request->get("nombre");
        $users = User::nombre($nombre)->orderBy('id', 'ASC')->paginate(env('APP_REG_PAG'));

        return redirect('users')->with('success','Usuario Modificado correctamente');

    }

    /**
     * Send Basic Mail
     */
    public function sendMailPassword($id,$token)
    {
        $decode = Hashids::decode($id)[0];
        $users = User::find($decode);
        \Mail::send('mails.sendPassword',
            ["token" => $token],
            function ($message) use ($users) {
                $message->from('prueba@kibernum.com', 'Administrador SENADIS');
                $message->to($users->email)->subject('Notificación');
        });
        return redirect('users')->with('success', 'Se ha enviado un correo indicando como puede reiniciar la contraseña!');
    }
}

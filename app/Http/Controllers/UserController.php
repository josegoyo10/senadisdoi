<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Posts;
use Caffeinated\Shinobi\Models\Permission;
use Hashids;
use App\Role;
use Auth;
use App\Instituciones;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use DB;

class UserController extends Controller {

	public function index(Request $request)
	{
		$nombre = $request->get("nombre");
		if(($request->get('municipalidad') !=''))
		{
			$municipalidades = \App\Instituciones::where('nombre', 'like' , "%".$request->get('municipalidad')."%")->get();
			$array_instituciones =array();
			foreach($municipalidades as $row){
				array_push($array_instituciones, $row->id);
			}
			$users = User::whereIn('instituciones_id', $array_instituciones)->nombre($nombre)->orderBy('id', 'DESC')->paginate(env('APP_REG_PAG'));
		} else {
			$users = User::nombre($nombre)->orderBy('id', 'DESC')->paginate(env('APP_REG_PAG'));
		}

		return view('users.index', compact('users'));//,'municipalidad'));
	}

	/**
	 * Create
	 */
	public function create(){
		$roles        = Role::all();
		$instuciones = Instituciones::orderBy('nombre', 'ASC')->get();
		return view('users.create',compact('instuciones','roles'));
	}

	/**
	 * Show
	 */
	public function show(){
		//return view('users.edit');
	}
	/**
	 * Store
	 */
	public function store(UserRequest $request)
	{
		try
        {
			$user = new User;
			$user->name   = $request->get('name');
			$user->email  = $request->get('email');
			
			$user->instituciones_id = $request->get('municipalidad');
			$user->password = bcrypt($request->get('password'));
			$user->role="default";
           
			$user->save();
            
            //Busca el ultimo usuario ingresado para luego en la tabla de roles asignarle en el campo user_id el id del ultimo usuario agregado
            $user_last     = User::all()->last()->id;

            foreach($request->get('role') as $row) {
				$user_rol = $row;
			}

              $user_rol_insert = Role::getInsertarRoles($user_last,$user_rol);

			return redirect('users')->with('success','Usuario creado correctamente');
            
        }
        catch (FormValidationException $e)
        {
            // Failed.
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }


	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function edit(Request $request,$id)
	{
		//dd($re);
		$decode = Hashids::decode($id)[0];
		$user = User::find($decode);
		$roles        = Role::all();

		$formAction = action('UserController@update', $id);
		return view("users/form", compact('user', 'formAction','roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{

		//dd($request);
		$decode = Hashids::decode($id)[0];
		$users          = ($id) ? User::find($decode) : new User;
		$users->name    = $request->get('name');
		$users->detachRoles($users->roles);
		$users->save();
		$roles = $request->get('role');
		if ($roles) {
			$users->attachRoles($roles);

		}
		return redirect("users")->with('success', 'Registro guardado correctamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$decode = Hashids::decode($id)[0];
		$users = User::findOrFail($decode);
		$users->delete();
		return redirect("users")->with('success', 'Registro borrado correctamente');
	}

	/**
	 * Save the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function saveData(Request $request, $id)
	{

		$users          = ($id) ? User::find($id) : new User;
		$users->name    = $request->get('name');
		$users->detachRoles($users->roles);
		$users->save();

		$roles = $request->get('role');
		if ($roles) {
			$users->attachRoles($roles);
		}
	}

	/*
	 * Display the posts of a particular user
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function user_posts($id)
	{
		$posts = Posts::where('author_id',$id)->where('active','1')->orderBy('created_at','desc')->paginate(5);
		$title = User::find($id)->name;
		return view('noticias.home')->withPosts($posts)->withTitle($title);
	}

	public function user_posts_all(Request $request)
	{
		$user = $request->user();
		$posts = Posts::where('author_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(env('APP_REG_PAG'));
		$title = $user->name;
		return view('noticias.home')->withPosts($posts)->withTitle($title);
	}
	
	public function user_posts_draft(Request $request)
	{
		$posts = Posts::where('author_id',Auth::user()->id)->where('active','0')->orderBy('created_at','desc')->paginate(env('APP_REG_PAG'));
		$title = Auth::user()->name;
		return view('noticias.home')->withPosts($posts)->withTitle($title);
	}

	/**
	 * profile for user
	 */
	public function profile(Request $request, $id) 
	{
		dd($request);
		$data['user'] = User::find($id);
		if (!$data['user'])
			return redirect('/');

		if (Auth::user()->id && $data['user'] -> id == Auth::user()-> id) {
			$data['author'] = true;
		} else {
			$data['author'] = null;
		}
		$data['comments_count'] = $data['user']->comments->count();
		$data['posts_count'] = $data['user']->posts->count();
		$data['posts_active_count'] = $data['user']->posts->where('active', 1)->count();
		$data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
		$data['latest_posts'] = $data['user']->posts->where('active', 1)->take(5);
		$data['latest_comments'] = $data['user']->comments->take(5);
		return view('noticias.admin.profile', $data);
	}


}


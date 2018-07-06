<?php namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Redirect;
use App\PostsUpload;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use Illuminate\Http\Request;

// note: use true and false for active posts in postgresql database
// here '0' and '1' are used for active posts because of mysql database

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Posts::where('active','1')->orderBy('created_at','desc')->paginate(env('APP_REG_PAG'));
		$title = '&Uacute;ltimas Publicaciones';
		return view('noticias.home')->withPosts($posts)->withTitle($title);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		// 
		if($request->user()->can_post())
		{
			return view('posts.create');
		}	
		else 
		{
			return redirect('/')->withErrors('Ud. no posee suficientes permisos para escribir una noticia');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostFormRequest $request)
	{
		$post = new Posts();
		$post->title = $request->get('title');
		$post->body = $request->get('body');
		$post->slug = str_slug($post->title);
		$post->posts_uploads_id = 1;
		
		$duplicate = Posts::where('slug',$post->slug)->first();
		if($duplicate)
		{
			return redirect('nueva-noticia')->withErrors('El Titulo ya existe.')->withInput();
		}	
		
		$post->author_id = $request->user()->id;
		if($request->has('save'))
		{
			$post->active = 0;
			$message = 'Publicaci&oacute;n grabada correctamente.';
		}			
		else 
		{
			$post->active = 1;
			$message = 'Ha sido publicado correctamente';
		}
		$post->save();
		if ($request->get('image')) {
			$mime = Input::file('image')->getMimeType();
			$size = Input::file('image')->getSize();
		}
		if (Input::file('image')) {
			$destinationPath = 'uploads/noticias'; // upload path
			$extension = Input::file('image')->getClientOriginalName(); // getting image name
			$fileName = date('Ymd') .'_'. rand(11111, 99999) . '_' . $extension; // renameing image
			Input::file('image')->move($destinationPath, $fileName); // uploading file to given path

			// Insert PostUpload
			$upload = new PostsUpload();
			$upload->name	= $fileName;
			$upload->post_id = 1;
			$upload->save();
		}
		return redirect('edit/'.$post->slug)->withMessage($message);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Posts::where('slug',$slug)->first();

		if($post)
		{
			if($post->active == false)
				return redirect('/')->withErrors('requested page not found');
			$comments = $post->comments;	
		}
		else 
		{
			return redirect('/')->withErrors('requested page not found');
		}
		return view('posts.show')->withPost($post)->withComments($comments);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request,$slug)
	{
		$post = Posts::where('slug',$slug)->first();
		if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
			return view('posts.edit')->with('post',$post);
		else 
		{
			return redirect('/')->withErrors('Ud. no pos&eacute;e sufucientes permisos');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		//
		$post_id = $request->input('post_id');
		$post = Posts::find($post_id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
			$title = $request->input('title');
			$slug = str_slug($title);
			$duplicate = Posts::where('slug',$slug)->first();
			if($duplicate)
			{
				if($duplicate->id != $post_id)
				{
					return redirect('edit/'.$post->slug)->withErrors('El titulo ya existe.')->withInput();
				}
				else 
				{
					$post->slug = $slug;
				}
			}
			
			$post->title = $title;
			$post->body = $request->input('body');
			
			if($request->has('save'))
			{
				$post->active = 0;
				$message = 'La Publicaci&oacute;n ha sido guardada correctamente.';
				$landing = 'edit/'.$post->slug;
			}			
			else {
				$post->active = 1;
				$message = 'Ha sido publicado Correctamente.';
				$landing = 'noticias/'.$post->slug;
			}
			$post->save();
	 		return redirect($landing)->withMessage($message);
		}
		else
		{
			return redirect('/')->withErrors('Ud. no pos&eacue;e sufucientes permisos.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		//
		$post = Posts::find($id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
		{
			$post->delete();
			$data['message'] = 'Publicacion borrada Correctamente.';
		}
		else 
		{
			$data['errors'] = 'Operaci&oacute;n Invalida. Ud. no pos&eacute;e suficientes permisos.';
		}
		
		return redirect('/noticias/')->with($data);
	}
}

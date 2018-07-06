<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlosarioController extends Controller
{

	public function index()
	{
		return view('glosario/encuestaGlosario');
	}

}

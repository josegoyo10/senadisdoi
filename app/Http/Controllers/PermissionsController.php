<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Permission;
use Auth;
use Request;
use Hashids;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions    = new Permission;
        $formAction = action('PermissionsController@store');
        return view("permissions.form", compact('permissions', 'formAction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->saveData();
        return redirect("permissions")->with('success', 'Registro guardado correctamente');
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
        $decode = Hashids::decode($id)[0];
        $permissions = Permission::find($decode);
        $formAction = action('PermissionsController@update', $id);
        return view("permissions/form", compact('permissions', 'formAction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $decode = Hashids::decode($id)[0];
        $this->saveData($decode);
        return redirect("permissions")->with('success', 'Registro guardado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decode = Hashids::decode($id)[0];
        $permissions = Permission::findOrFail($decode);
        $permissions->delete();
        return redirect("permissions")->with('success', 'Registro borrado correctamente');
    }

    public function saveData($id = null)
    {
        $permissions          = ($id) ? Permission::find($id) : new Permission;
        $permissions->name    = Request::get('name');
        $permissions->display_name =Request::get('display_name');
        $permissions->description = Request::get('description');
        $permissions->save();
    }
}

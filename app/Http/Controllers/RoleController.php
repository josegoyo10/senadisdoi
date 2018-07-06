<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Auth;
use Request;
use Hashids;

class RoleController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $roles = Role::all();
        $permission = Permission::all();
        return view('roles.index', compact('roles','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $role    = new Role;
        $formAction = action('RoleController@store');
        $permission = Permission::all();
        return view("roles.form", compact('role', 'formAction','permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->saveData();
        return redirect("roles")->with('success', 'Registro guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {

    	$decode = Hashids::decode($id)[0];
        $role = Role::find($decode);
        $permission = Permission::all();
        $formAction = action('RoleController@update', $id);
        return view("roles/form", compact('role', 'formAction','permission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
    	$decode = Hashids::decode($id)[0];
        $this->saveData($decode);

        return redirect("roles")->with('success', 'Registro guardado correctamente');
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
        $roles = Role::findOrFail($decode);
        $roles->delete();
        return redirect("roles")->with('success', 'Registro borrado correctamente');
    }

    /**
     * Save the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function saveData($id = null)
    {
        //dd(Request::get('permission'));
        $roles          = ($id) ? Role::find($id) : new Role;
        $roles->name    = Request::get('name');
        $roles->display_name =Request::get('display_name');
        $roles->description = Request::get('description');

        $roles->save();

        foreach(Request::get('permission') as $row) {
            $roles->detachPermission($row);
        }
        foreach(Request::get('permission') as $row) {
            $roles->attachPermission($row);
        }

    }

}

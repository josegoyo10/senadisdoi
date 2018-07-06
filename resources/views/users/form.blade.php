@extends('adminlte::layouts.app')
@section('main-content')
<div class="container">
   <div class="row">
      <div class="col-md-10">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>Asignación de Permisos Usuarios</h2>
            </div>
            <div class="panel-body">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="box box-primary direct-chat direct-chat-primary">
                           <div class="box-header with-border">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="panel panel-default">
                                       <div class="panel-heading">Asignación de Permisos</div>
                                       <div class="panel-body">
                                          <form action="{{$formAction}}" enctype="multipart/form-data" method="post">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label>
                                                   Nombre de Usuario
                                                   </label>
                                                   <input class="form-control" name="name" type="text" value="@if($user->name){{ $user->name }} @endif">
                                                </div>
                                             </div>
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label>Roles</label>
                                                   <select class="form-control" name="role[]" multiple="multiple" multiple data-placeholder="Roles ...">
                                                      @foreach($roles as $role)
                                                      <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                      @endforeach
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 ">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                <button class="btn btn-primary waves-effect waves-light" id="enviar" type="submit" alt="Enviar">
                                                Enviar
                                                </button>
                                                  <a href="{{ url('users') }}" class="btn btn-primary" alt="Volver"> Volver</a>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@extends('adminlte::layouts.app')
@section('main-content')
@include('alerts.errors')
@include('alerts.success')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>Crear  Usuario </h2>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">Crear</div>
                                    <div class="panel-body">
                                       <form action="{{url('users')}}" enctype="multipart/form-data" method="post" autocomplete="off">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Nombre de Usuario
                                                </label>
                                                <input id="name" class="form-control" name="name" type="text" value="" placeholder="Nombre" required>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                E-mail
                                                </label>
                                                <input id="email" class="form-control" name="email" type="text" value="" placeholder="E-mail" required>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Institución - Municipalidad
                                                </label>
                                                <select  class="form-control" id="select-municipalidad" name="municipalidad" required>
                                                   @if(isset($instuciones))
                                                   <option value="" > -- Seleccione una opción -- </option>
                                                   @foreach($instuciones as $row)
                                                   <option value="{{ $row->id }}">{{ $row->nombre }}</option>
                                                   @endforeach
                                                   @endif
                                                </select>
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
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Password
                                                </label>
                                                <input id="password" class="form-control" name="password" type="password" value="" placeholder="password" required>
                                             </div>
                                          </div>
                                          <div class="col-sm-12">
                                             <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                             <button class="btn btn-primary waves-effect waves-light" id="enviar" type="submit" alt="Guardar">
                                             Guardar
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
            <!--panel-body!-->
         </div>
         <!--panel panel-default!-->
      </div>
      <!--col-md-10 col-md-offset-1!-->
   </div>
   <!--row !-->
</div>
<!--container !-->
@endsection
@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>Modificar datos Usuario </h2>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                           @include('alerts.success')
                           @include('alerts.errors')
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">Modificar Usuario</div>
                                    <div class="panel-body">
                                       <form action="{{url('usuarios/'. Hashids::encode($user->id) .'/update')}}" enctype="multipart/form-data" method="post" autocomplete="off">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Nombre de Usuario
                                                </label>
                                                <input class="form-control" name="name" type="text" value="{{$user->name}}" placeholder="Nombre" required>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                E-mail
                                                </label>
                                                <input class="form-control" name="email" type="text" value="{{$user->email}}" placeholder="E-mail" required>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Institución - Municipalidad
                                                </label>
                                                <select  class="form-control" id="select-municipalidad" name="municipalidad" required >
                                                   @if(isset($instituciones))
                                                   <option value="" > -- Seleccione una opción -- </option>
                                                   @foreach($instituciones as $row)
                                                   <option 
                                                   @if ($user->instituciones_id == $row->id)
                                                   {{ " selected " }}
                                                   @endif
                                                   value="{{ $row->id }}" >{{ $row->nombre }}
                                                   </option>
                                                   @endforeach
                                                   @endif
                                                </select>
                                             </div>
                                          </div>
                                          <!-- Resetear Clave-->
                                          <div class="col-sm-12">
                                             <input name="id" type="hidden" value="{{ $user->id }}">
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
         </div>
      </div>
   </div>
</div>
@endsection
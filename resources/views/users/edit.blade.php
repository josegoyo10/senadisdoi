@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-10">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>Modificar datos Usuario </h2>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-10">
                     <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="panel panel-default">
                                    <div class="panel-heading">Modific</div>
                                    <div class="panel-body">
                                       <form action="{{url('users')}}" enctype="multipart/form-data" method="post">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Nombre de Usuario
                                                </label>
                                                <input class="form-control" name="name" type="text" value="" placeholder="Nombre" required>
                                               
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Email
                                                </label>
                                                <input class="form-control" name="email" type="text" value="" placeholder="Email" required>
                                                
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>
                                                Password
                                                </label>
                                                <input class="form-control" name="password" type="password" value="" placeholder="password" required>
                                              
                                             </div>
                                          </div>
                                          <div class="col-sm-12">
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
@endsection
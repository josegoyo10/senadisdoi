@extends('adminlte::layouts.app')
@section('main-content')
<ol class="breadcrumb">
  <li><a href="/">Inicio</a></li>
  <li><a href="/formulario-encuesta/">Listado de encuestas</a></li>
  <li><a href="/formulario-encuesta/{!! $id_encuesta !!}">Editar encuesta</a></li>
  <li class="active">Nuevo factor</li>
</ol>
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>Nuevo factor</h2>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                           @include('alerts.success')
                           @include('alerts.errors')
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              {{ Form::open(array('route' => array('factores-encuesta.store'), 'method' => 'POST','id'=>'frm', 'data-toggle'=>'validator', 'role'=>'form')) }}
                              <input name="_token" type="hidden" value="{{ csrf_token() }}">

                              <input name="dimensiones_id" type="hidden" value="{{$id_dimension}}">
                              <input name="encuentas_id" type="hidden" value="{{$id_encuesta}}">

                              <div class="form-group">
                                 <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre" name="nombre" value ="" required maxlength="255">
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                              <br><br><br>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-primary col-md-offset-4" id="enviar_dimension" alt="Guardar">Guardar</button>
                                 <a href="/formulario-encuesta/{{$id_encuesta}}" class="btn btn-primary" alt="Salir">Salir</a>
                                 {{ Form::close() }}
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

<script type="text/javascript">
$("#frm").validator();
</script>
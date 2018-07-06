@extends('adminlte::layouts.app')
@section('main-content')
   <ol class="breadcrumb">
      <li><a href="/">Inicio</a></li>
      <li><a href="/formulario-encuesta">Listado de encuestas</a></li>
      <li class="active">Editar nombre de la encuesta</li>
   </ol>
   <div class="container-fluid spark-screen">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h2>Editar nombre de la encuesta</h2>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                              @include('alerts.success')
                              @include('alerts.errors')                          
                     </div>
                     <div class="col-md-12">
                        {!! Form::model($encuesta, ['route' => ['formulario-encuesta.update',$encuesta->id], 'method' => 'PUT', 'id'=>'frm', 'data-toggle'=>'validator', 'role'=>'form']) !!}
                           <div class="form-group">
                              <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                              <div class="col-sm-10"> 
                                 <input value="{!! $encuesta->nombre !!}" type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                                  <div class="help-block with-errors"></div>
                              </div>
                           </div>
                          <button type="submit" class="btn btn-primary" id="enviar_ficha" alt="Guardar">Guardar</button>
                          <a href="/formulario-encuesta" class="btn btn-primary" alt="Salir">Salir</a>
                        {!! Form::close() !!}
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
   $("#frm").validator()
</script>
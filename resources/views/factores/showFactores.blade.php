@extends('adminlte::layouts.app')
@section('main-content')

 <div class="container-fluid spark-screen">
  <ol class="breadcrumb">
    <li><a href="/">Inicio</a></li>
    <li><a href="/formulario-encuesta/">Listado de encuestas</a></li>
    <li><a href="/formulario-encuesta/{!! $id_encuesta !!}">Editar encuesta</a></li>
    <li class="active">Modificar factor</li>
  </ol>
  <div class="container-fluid spark-screen">
     <div class="row">
        <div class="col-md-10 col-md-offset-1">
           <div class="panel panel-default">
              <div class="panel-heading">
                 Encuesta:  {!! $nombre_encuesta !!}<br>
                 Dimensión: {!! $nombre_dimension !!}<br>
                 <h3>Modificar factor - {{$factor->nombre}}</h3>
              </div>
              <div class="panel-body">
                 <div class="row">
                    <div class="col-md-12">
                       <div class="box box-primary direct-chat direct-chat-primary">
                          <div class="box-header with-border">
                             @include('alerts.success')
                             @include('alerts.errors')
                          </div>
                          
                           <?php
                                $checked = "";
                                
                            ?>
                         
                          @if($accion == "Editar")
                              @if ($edit_pregunta[0]->req_medio_verificacion === 1)
                                 <?php  $checked = "checked "; ?>
                                 
                             @elseif ($edit_pregunta[0]->req_medio_verificacion === 0)
                                 <?php  $checked = " " ; ?>
                             @endif

                            <div class="row">
                             <div class="col-md-12">
                                <form id="frm" action="{{ url('pregunta-encuesta/actualizar/'.$edit_pregunta[0]->id.'/'.$factor->id.'/'.$id_encuesta) }}" class="form-horizontal" method="POST" enctype="multipart/form-data"  data-toggle="validator" role="form">
                                   <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                   
                                   <div class="form-group">
                                      <label class="control-label col-sm-2" for="nombre">Pregunta Nro:</label>  
                                      <div class="col-sm-10">
                                         <input type="text" class="form-control" id="preg" name="preg" value ="{{$cont_preg}}" disabled>
                                         <div class="help-block with-errors"></div>
                                      </div>
                                   </div>
                                  
                                   <div class="form-group">
                                      <label class="control-label col-sm-2" for="pregunta">Preguntas:</label> 
                                      <div class="col-sm-10">
                                         <textarea class="form-control" rows="5" id="desc_pregunta"
                                            name="desc_pregunta" value="{{$edit_pregunta[0]->desc_pregunta}}" required>{{$edit_pregunta[0]->desc_pregunta}}</textarea>
                                         <div class="help-block with-errors"></div>
                                      </div>
                                   </div>
                                   <div class="form-group">
                                      <label class="control-label col-sm-2" for="nombre">Valor Ponderador:</label>  
                                      <div class="col-sm-2">
                                         <input type="text" class="form-control" id="ponderador" name="ponderador" onkeydown="return(validarDecimal(this))"  required max="2" maxlength="2" value ="{{$edit_pregunta[0]->ponderador}}" >
                                         <div class="help-block with-errors"></div>
                                      </div>
                                   </div>
                                   <div class="checkbox">
                                      <label>
                                      <input type="checkbox" name="req_medio_verificacion" value="1" {{$checked}}>
                                      Requiere documento adjunto
                                      </label>
                                   </div>
                                   <br>
                                   <div class="form-group">
                                      <button type="submit" class="btn btn-primary col-md-offset-4" id="enviar_dimension" >Actualizar</button>
                                      <a href="/factores-encuesta/show/{{$factor->id}}/{{$id_encuesta}}" class="btn btn-primary">Volver</a>
                                   </div>
                               
                                   </form>
                                   <div class="row">
                                      <div class="col-md-12">
                                         @include("factores.listPreguntas")
                                      </div>
                                  </div>
                                </div>
                              </div>
                         
                          @else   
                          <div class="row">
                             <div class="col-md-12">
                                <form id="frm" action="{{ url('factores-pregunta/save/'.$factor->id.'/'.$id_encuesta) }}" class="form-horizontal" method="POST" enctype="multipart/form-data"  data-toggle="validator" role="form">
                                   <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                   
                                  
                                   <div class="form-group">
                                      <label class="control-label col-sm-2" for="pregunta">Pregunta:</label> 
                                      <div class="col-sm-8">
                                         <textarea class="form-control" rows="5" id="desc_pregunta"
                                            name="desc_pregunta" required></textarea>
                                         <div class="help-block with-errors"></div>
                                      </div>
                                   </div>
                                   <div class="form-group">
                                      <label class="control-label col-sm-2" for="nombre">Valor Ponderador:</label>  
                                      <div class="col-sm-2">
                                         <input type="text" class="form-control" id="ponderador" name="ponderador" value ="" required max="2" maxlength="2" onkeydown="return(validarDecimal(this))">
                                         <div class="help-block with-errors"></div>
                                      </div>
                                   </div>
                                   <div class="checkbox">
                                      <label>
                                      <input type="checkbox" name="req_medio_verificacion" value="1">
                                      Requiere documento adjunto
                                      </label>
                                   </div>
                                   <br>
                                   <div class="form-group">
                                      <button type="submit" class="btn btn-primary col-md-offset-4" id="enviar_dimension" alt="Agregar">Agregar</button>
                                      <a href="/formulario-encuesta/{{$id_encuesta}}" class="btn btn-primary" alt="Salir">Salir</a>
                                   </div>
                               
                                   </form>
                                   <div class="row">
                                      <div class="col-md-12">
                                         @include("factores.listPreguntas")
                                      </div>
                                  </div>
                             </div>
                          </div>
                       @endif
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
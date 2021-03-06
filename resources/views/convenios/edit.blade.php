@extends('adminlte::layouts.app')
@section('main-content')
   <ol class="breadcrumb">
      <li><a href="/">Inicio</a></li>
      <li><a href="/convenios">Listado de convenios</a></li>
      <li class="active">Editar convenio</li>
   </ol>
   <div class="container-fluid spark-screen">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h2>Editar convenio</h2>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
                              @include('alerts.success')
                              @include('alerts.errors')                          
                     </div>
                     <div class="col-md-12">
                        {!! Form::model($convenio, ['route' => ['convenios.update',$convenio->id], 'method' => 'PUT', 'id'=>'frm', 'data-toggle'=>'validator', 'role'=>'form', 'class' => 'form-horizontal']) !!}
                              <div class="form-group">
                                 <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                                 <div class="col-sm-10"> 
                                    <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="Ingrese el nombre del convenio" 
                                       required maxlength="255"
                                       value="{{ $convenio->nombre }}">
                                     <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="control-label col-sm-2" for="encuestas_id">Encuesta:</label>
                                 <div class="col-sm-10">
                                     
                                   <select class="form-control" name="encuestas_id" required>
                                     @if ($encuestas->count())
                                           <option value=" ">&laquo&laquo SELECCIONE &raquo&raquo</option>
                                         @foreach($encuestas as $row)
                                           <option value="{{$row->id}}"
                                                @if ($convenio->encuestas_id == $row->id)
                                                   {!! " selected " !!}
                                                @endif
                                           >{{$row->nombre }}</option>
                                         @endforeach
                                     @endif
                                     <div class="help-block with-errors"></div>
                                   </select>
                                  
                                </div> 
                              </div>
                               <div class="form-group">
                                 <label class="control-label col-sm-2" for="inicio_primera_aplicacion">Inicio 1era Aplicación:</label>
                                 <div class="col-sm-3"> 
                                   <input type="text" name="inicio_primera_aplicacion" 
                                    value="{!! substr($convenio->periodo[0]->fecha_inicio, 0, 10) !!}" 
                                    id="inicio_primera_aplicacion" readonly="readonly" required maxlength="10" class="form-control" />
                                   <div class="help-block with-errors"></div>
                                 </div>
                                 <div class="col-sm-1">
                                   <img src="/img/calendario.png" id="calendario_inicio_primera_aplicacion" />
                                 </div>
                                 <label class="control-label col-sm-2" for="fin_primera_aplicacion">Fin 1era Aplicación:</label>
                                 <div class="col-sm-3"> 
                                   <input type="text" name="fin_primera_aplicacion" 
                                   value="{!! substr($convenio->periodo[0]->fecha_fin, 0, 10) !!}" 
                                   id="fin_primera_aplicacion" readonly="readonly" required class="form-control" maxlength="10" />
                                   <div class="help-block with-errors"></div>
                                 </div>
                                 <div class="col-sm-1">
                                   <img src="/img/calendario.png" id="calendario_fin_primera_aplicacion" />
                                 </div>
                              </div>
                             <div class="form-group">
                                 <label class="control-label col-sm-2" for="inicio_segunda_aplicacion">Inicio 2da Aplicación:</label>
                                 <div class="col-sm-3"> 
                                   <input type="text" name="inicio_segunda_aplicacion" 
                                   value="{!! substr($convenio->periodo[1]->fecha_inicio, 0, 10) !!}" id="inicio_segunda_aplicacion" readonly="readonly" required class="form-control" maxlength="10"/>
                                   <div class="help-block with-errors"></div>
                                 </div>
                                 <div class="col-sm-1">
                                   <img src="/img/calendario.png" id="calendario_inicio_segunda_aplicacion" />
                                 </div>
                                 <label class="control-label col-sm-2" for="fin_segunda_aplicacion">Fin 2da Aplicación:</label>
                                 <div class="col-sm-3"> 
                                     <input type="text" name="fin_segunda_aplicacion" 
                                     value="{!! substr($convenio->periodo[1]->fecha_fin, 0, 10) !!}" 
                                     id="fin_segunda_aplicacion" readonly="readonly" required maxlength="10" class="form-control" />
                                     <div class="help-block with-errors"></div>
                                 </div>
                                 <div class="col-sm-1 pull-left"> 
                                   <img src="/img/calendario.png" id="calendario_fin_segunda_aplicacion" />
                                 </div>
                             </div>
                                   <div class="form-group">
                                        <div class="col-md-12">     
                                             <table class="table table-striped">
                                                <div class="container">
                                                   <thead>
                                                      <tr>
                                                         <th style="font-size:13px;" class="text-center"> </th>
                                                         <th style="font-size:13px;" class="text-left">Seleccione las municipalidades</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      @foreach($instituciones as $row)
                                                      <tr> 
                                                         <td style="font-size:13px;" class="text-right"> 
                                                            <input class="field" name="convenio_institucion[]" 
                                                            @if ($convenio->instituciones->where('id', $row->id)->count() > 0 )
                                                               checked 
                                                            @endif 
                                                            type="checkbox" value="{{ $row->id }}">
                                                         </td>
                                                         <td style="font-size:13px;" class="text-left">
                                                            {{ $row->nombre }}
                                                         </td>
                                                      </tr>
                                                      @endforeach
                                                   </tbody>
                                             </table>
                                       </div>
                                       <div class="col-md-12">
                                          <button type="submit" class="btn btn-primary" id="enviar_ficha" >Guardar</button>
                                          <a href="/convenios" class="btn btn-primary" alt="Salir">Salir</a>
                                       </div>
                                     </div>

                              {!! Form::close() !!}
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

<!----Js para el modulo de Convenios !-->
<script src="/js/convenios/validaciones_convenios.js"></script>
@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h2>Listado de convenios</h2>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="box box-primary direct-chat direct-chat-primary">
                     <div class="box-header with-border">
                        @include('alerts.success')
                        @include('alerts.errors')
                        <div class="row">
                           <div style="text-align: right; margin-right: 50px;">
                              @include("convenios.new")
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="box-body with-border">
                           <div class="col-md-12">
                              <table class="table table-striped">
                                 <div class="container">
                                    <thead>
                                       <tr>
                                          <th style="font-size:13px;">Convenio</th>
                                          <th style="font-size:13px;">Encuesta</th>
                                          <th style="font-size:13px;">Inicio 1era Aplicación</th>
                                          <th style="font-size:13px;">Fin 1era Aplicación</th>
                                          <th style="font-size:13px;">Inicio 2da Aplicación</th>
                                          <th style="font-size:13px;">Fin 2da Aplicación</th>
                                          <th style="font-size:13px;">Acciones</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($convenios as $row)
                                       <tr> 
                                          <td style="font-size:13px;"> {{$row->nombre}}</td>
                                          <td style="font-size:13px;"> {{ $row->encuestas['nombre'] }}</td>
                                          @foreach($row->periodo AS $row_periodo)
                                             <td style="font-size:13px;"> {{ date('d/m/Y',strtotime($row_periodo->fecha_inicio))  }}</td>
                                             <td style="font-size:13px;"> {{ date('d/m/Y',strtotime($row_periodo->fecha_fin))  }}</td>
                                          @endforeach
                                          <td>
                                             <div class="col-md-1">
                                                <a id="editar" href="{!! url('convenios/'.$row->id.'/edit') !!} " class="btn btn-primary btn-xs" title="Editar">
                                                   <span class="glyphicon glyphicon-edit" style="height: 15px;" aria-hidden="true"></span>
                                                </a>                                              
                                             </div>
                                             <div class="col-md-1">
                                                {!!Form::open(['route'=>['convenios.destroy', $row->id], 'method' => 'DELETE'])!!}
                                                   <button type="submit" class="btn btn-danger btn-xs" 
                                                      onclick='return confirm("¿Desea eliminar el convenio?")'; title="Eliminar">
                                                      <i class="glyphicon glyphicon-trash" style="height: 15px; aria-hidden="true"></i>
                                                   </button>
                                                {!!Form::close()!!}                                                
                                             </div>
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                              </table>
                           </div>
                     </div>
                  </div>
                     </div>
               {{ $convenios->links() }}
            </div>

         </div>
      </div>
         
   </div>

</div>

</div>

</div>
 
@endsection 

<!----Js para el modulo de Convenios !-->
<script src="/js/convenios/validaciones_convenios.js"></script>
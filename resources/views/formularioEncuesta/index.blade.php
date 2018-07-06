@extends('adminlte::layouts.app')
@section('main-content')
<ol class="breadcrumb">
  <li><a href="/">Inicio</a></li>
  <li class="active">Listado de encuestas</li>
</ol>
<div class="container-fluid spark-screen">
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h2>Listado de encuestas</h2>
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
                              @include("formularioEncuesta.newEncuesta")
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
                                          <th>Encuesta</th>
                                          <th>Convenio</th>
                                          <th>Creado por</th>
                                          <th>Creación</th>
                                          {{-- <th>Modificado</th> --}}
                                          <th style="width: 15%">Acciones</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($encuesta as $row)
                                       <tr> 
                                          <td> {!! $row->nombre !!}</td>
                                          <td>
                                             @if ($row->convenios->count() <= 0)
                                                {!! "-No esta asociada a ningun convenio-" !!}
                                             @endif
                                             @foreach($row->convenios AS $row_convenio)
                                                {!! $row_convenio->nombre !!}
                                             @endforeach
                                          </td>
                                          <td>
                                             @if (($row->users_id))
                                                {!! $row->users->name !!}
                                             @endif
                                          </td>
                                          <td> 
                                             @if (!is_null($row->created_at))
                                                {!! $row->created_at->format('d/m/Y') !!}
                                             @endif
                                          </td>
                                          {{-- <td>
                                             @if (!is_null($row->updated_at))
                                                {!! $row->updated_at->format('d/m/Y H:i') !!}
                                             @endif
                                          </td> --}}
                                          <td>
                                             <!-- Acciones -->
                                             <div class="col-md-1">
                                                <a id="ver" href="{!! url('formulario-encuesta/'.$row->id) !!} " class="btn btn-primary btn-xs" title="Editar la encuesta" alt="Editar la encuesta">
                                                   <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                </a>
                                             </div>
                                             <div class="col-md-1">
                                                <a id="editar" href="{!! url('formulario-encuesta/'.$row->id.'/edit') !!} " class="btn btn-primary btn-xs" title="Editar nombre" alt="Editar nombre">
                                                   <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                </a>                                              
                                             </div>
                                             <div class="col-md-1">
                                                {!!Form::open(['route'=>['formulario-encuesta.destroy', $row->id], 'method' => 'DELETE'])!!}
                                                   <button type="submit" class="btn btn-danger btn-xs" 
                                                      onclick='return confirm("¿Desea eliminar la encuesta con todos sus dimensiones, factores y preguntas?")'; alt="Eliminar" title="Eliminar">
                                                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
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
               {!!  $encuesta->links()  !!} 
            </div>

         </div>
      </div>
         
   </div>

</div>

</div>

</div>
 
@endsection 
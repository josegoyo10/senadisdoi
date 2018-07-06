@extends('adminlte::layouts.app')
@section('main-content')
<ol class="breadcrumb">
  <li><a href="/">Inicio</a></li>
  <li><a href="/formulario-encuesta/">Listado de encuestas</a></li>
  <li class="active">Editar encuesta</li>
</ol>
<div class="container-fluid spark-screen">
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h2>{!! $encuesta->nombre !!} - Editar encuesta</h2>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="box box-primary direct-chat direct-chat-primary">
                     <div class="box-header with-border">
                        @include('alerts.success')
                        @include('alerts.errors')
                        <a id="editar" href="{!! url('formulario-encuesta') !!} " class="btn btn-primary btn pull-right" title="Volver" alt="Volver">
                           <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                           Volver
                        </a>
                     </div>
                     <div class="row">
                        <div class="box-body with-border">
                           <div class="col-md-12">
                              <table class="table">
                                 <div class="container">
                                    <thead>
                                       <tr>
                                          <th>
                                             {{-- Crear dimensión --}}
                                             Dimensión
                                             <a id="nueva_dimension" href="{!! url('dimension/create/'.$encuesta->id) !!} " class="btn btn-primary btn-xs" title="Agregar nueva dimensión" alt="Agregar nueva dimensión">
                                             <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                             </a> 
                                          </th>
                                          <th class="row-striped">Factor</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($encuesta->dimension AS $dimension)
                                       <tr>
                                          <td rowspan="{!! count($dimension->factor) + 1 !!}">
                                             <div class="col-md-8">
                                                {!! $dimension->nombre !!}
                                             </div>
                                             {{-- Eliminar dimensión --}}
                                             <div class="col-md-1 pull-right">
                                                {!! Form::open(['route'=>['dimension.destroy', $dimension->id. '/' .$dimension->encuentas_id], 'method' => 'DELETE']) !!}
                                                <button type="submit" class="btn btn-danger btn-xs" 
                                                   onclick='return confirm("¿Desea eliminar el registro con todos sus factores y preguntas?")'; title="Eliminar dimensión" alt="Eliminar dimensión">
                                                <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                </button>
                                                {!! Form::close() !!}                                                
                                             </div>
                                             {{-- Editar dimensión --}}
                                             <div class="col-md-1 pull-right">
                                                <a id="editar" href="{!! url('dimension/'.$dimension->id.'/edit') !!} " class="btn btn-primary btn-xs" title="Editar dimensión" alt="Editar dimensión">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                </a>                                              
                                             </div>
                                          </td>
                                          <td>
                                             {{-- Agregar factor --}}
                                             <div class="pull-right">
                                                <a id="editar" href="{!! url('factor/create/'.$dimension->id. '/' .$dimension->encuentas_id) !!} " class="btn btn-primary btn-xs" alt="Agregar factor a la dimensión" title="Agregar factor a la dimensión">
                                                Factor  
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                </a>
                                             </div>
                                          </td>
                                       </tr>
                                       @foreach ($dimension->factor AS $factor)
                                       <tr>
                                          <td>
                                             @include ("formularioEncuesta.factor")
                                          </td>
                                       </tr>
                                       @endforeach
                                       @endforeach
                                    </tbody>
                              </table>
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
@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>
                  <span><b>Porcentaje Factor por Municipalidad</b>
                  </span>
               </h2>
            </div>
            <br>
            @include('alerts.warningReporte')
            @include('alerts.success')
            @include('alerts.errors')
            <form action="{{ url('reportes/factor_municipalidad_btn') }}" class="form-horizontal" method="POST" id="frm_reporte_factor_municipalidad">
               <input type="hidden" name="_token" value="{!! csrf_token() !!}">
               <div class="row">
                <div class="col-md-2">
                   <p class="form_dimension"><b>Regiones:</b></p>
                </div>
                <div class="col-md-8">
                   <select class="form-control" name="regiones">
                    <option value="0">&laquo&laquo TODOS &raquo&raquo</option>
                      @foreach($regiones as $row)
                        @if ($id_combo_regiones == $row->id)
                            <option value="{{ $row->id }}" selected>
                              {{ $row->region_numero_romano. ' - '. $row->nombre_region }}
                            </option>
                      @else
                            <option value="{{ $row->id }}">
                              {{ $row->region_numero_romano. ' - '. $row->nombre_region }}
                            </option>
                      @endif
                                                
                     @endforeach
                   </select>
                   <br>
                </div>
          
              </div> 

               <div class="row">
                  <div class="col-md-2">
                     <p class="form_dimension"><b>Período:</b></p>
                  </div>
                  @php
                  $id_periodo = ((integer)Session::get('id_combo'));
                  $id_factores = ((integer)Session::get('id_factor'));
                  @endphp
                 
                  <div class="col-md-8">
                     <select class="form-control" name="periodo_id">
                        <option value="0">&laquo&laquo SELECCIONE &raquo&raquo</option>
                        @foreach($convenios as $row)
                        @if ($id_combo == $row->id)
                        <option value="{{ $row->id }}" selected>{{ $row->aplicacion }}</option>
                        @else
                        <option value="{{ $row->id }}">{{  $row->aplicacion }}</option>
                        @endif
                        @endforeach
                     </select>
                     <br>
                  </div>
                 
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <p class="form_dimension"><b>Factores:</b></p>
                  </div>
                 
                  <div class="col-md-8">
                     <select class="form-control target" name="factor_id">
                         <option value="0">&laquo&laquo SELECCIONE &raquo&raquo</option>
                        @foreach($factores as $row)
                        @if ($id_factor == $row->nombre)
                        <option value="{{ $row->nombre }}" selected>{{ $row->nombre }}</option>
                        @else
                        <option value="{{ $row->nombre}}">{{$row->nombre }}</option>
                        @endif
                        @endforeach
                     </select>
                     <br>
                  </div>
                  
               </div>
               <div class="row">
                  <div class="col-md-2 col-md-offset-5">
                      <button type="button" class="btn btn-primary" onclick="ajax_reporte('reportes_ajax/factor_municipalidad','grafica-div','frm_reporte_factor_municipalidad','container_factor_municipalidad');" alt="Enviar">Enviar</button>
                  </div>
               </div>
            </form>
            <br><br>
            <div class="row">
               <div class="col-md-12">
                <div id="container_factor_municipalidad" style="min-width: 300px; height: 400px; margin: 0 auto">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
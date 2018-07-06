@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>
                  
                  <span><b>Porcentaje IMDIS Municipios EDLI</b>
                  </span>
               </h2>
            </div>
            <br>
            @include('alerts.warningReporte')
            @include('alerts.success')
            @include('alerts.errors')

            <form action="{{ url('reportes/porcentaje') }}" class="form-horizontal" method="POST" id="frm_reporte_factores">
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

                  <div class="col-md-8">

                     <select class="form-control" name="convenio_id">
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
                  <div class="col-md-6 col-md-offset-5">
                     <button type="button" class="btn btn-primary" onclick="ajax_reporte('reportes_ajax/porcentaje','grafica-div','frm_reporte_factores','container_municipios');" alt="Enviar">Enviar</button>
                  </div>
                </div>
            </form>
          
            <br>
          <div id="container_municipios" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
      
       
           </div>
         </div>
      </div>
   </div>

@endsection

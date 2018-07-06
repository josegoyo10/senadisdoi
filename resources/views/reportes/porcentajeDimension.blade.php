@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>
                <span>
                  <b>Porcentaje de cumplimiento por Dimensión a Nivel Nacional</b>
                </span>
               </h2>
            </div>
            <br>
            @include('alerts.warningReporte')
            @include('alerts.success')
            @include('alerts.errors')
            <form action="{{ url('reportes/cumplimiento_dimension_btn') }}" class="form-horizontal" method="POST" id="frm_reporte_cumplimiento">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="row">
                  <div class="col-md-3">
                     <p class="form_dimension"><b>Regiones:</b></p>
                  </div>
                  <div class="col-md-6">
                     <select class="form-control" name="regiones">
                      <option value=" ">&laquo&laquo TODOS &raquo&raquo</option>
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
                  
                 <div class="col-md-3">
                     <p class="form_dimension"><b>Período:</b></p>
                  </div>

                  <div class="col-md-6">

                     <select class="form-control" name="convenio_id">
                      <option value=" ">&laquo&laquo SELECCIONE &raquo&raquo</option>
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
                  <div class="row">
                    <div class="col-md-10 col-md-offset-4">
                     <!--button type="submit" class="btn btn-primary">Enviar</button!-->
                      <button type="button" class="btn btn-primary" onclick="ajax_reporte('reportes_ajax/cumplimiento_dimension','grafica-div','frm_reporte_cumplimiento','container_cumplimiento_dimension');" alt="Enviar">Enviar</button>
                    </div>
                  </div>
              </div>
            </form>
            <br>
            
          {{--   <div class="row">
               <div class="col-md-10 col-md-offset-1">
                  <div id="chart-div"></div>
                 {!! $lava->render('BarChart', 'Grafica', 'chart-div') !!}
               </div>
            </div> --}}
             <div class="row">
              <div id="container_cumplimiento_dimension" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
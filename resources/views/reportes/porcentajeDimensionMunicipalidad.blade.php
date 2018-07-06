@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h2>                     
                  <span><b>Porcentaje Dimensión por Municipalidad</b>
                  </span>
               </h2>
            </div>
            <br>
            @include('alerts.warningReporte')
            @include('alerts.success')
            @include('alerts.errors')
          

           @php

              if (($id_periodo == "") OR ($id_combo == "")){
                 $id_periodo = \Session::get('id_periodo');
                $id_combo = \Session::get('id_combo');

              }
    
          @endphp
              
            <form action="{{ url('reportes/dimension_municipalidad_btn') }}" class="form-horizontal" method="POST" id="frm_reporte_dimension_municipalidad">
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
                     <select class="form-control" name="periodo_id">

                        <option value="0">&laquo&laquo SELECCIONE &raquo&raquo</option>
                  
                        @foreach($convenios as $row)
                            
                        @if ($id_periodo == $row->id)
                        
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
                     <p class="form_dimension"><b>Dimensión:</b></p>
                  </div>
                  <div class="col-md-8">
                        
                     <select class="form-control" name="dimension_id">
                      <option value="0">&laquo&laquo SELECCIONE &raquo&raquo</option>
                        @foreach($dimensiones as $row)
                        
                        @if ($id_combo == $row->id)
                              <option value="{{ $row->id }}" selected>{{ $row->nombre }}</option>
                        @else
                              <option value="{{ $row->id }}">{{  $row->nombre }}</option>
                        @endif
                                                  
                       @endforeach
                     </select>
                     <br>
                  </div>
                </div>

                 <div class="row">
                     <div class="col-md-2 col-md-offset-5">
                        <!--button type="submit" class="btn btn-primary" id="btn_dimension">Enviar</button!-->
                         <button type="button" class="btn btn-primary" onclick="ajax_reporte('reportes_ajax/dimension_municipalidad','grafica-div','frm_reporte_dimension_municipalidad','container_dimension_municipalidad');" alt="Enviar">Enviar</button>
                     </div>
                 </div>
            </form>
             
            <br><br>
            <div class="row">
               <div class="col-md-11 col-md-offset-1">
               <div id="container_dimension_municipalidad" style="min-width: 400px; height: 500px; margin: 0 auto"></div>

                 {{--  <div id="chart_div_dimension"></div>
                  {!! $lava->render('ColumnChart', 'Grafica', 'chart_div_dimension') !!} --}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection


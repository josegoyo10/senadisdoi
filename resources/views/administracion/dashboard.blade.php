@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

  <?php

    $mensajes_sin_responder = \App\Mensajeria::getMensajesSinResponder();
    $cant_encuestas_enviadas = \App\EncuestaRespuesta::cantEncuestasEnviadas($id_periodo);
    $cant_encuestas_aceptadas = \App\EncuestaRespuesta::cantEncuestasAceptadas($id_periodo);
    $cant_encuestas_rechazadas = \App\EncuestaRespuesta::cantEncuestasRechazadas($id_periodo);
   ?>

  <section class="content">
  <div class="row">
  	<div class="col-md-10 col-md-offset-1">
  	    @include('alerts.errors')
      	@include('alerts.success')
  	</div>
    <br><br><br>

    <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('traduction.manage') }} </h3>
            </div>
            <div class="box-body">
             
              <a class="btn btn-app" href="{{ url('formulario-encuesta') }}" alt="Encuestas">
                <i class="fa fa-check-square-o"></i> {{ trans('traduction.polls') }}
              </a>
              <a class="btn btn-app" href="{{ url('convenios') }}" alt="Convenios">
                <i class="fa fa-play"></i> {{ trans('traduction.conventions') }} 
              </a>
              <a class="btn btn-app" href="{{ url('nueva-noticia') }}" alt="Noticias">
                <i class="fa fa-bullhorn"></i> {{ trans('traduction.news') }}
              </a>
              <a class="btn btn-app" href="{{ url('users') }}" alt="Usuarios">
                <i class="fa fa-user"></i> {{ trans('traduction.users') }}
              </a>
              <a class="btn btn-app" href="{{ url('institucion') }}" alt="Municipalidades">
                <i class="fa fa-building"></i> Municipalidades
              </a>
            </div>
            <!-- /.box-body -->
    </div>
  </div>

    <form action="{{ url('/') }}" class="form-horizontal" method="POST" id="frm">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="row">
            <div class="col-md-2">
              <p class="form_dimension"><b>Período:</b></p>
            </div>

            <div class="col-md-6">
              <select class="form-control" name="id_periodo" onChange="jumpSelect()">
                <option value="0">&laquo&laquo SELECCIONE &raquo&raquo</option>
                  @foreach($periodo as $row)
                    @if ($id_periodo == $row->id)
                      <option value="{{ $row->id }}" selected>{{ $row->aplicacion }}</option>
                    @else
                      <option value="{{ $row->id }}">{{  $row->aplicacion }}</option>
                    @endif
                  @endforeach
              </select>
              <br>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary" alt="Enviar">Enviar</button>
            </div>
        </div>
  </form>

  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $mensajes_sin_responder }}</h3>

              <p>Mensaje sin responder</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <?php
            // <a href="{{ url('mensajes') }}" class="small-box-footer">{{ trans('traduction.see_messages') }} <i class="fa fa-arrow-circle-right"></i></a>
            ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $cant_encuestas_enviadas }}<sup style="font-size: 20px"></sup></h3>

              <p>Encuestas enviadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <?php
            // <a href="#" class="small-box-footer">{{ trans('traduction.more_information') }} <i class="fa fa-arrow-circle-right"></i></a>
            ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $cant_encuestas_rechazadas }}</h3>

              <p>Encuestas rechazadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <?php
            // <a href="#" class="small-box-footer">{{ trans('traduction.more_information') }} <i class="fa fa-arrow-circle-right"></i></a>
            ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $cant_encuestas_aceptadas }}</h3>

              <p>Encuestas aceptadas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <?php
            // <a href="#" class="small-box-footer">{{ trans('traduction.more_information') }} <i class="fa fa-arrow-circle-right"></i></a>
            ?>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- Info boxes -->


        <!-- Datos de las encuestas -->

            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <div class="col-md-12">


                <!-- TABLA: ÚLTIMAS ENCUESTAS -->
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Encuestas respondidas</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                        <tr>
                          <th>Municipalidad</th>
                          <th>Convenio</th>
                          <th>Última modificación</th>
                          <th class="text-center">Avance</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($rs_encuestas) == 0)
                          <tr>
                            <td colspan="6" class="text-center">-- No existen registros para el período seleccionado --</td>
                          </tr>
                        @endif
                        @foreach ($rs_encuestas AS $row)
                        <tr>
                          <td>{{ $row->institucion }}</td>
                          <td>{{ $row->nombre_convenio }}</td>
                          <td>{{ $row->ultima_modificacion }}</td>
                          <td class="text-center">
                              <?php 
                                $porcentaje_avance = \App\EncuestaRespuesta::getPorcentajeAvanceEncuesta($row->id);
                              ?>
                              {{ $porcentaje_avance }}%
                              <div class="progress xs">
                                  <div class="progress-bar progress-bar-green" style="width: {{ $porcentaje_avance }}%;">
                                  </div>
                              </div>
                          </td>
                          <td>

                              @if ($row->id_estado_encuesta == 1)
                                <?php $label = "label-warning" /* Borrador */ ?>
                              @elseif ($row->id_estado_encuesta == 2)
                                <?php $label = "label-primary" /* Enviada */ ?>
                              @elseif ($row->id_estado_encuesta == 3)
                                <?php $label = "label-primary" /* En evaluacion */ ?>
                              @elseif ($row->id_estado_encuesta == 4)
                                <?php $label = "label-success" /* Aceptada */ ?>
                              @elseif ($row->id_estado_encuesta == 5)
                                <?php $label = "label-danger" /* Rechazada */ ?>
                              @elseif ($row->id_estado_encuesta == 6)
                                <?php $label = "label-warning" /* Rectificacion */ ?>
                              @endif


                              @if ($row->id_estado_encuesta == '')
                                {!! "<span class='label label-default'>- Sin iniciar -</span>" !!}
                              @else
                                {!! "<span class='label $label'>".$row->estado."</span>" !!}
                              @endif


                          </td>
                          <td>
                              @if ($row->estado == "Borrador" 
                                || $row->estado == "Rechazada"
                                || $row->estado == "Aceptada") 
                                <a id="enlace_ver_preguntas" name="enlace_ver_preguntas" href="{{URL::to('encuesta')}}?id={{ $row->id }}" alt="Ver" class="btn btn-primary btn-block">
                                  Ver</a>
                              @elseif ($row->estado == "Enviada")
                                <a id="enlace_ver_preguntas" name="enlace_ver_preguntas" href="{{URL::to('encuesta')}}?id={{ $row->id }}" alt="Validar" class="btn btn-primary btn-block">
                                  Validar</a>
                              @endif
                        
                              @if ($row->estado == "Enviada" || $row->estado == "Rechazada")  
                                <br>
                                <a id="enlace_reactivar" name="enlace_reactivar" href="{{URL::to('reactivar_encuesta')}}/{{ $row->id }}" alt="Reactivar" class="btn btn-primary btn-block">Reactivar</a>
                                <br>
                              @endif
                          </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer clearfix">

                  </div>
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->

          </div>
          <!-- /.row -->
    
  </section>
	
@endsection
<script language="JavaScript">
  <!--
  function jumpSelect(){
    $( "#frm" ).submit();
  }
  //-->
</script>
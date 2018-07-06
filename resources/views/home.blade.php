@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="col-md-10 col-md-offset-1">
	    @include('alerts.errors')
    	@include('alerts.success')
	</div>


	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="col-md-10 col-md-offset-1">
			@if(Auth::user()->hasRole('mncpld') OR Auth::user()->hasRole('oum'))
				<div class="panel panel-default">
					<div class="panel-heading"><h2>Encuestas Activas</h2></div>
					<div class="panel-body">
						<table class="table table-striped  table-hover table-condensed">
							<thead>
								<th>Nombre</th>
								<th>Última modificación</th>
								<th>Inicio período</th>
								<th>Fin período</th>
								<th>Estado encuesta</th>
								<th style="width: 90px;" class="text-center">Avance</th>
								<th style="width: 120px;" class="text-center">Acciones</th>
							</thead>
							<tbody>

								@if (!is_array($rs_encuestas))

									<tr>
 									<td colspan="7" class="text-center">-- Esta Institución no esta asociada a ningun convenio -- </td>
									</tr>
								@endif
								@foreach ($rs_encuestas as $row) 
									<tr>
										<td>{{ $row->nombre_periodo }} </td>
										<td>
											@if ($row->estado_encuesta == "" )
												{{ "--" }}
											@else
												{{ $row->updated_at }}
											@endif
										</td>
										<td>{{ $row->fecha_inicio }} </td>
										<td>{{ $row->fecha_fin }} </td>
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
												{!! "<span class='label $label'>".$row->estado_encuesta."</span>" !!}
											@endif

										</td>
										<td class="text-center">
											<?php 
												$porcentaje_avance = \App\EncuestaRespuesta::getPorcentajeAvanceEncuesta($row->id_encuesta_respuestas);
											?>
											{{ $porcentaje_avance }}%
											<div class="progress xs">
                    							<div class="progress-bar progress-bar-green" style="width: {{ $porcentaje_avance }}%;">
                    							</div>
						                  	</div>
										</td>
										<td class="text-center">
											@if ($row->estado_periodo == "CE" 
												|| $row->estado_encuesta == "Enviada" 
												|| $row->estado_encuesta == "Aceptada") 	
												<a id="enlace_ver_preguntas" name="enlace_ver_preguntas" alt="Ver" href="{{URL::to('encuesta')}}?id={{ $row->id_encuesta_respuestas }}" class="btn btn-primary btn-block">
												Ver</a>
											@elseif (($row->estado_encuesta == "Borrador" || $row->estado_periodo == "AB") && (!(Auth::user()->hasRole('oum'))))
												<a id="enlace_ver_preguntas" name="enlace_ver_preguntas" href="{{URL::to('encuesta')}}?id={{ $row->id_encuesta_respuestas }}" class="btn btn-primary" alt="Continuar">
												Continuar</a>
											@elseif ($row->estado_encuesta == "" )
												{{ " -- " }}
											@else 
                                                @if((!(Auth::user()->hasRole('oum'))))
												<a id="enlace_ver_preguntas" name="enlace_ver_preguntas" alt="Responder" href="{{URL::to('encuesta')}}" class="btn btn-primary">
												Responder</a>
                                                @endif

											@endif 
											
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

				<!-- Encuestas en las que participo -->
				<div class="panel panel-default">
					<div class="panel-heading"><h2>Encuestas Inactivas</h2></div>
					<div class="panel-body">
						<table class="table table-striped  table-hover table-condensed">
							<thead>
								<th>Nombre</th>
								<th>Última modificación</th>
								<th>Inicio período</th>
								<th>Fin período</th>
								<th>Estado encuesta</th>
								<th style="width: 90px;" class="text-center">Avance</th>
								<th style="width: 120px;" class="text-center">Acciones</th>
							</thead>
							<tbody>

								@if (!is_array($rs_encuestas_respondidas))

									<tr>
 									<td colspan="7" class="text-center">-- No se encontraron registros -- </td>
									</tr>
								@endif
								@foreach ($rs_encuestas_respondidas as $row) 
									<tr>
										<td>{{ $row->nombre_periodo }} </td>
										<td>
											{{ $row->updated_at }}
										</td>
										<td>{{ $row->fecha_inicio }} </td>
										<td>{{ $row->fecha_fin }} </td>
										<td>
											@if ($row->estados_encuesta_id == 1)
												<?php $label = "label-warning" /* Borrador */ ?>
											@elseif ($row->estados_encuesta_id == 2)
												<?php $label = "label-primary" /* Enviada */ ?>
											@elseif ($row->estados_encuesta_id == 3)
												<?php $label = "label-primary" /* En evaluacion */ ?>
											@elseif ($row->estados_encuesta_id == 4)
												<?php $label = "label-success" /* Aceptada */ ?>
											@elseif ($row->estados_encuesta_id == 5)
												<?php $label = "label-danger" /* Rechazada */ ?>
											@elseif ($row->estados_encuesta_id == 6)
												<?php $label = "label-warning" /* Rectificacion */ ?>
											@endif


											@if ($row->estados_encuesta_id == '')
												{!! "<span class='label label-default'>- Sin iniciar -</span>" !!}
											@else
												{!! "<span class='label $label'>".$row->estado_encuesta."</span>" !!}
											@endif
										</td>
										<td class="text-center">
											<?php 
												$porcentaje_avance = \App\EncuestaRespuesta::getPorcentajeAvanceEncuesta($row->id_encuesta_respuestas);
											?>
											{{ $porcentaje_avance }}%
											<div class="progress xs">
                    							<div class="progress-bar progress-bar-green" style="width: {{ $porcentaje_avance }}%;">
                    							</div>
						                  	</div>
										</td>
										<td class="text-center">
											@if ($row->estado_periodo == "CE" 
												|| $row->estado_encuesta == "Enviada" 
												|| $row->estado_encuesta == "Aceptada") 	
												<a id="enlace_ver_preguntas" name="enlace_ver_preguntas" alt="Ver" href="{{URL::to('encuesta')}}?id={{ $row->id_encuesta_respuestas }}" class="btn btn-primary btn-block">
												Ver</a>
											
											@elseif ($row->estado_encuesta == "" )
												{{ " -- " }}
											@else 
                                                @if((!(Auth::user()->hasRole('oum'))))
												<a id="enlace_ver_preguntas" name="enlace_ver_preguntas" alt="Responder" href="{{URL::to('encuesta')}}?id={{ $row->id_encuesta_respuestas }}" class="btn btn-primary">
												Ver</a>
                                                @endif

											@endif 
											
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<!-- Fin  -->



			@endif
				<br>
	@include ('noticias.showNoticiaUsuario')

@endsection

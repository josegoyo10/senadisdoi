@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

    <div class="container-fluid spark-screen">
        <div class="row">

            <div class="col-md-11 col-md-offset-1">
                <div class="a"></div>
                <div class="panel panel-default">

                    <div class="panel-heading"><em><h1><b>
                    Encuestas<br>
                    Indice de inclusi&oacute;n Municipal en Discapacidad (IMDIS)</b></h1></em></div>
                    <div class="panel-body">

                        @include('adminlte::forms.nav')

                        

            {!! Form::open(['url' => 'enviar_encuesta','method' => 'post','files'=> true,'id'=>'frm']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="periodos_id" value="1">
                <input type="hidden" name="encuesta_id" value="2">
                <input type="hidden" name="instituciones_id" value="1">
                <input type="hidden" name="total_preguntas" value="{{ count($preguntas) }}
                ">
                <input type="hidden" name="id_encuesta_enviar" value="<?php echo $_GET["id"] ?>">

                <br>
                @include('alerts.errors')
                @include('alerts.success')

                <div class="alert alert-warning">
                    Por favor verifique los datos antes de enviarlos. Luego presione el botón Confirmar Envio. <br>Recuerde que luego de enviado NO podrá modificar los datos.</li>
                </div>
                <div class="text-center">
                    <button id="btn_guardar_enviar" name="btn_guardar_enviar" class="btn btn-primary" type="submit" form="frm" value="enviar">Confirmar Envio</button>
                </div><br>

                <?php 
                // OJO incluir campo de personas
                // Cambiar en la base de datos
                // Cambiar en la BD las unidades
                ?>

                <div class="tab-content">
                    <?php
                    $pestana_activa = false;
                    ?>
                    @if (count($dimension) == 0)
                        <div class="text-center"></div><h3>-- No existen dimensiones registradas --</h3></div>
                    @endif
                @foreach ($dimension as $row_dimensiones)

                    <?php
                    if ($pestana_activa === false) {
                        $pestana_activa = true;
                        $clase_activa = "tab-pane active";
                    }else{
                        $clase_activa = "tab-pane";
                    }
                    ?>

                    <div id="dimension{{ $row_dimensiones->id }}" class="{{ $clase_activa }}">
                        <?php
                        $factores = \App\Factores::where('dimensiones_id', '=',$row_dimensiones->id)->get();
                        ?>

                        @include('encuesta.identificacionEvaluacionResumen')

                        @if (count($factores) == 0)
                            <div class="text-center"><h3>-- No existen factores registrados --</h3></div>
                        @else
                                @include('encuesta.graficasDimensiones')

                        @endif

                        @foreach ($factores as $row_factores)
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                  <h3 class="box-title">{{ $row_factores->nombre }}</h3>
                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <div class="row">
                                    <?php
                                    $preguntas = \App\Preguntas::where('factores_id', '=',$row_factores->id)->get();
                                    $cant_preg = \App\Preguntas::where('factores_id','=',$row_factores->id)->count();
                                    $num = 1;
                                    ?>
                                    <input type="hidden" name="cant_preg"  id="cant_preg" value={{$cant_preg}}>
                                    <table class="table table-striped  table-hover table-condensed" id="tbl_factores">
                                        <thead>
                                        <th> </th>
                                        <th>Preguntas</th>
                                        <th>Respuestas</th>
                                        <th>Poderación</th>
                                        <th>Observación</th>
                                        <th>Medio de verificación</th>

                                        </thead>
                                        <tbody>
                                        @if (count($preguntas) == 0)
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <h3>-- No existen preguntas registradas --</h3>
                                                </td>
                                            </tr>

                                        @endif
                                        @foreach ($preguntas as $row_preguntas)
                                            <tr>
                                                <td>{{ $num++ }})</td>
                                                <td>&iquest;{{ $row_preguntas->desc_pregunta }}?</td>
                                                <td>
                                                    <?php
                                                    $si_checked = "";
                                                    $no_checked = "";
                                                    $noaplica_checked = "";
                                                    $vacio_checked = "";
                                                    ?>
                                                    @foreach ($respuestas AS $row_respuestas)
                                                        @if ($row_preguntas->id == $row_respuestas->preguntas_id)
                                                            @if ($row_respuestas->valor == 1)
                                                                <?php $valor = " Si " ?>
                                                            @elseif ($row_respuestas->valor == 0)
                                                                <?php $valor = " No " ?>
                                                            @elseif ($row_respuestas->valor == 2)
                                                                <?php $valor = " No aplica " ?>
                                                            @else 
                                                                {{ "-- Verificar valor --" }}
                                                            @endif
                                                        @else
                                                        @endif
                                                    @endforeach
                                                    <label>
                                                    <label>
                                                        {{ $valor }}    
                                                    </label>                                        

                                                </td>
                                                <td class="text-center">{{ $row_preguntas->ponderador }}</td
                                                <td>
                                                    <?php $observacion = ""?>
                                                    @foreach ($respuestas AS $row_respuestas)
                                                        @if ($row_preguntas->id == $row_respuestas->preguntas_id)
                                                            <?php
                                                            $observacion = $row_respuestas->observacion
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                   
                                                    {{ $observacion }}

                                                </td>
                                                <td style="width: 50px;">
                                                    @if($row_preguntas->req_medio_verificacion)
                                                        
                                                         
                                                        @foreach ($respuestas AS $row_respuestas)
                                                            @if ($row_preguntas->id == $row_respuestas->preguntas_id)
                                                                <a href="/uploads/{{$row_respuestas->medio_verificacion }}" target="_new">{{$row_respuestas->medio_verificacion }}</a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                  </div>
                                  <!-- /.row -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                        @endforeach

                    </div>
                    @endforeach
                

                <br>
                <div class="col-md-10 col-md-offset-4">
                    <button id="btn_guardar_enviar" name="btn_guardar_enviar" class="btn btn-primary" type="submit" form="frm" value="enviar">Confirmar Envio</button>
                </div>
            </div>

            {!! Form::close() !!}


                    </div>
                    </div>
                </div>
            </div>
@endsection
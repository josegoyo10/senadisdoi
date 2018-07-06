@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Listado de mensajes </h2></div>
                    <div class="panel-body">
                        <!-- Direct Chat -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DIRECT CHAT PRIMARY -->
                                <div class="box box-primary direct-chat direct-chat-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Mensajes Encuesta #03456</h3>

                                        @include('alerts.success')

                                        @include('alerts.errors')

                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        {!! Form::open(array('url'=>'mensajes/' .$mesaje->id,'method'=>'PUT')) !!}
                                        <div class="input-group">
                                            <input type="text" id="message" name="message" placeholder="Escribe mensaje ..." value="{{$mesaje->mensajes}}" class="form-control">

                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat"  id="enviar_mesaje"  name="enviar_enviar_mensaje" alt="Modificar">Modificar</button>
                                              </span>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.box-footer-->
                                </div>
                                <!--/.direct-chat -->
                            </div>
                            <!-- /.col -->
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

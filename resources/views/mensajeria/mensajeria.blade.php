@extends('adminlte::layouts.app')

@section('main-content')
    @if(Auth::user()->hasRole('mncpld')||Auth::user()->hasRole('snds'))

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
                                    <!-- Modificacion -->
                                    <h3 class="box-title"> 
                                        @if(Auth::user()->hasRole('snds'))
                                            Usuario SENADIS 
                                        @elseif(Auth::user()->hasRole('mncpld')) 
                                            Usuario Municipal 
                                        @endif
                                    </h3>

                                    @include('alerts.success')

                                    @include('alerts.errors')

                                    <div class="box-tools pull-right">
                                        <span data-toggle="tooltip" title="{{$mensajes_total}} Mensajes {{$mensajes_sin_responder}} Sin responder" class="badge bg-light-blue">{{$mensajes_sin_responder}}</span>
                                    </div>
                                </div>
                                @if(!Auth::user()->hasRole('snds'))
                                    <div class="box-footer">
                                        {!! Form::open(array('url'=>'mensajes/','method'=>'POST')) !!}
                                            <div class="input-group">
                                                <input type="text" id="message" name="message" placeholder="Escribe mensaje ..." class="form-control">
                                                  <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-flat"  id="enviar_mesaje" name="enviar_enviar_mensaje" alt="Enviar">Enviar</button>
                                                  </span>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                                <!-- /.box-footer-->
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <!-- Conversations are loaded here -->
                                    <!--Modificacion de scroll 04.01.2017-->
                                    <div>
                                        <!-- Message. Default to the left -->

                                        @foreach ($mensajeria as $row)
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                @foreach($users as $usu)
                                                    @if($usu->id == $row->users_id)
                                                        <span class="direct-chat-name pull-left">{{ $usu->name}}</span>
                                                    @endif
                                                @endforeach
                                                    <span class="direct-chat-timestamp pull-right">{{$row->created_at}}</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img" src="{{asset('img/user2.jpg')}}" alt="Imagen de usuario"><!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    {{ $row->mensajes }}

                                                    <!-- Permiso administrador SENADIS -->
                                                    <br><br>
                                                    @if(Auth::user()->can('administrador-SENADIS'))
                                                        <div class="row">
                                                            <?php /*
                                                            <div class="col-md-1">
                                                                
                                                                <a href="{{ URL::to('mensajes/'.$row->id.'/edit')}}" class="btn btn-warning btn-xs" id="modificar">
                                                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                                    Editar
                                                                </a>
                                                                
                                                            </div>
                                                            <div class="col-md-1">
                                                                
                                                                {{ Form::open(array('url'=>'mensajes/' . $row->id,'method'=>'DELETE'))}}

                                                                <button  id="eliminar" type="submit" class="btn  btn-danger btn-xs" onclick='return confirm("Desea eliminar el registro?")'; title="Eliminar">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    Eliminar
                                                                </button>

                                                                {{ Form::close() }}
                                                            </div>
                                                            
                                                            */
                                                            ?>
                                                            <?php 
                                                            $clase_responder = "btn-primary";
                                                            ?>
                                                            @if ($row->mensaje_respuesta)
                                                                <?php 
                                                                    $clase_responder = "btn-default";
                                                                ?>
                                                            @endif

                                                            <?php 
                                                            // <div class="col-md-2 col-md-offset-8"> 
                                                            ?>
                                                            <div class="col-md-2">
                                                                <a href="{{ URL::to('mensajes/'.$row->id.'/responder')}}" class="btn {{$clase_responder}} btn-xs" id="modificar" alt="Responder">
                                                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                                    Responder
                                                                </a>
                                                            </div>
                                                        </div><!-- /.row  -->

                                                @endif
                                                </div>
                                                
                                                @if ($row->mensaje_respuesta)
                                                    <img class="direct-chat-img" src="{{asset('img/check_green.png')}}" style="width: 30px; height: 30px;" alt="Imagen de Usuario">
                                                    <div class="direct-chat-text direct-chat-text-respuesta">
                                                        Respuesta SENADIS: {{ $row->mensaje_respuesta }}
                                                    </div>
                                                @endif
                                                
                                            </div><!-- /.direct-chat-text -->
                                        @endforeach
                                        <!-- /.direct-chat-msg -->

                                    </div>
                                    <!--/.direct-chat-messages-->
                                    <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.box-body -->

                            </div>
                            <!--/.direct-chat -->
                        </div>
                        <!-- /.col -->
                    </div>

            </div>
        </div>
        <?php echo $mensajeria->appends($_GET)->render(); ?>

        </div>
        </div>
        </div>

    @endif
@endsection

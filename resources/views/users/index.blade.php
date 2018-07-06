@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Listado de Usuarios </h2></div>
                    <div class="panel-body">
                        <!-- Direct Chat -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary direct-chat direct-chat-primary">

                                    @include('alerts.success')
                                    @include('alerts.errors')

                                    <div class="box-header with-border">

                                                <!-- Busqueda -->

                                        <div class="">
                                            <tr>
                                                {!! Form::model(Request::all(), ['route'=>'users.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left', 'role'=>'search', 'name'=>'form_buscar']) !!}

                                                {!! Form::text('nombre', null, ['class' => 'form-control input-sm', 'placeholder' => 'Buscar por Nombre', 'autofocus' ]) !!}

                                                <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true" alt="Buscar"></i></button>

                                                {!! Form::close() !!}
                                            </tr>

                                            <tr>
                                                {!! Form::model(Request::all(), ['route'=>'users.index', 'method'=>'GET', 'class'=>'navbar-form navbar-left', 'role'=>'search', 'name'=>'form_buscar']) !!}

                                                {!! Form::text('municipalidad', null, ['class' => 'form-control input-sm', 'placeholder' => 'Buscar por Municipalidad', 'autofocus' ]) !!}

                                                <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true" alt="Buscar"></i></button>

                                                {!! Form::close() !!}
                                            </tr>

                                            <div class="row">
                                            <div style="text-align: right; margin-right: 50px;">

                                                <a href="{{url('users/create')}}" class="btn btn-primary btn-xs" id="crear-usuario" alt="Crear Usuario">Crear Usuario</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th style="width: 150px;">Nombre</th>
                                                        <th>E-mail</th>
                                                        <th>Municipalidad</th>
                                                        <th>Rol</th>

                                                        <th style="width: 150px;">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $pag = (isset($_GET['page']))? $_GET['page'] : 1 ;
                                                    ?>
                                                    @foreach($users as $user)
                                                    <?php
                                                        $id_user_pagina = (env('APP_REG_PAG') * ($pag - 1)) + $loop->index  + 1;
                                                    ?>
                                                    <tr>
                                                        <th scope="row">{{ $id_user_pagina }}</th>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->instituciones->nombre }}</td>
                                                        <td>
                                                        @foreach($user->roles as $row)

                                                            <li>{{ ($row->display_name) }}</li>

                                                        @endforeach
                                                        </td>
                                                        <td>
                                                            <!-- Editar usuario -->
                                                            <a id="editar-usuario" href="{{url('usuarios/'.Hashids::encode($user->id).'/edit')}}" class="btn btn-primary btn-xs" title="Editar Usuario" alt="Editar Usuario">
                                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                                            <!-- Editar roles-->
                                                            <a id="editar-roles" class="btn btn-xs btn-primary" href="{{ url('users/'.Hashids::encode($user->id).'/edit') }}" title="Editar Roles" alt="Editar Roles"><i class="fa fa-key" aria-hidden="true"></i></a>
                                                            <!-- Reset-->
                                                            <a id="reset-password" class="btn btn-xs btn-danger" href="{{url('resetpassword/'. Hashids::encode($user->id) .'/'. csrf_token() )}}" title="{{ trans('traduction.reset_password') }}" alt="Reset Password"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></a>

                                                            <?php
                                                            /*
                                                            <form action="{{ url('/password/email') }}" method="post">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="email" value="{{ $user->email }}" />

                                                                <button type="submit" class="btn btn-danger btn-xs" onclick='return confirm("Desea reinicar la contraseña de ese usuario?")'; title="Reiniciar">
                                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                            */
                                                            ?> 
                                                                                                                   <!-- Borrar -->
                                                            <a id="eliminar-usuario" class="btn btn-xs btn-primary" href="{{ url('users/destroy/'.Hashids::encode($user->id).'') }}" onclick='return confirm("Desea eliminar el registro?");' title="Eliminar Usuario" alt="Eliminar Usuario"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                     </div>
                                        <?php echo $users->appends($_GET)->render(); ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Listado de Permisos </h2></div>
                    <div class="panel-body">
                        <!-- Direct Chat -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary direct-chat direct-chat-primary">
                                    <div class="box-header with-border">

                                        @include('alerts.success')

                                        @include('alerts.errors')

                                        <div class="row">
                                            <div style="text-align: right; margin-right: 50px;">
                                                <a href="{{ url('permissions/create') }}" class="btn btn-primary btn-xs" role="button" alt="Crear Permiso">Crear Permiso</a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <table class="table table-striped">

                                            <div class="container">


                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $row)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $row->display_name }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td><a class="btn btn-xs btn-default" href="{{ url('permissions/'.Hashids::encode($row->id).'/edit') }}" alt="Editar">Editar</a>   <a class="btn btn-xs btn-default" href="{{ url('permissions/destroy/'.Hashids::encode($row->id).'') }}" onclick='return confirm("Desea eliminar el registro?");' alt="Borrar">Borrar</a>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

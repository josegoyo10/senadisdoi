@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Listado de Permisos </h2></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary direct-chat direct-chat-primary">
                                    <div class="box-header with-border">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Permisos</div>
                                                    <div class="panel-body">
                                                        <form action="{{$formAction}}" enctype="multipart/form-data" method="post">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Nombre
                                                                    </label>
                                                                    <input class="form-control" name="name" type="text" value="@if($permissions->name){{ $permissions->name }} @endif">
                                                                    </input>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Descripción
                                                                    </label>
                                                                    <input class="form-control" name="display_name" type="text" value="@if($permissions->display_name){{ $permissions->display_name }} @endif">
                                                                    </input>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Descripción
                                                                    </label>
                                                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">@if($permissions->description){{ $permissions->description}}@endif</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                                <button class="btn btn-default waves-effect waves-light" id="enviar" type="submit" alt="Enviar">
                                                                    Enviar
                                                                </button>
                                                            </input>
                                                        </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
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

@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Listado de Roles </h2></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary direct-chat direct-chat-primary">
                                    <div class="box-header with-border">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Roles</div>
                                                    <div class="panel-body">
                                                        <form action="{{$formAction}}" enctype="multipart/form-data" method="post">
                                                            <input class="form-control" name="name" type="hidden" value="{{rtrim($role->name)}}" >
                                                            @if(!$role->name)
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>
                                                                            Nombre
                                                                        </label>
                                                                        <input class="form-control" name="name" type="text" value="@if($role->name){{rtrim($role->name)}} @endif" @if($role->name) disabled @endif>
                                                                        </input>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Nombre a Mostrar
                                                                    </label>
                                                                    <input class="form-control" name="display_name" type="text" value="@if($role->display_name){{ $role->display_name }} @endif">
                                                                    </input>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Descripción
                                                                    </label>
                                                                    <textarea class="form-control" name="description" id="" cols="30" rows="10">@if($role->description){{ $role->description}}@endif</textarea>
                                                                </div>
                                                            </div>
                                                            <!-- Permisos -->
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Permisos
                                                                    </label>
                                                                    <select  class="form-control" id="select-permisos" name="permission[]" multiple="multiple" multiple>
                                                                        @if(isset($permission))
                                                                            @foreach($permission as $permiso)
                                                                                <option value="{{ $permiso->id }}">{{ $permiso->display_name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
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








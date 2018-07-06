@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

    @include('alerts.errors')
    @include('alerts.success')

            <div class="alert alert-error">
                    Acceso no permitido.
            </div>
@endsection


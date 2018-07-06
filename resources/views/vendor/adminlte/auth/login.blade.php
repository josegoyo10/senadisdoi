@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Iniciar sesión
@endsection

@section('content')

<body class="hold-transition login-page fondo_login">
    <div id="app">
        @include('layout.encabezadoGobierno')
        <div class="login-box margin_box_login">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Ups!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 

            <div class="login-box-body panel panel-default" style="background-color: #FFF0;">
                <div class="text-center">
                    <h3>SENADIS - IMDIS</h3>
                    Indice de Inclusión Municipal en Discapacidad<br><br>
                </div>
                <div class="fondo_gob">
                    Iniciar sesión
                </div>

                <form action="{{ url('/login') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" id="email" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" id="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('adminlte_lang::message.remember') }}
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-5">
                            <button name="enviar" id="enviar" type="submit" class="btn btn-primary btn-block" alt="Iniciar Sesion">{{ trans('adminlte_lang::message.buttonsign') }}</button>
                        </div><!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="checkbox icheck">
                                <label>
                                    <a href="{{ url('/password/reset') }}">{{ trans('adminlte_lang::message.forgotpassword') }}</a><br>
                                </label>

                            </div>
                        </div><!-- /.col -->
                    </div>
                </form>

            <!-- se saco el atoregistro del login -->

            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
        @include('layout.footerGobierno')
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection

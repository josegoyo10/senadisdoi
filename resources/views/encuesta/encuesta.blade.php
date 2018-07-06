@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')

    @include('alerts.errors')
    @include('alerts.success')
  
         <br>
          @include('encuesta.indiceGrafico')
                
        <div class="content">
            @include('encuesta.progressBar')
        </div>
        @if (Request::is('resumen_encuesta'))
            {!! Form::open(['url' => 'enviar_encuesta','method' => 'post','files'=> true,'id'=>'frm']) !!}
            <div class="alert alert-warning">
                    Por favor verifique los datos antes de enviarlos. Luego presione el botón [Confirmar Envio] ubicado en la parte inferior de la pagína. <br>Recuerde que luego de enviado NO podrá modificar los datos.
            </div>

        @else
            {!! Form::open(['url' => 'encuesta','method' => 'post','files'=> true,'id'=>'frm']) !!}
        @endif


           @php

            $id = Input::get('id');
           
            
             if ($id != null) 
             {
                $id = $_GET['id'];

             }else{

                $id = 0;
                 //dd($id);
             }
            

           @endphp


            <input type="hidden" name="id_encuesta_enviar" value="{{ $id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="periodos_id" value="1">
            <input type="hidden" name="encuesta_id" value="{{ $encuestas_id }}">

            <input type="hidden" name="instituciones_id" value="{{Auth::user()->instituciones_id}}">
            <input type="hidden" name="total_preguntas" id="total_preguntas" value="{{ $total_preguntas }}">
           <input type="hidden" name="descripcion_motivo" id="descripcion_motivo" value="{{$desc_motivo}}">
           <input type="hidden" name="estado_encuesta" id="estado_encuesta" value="{{$desbloqueda}}">

           <input type="hidden" name="dimension_inicial" id="dimension_inicial" value="{{$id_dimension_inicial}}">
            <input type="hidden" name="dimension_final" id="dimension_final" value="{{$id_final}}">
             <input type="hidden" name="total_dimension" id="total_dimension" value="{{$total_dimensiones}}">
             <input type="hidden" name="grafico_gral_imdis"  id="grafico_gral_imdis" value="">
            
             <input type="hidden" name="valor_gral_imdis"  id="valor_gral_imdis" 
                value="{{ $imdis }}">

            <div class="nav-tabs-custom">
                        @include('encuesta.nav')
                    <div class="tab-content">
                        <!--loop dimensiones -->
                         @if (count($dimension) == 0)
                            <div class="tab-pane fade alert alert-info text-center" role="alert">No existen dimensiones registradas</div>
                        @else
                            @include('encuesta.dimensiones')
                        @endif
                    </div>
            </div>

            <!-- BOTONERA -->

                <!-- Roll Municipal -->
                <!--    Perfiles-->
                <!--        contestador-municipalidad -->
                <!--        visualizador-municipalidad->
                <!--        administrador-usuario-municipales-->

            @if(Auth::user()->can('administrador-usuario-municipales') || Auth::user()->can('contestador-municipalidad') )

                @include('encuesta.botonera')

                <!-- ROL SENAIDS -->
                <!--   Perfiles-->
                <!--       administrador-SENADIS -->
                <!--       visualizador-SENADIS->
                <!--       administrador-sistema-SENADIS-->

            @elseif(Auth::user()->hasRole('snds'))

                @include('encuesta.botonera')

            @endif

            <!-- Modal -->
            @include('encuesta.modal')

        {!! Form::close() !!}

  @endsection


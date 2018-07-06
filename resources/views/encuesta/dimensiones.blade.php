<?php
    $pestana_activa = true;

    $cont_dimensiones = 0;
?>

@foreach ($dimension as $row_dimensiones)

    <?php
        $cont_dimensiones++;
        if ($pestana_activa) {
            $clase_activa = "tab-pane active";
            $pestana_activa = false;
        }else{

            $clase_activa = "tab-pane";
        }
    ?>

    <div id="dimension{{ $row_dimensiones->id }}" class="{{$clase_activa}}">
        <?php
        $factores = \App\Factores::where('dimensiones_id', '=',$row_dimensiones->id)->get();
        //$cant_factores = \App\Factores::get()->count();
        ?>

        @if (count($factores) == 0)
            <div class="alert alert-info text-center" role="alert">No existen factores registrados</div>

        @else
                @include('encuesta.identificacionEvaluacion')
               

                @include('encuesta.graficasDimension')
                
                @include('encuesta.factores')
        @endif
    </div> 

@endforeach

<?php 
$cont_dimensiones++;
?>

<div id="dimension{{ $cont_dimensiones }}" class="{{$clase_activa}}">
    @include('encuesta.resumenGraficasDimensiones')
</div>

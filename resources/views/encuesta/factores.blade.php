
@foreach ($factores as $row_factores)
    <div class="box box-primary">
         <div class="box-header with-border" data-widget="collapse">
         <i class="fa fa-minus"></i>
          <h3 class="box-title">{{ $row_factores->nombre }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php
            $preguntas = \App\Preguntas::where('factores_id', '=',$row_factores->id)->get();
            $cant_preg = \App\Preguntas::where('factores_id','=',$row_factores->id)->count();
            $num = 1;
            ?>
            
                @if (count($preguntas) == 0)
                <div class="alert alert-info text-center" role="alert">No existen preguntas registradas</div>
                @else
                    <input type="hidden" name="cant_preg"  id="cant_preg" value={{$cant_preg}}>

                    <div class="col-xs-12 table-responsive">
                    <table class="table table-striped  table-hover table-condensed" id="tbl_factores" >
                    <thead>
                        <th>N°</th>
                        <th style="width: 350px;">{{ trans('traduction.question') }}</th>
                        <th>{{ trans('traduction.answer') }}</th>
                        <th>{{ trans('traduction.weight') }}</th>
                        <th class="text-center">{{ trans('traduction.observation') }}</th>
                        <th class="text-center">{{ trans('traduction.verification_file') }}</th>
                      @if(Auth::user()->hasRole('snds') && $encuestaRespuestas && ($encuestaRespuestas->estados_encuesta_id == 2))
                        <th class="text-center">Aprobado</th>
                      @endif
                     </thead>
                     <tbody>
                        
                        @include('encuesta.preguntas')

                      </tbody>
                    </table>
                    </div>  
                @endif
   
        </div><!-- /.box-body -->
    </div> <!-- /.box -->
@endforeach





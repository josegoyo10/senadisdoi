<div class="text-center">
	@if (Request::is('resumen_encuesta'))
        <a id="enlace_ver_preguntas" name="enlace_ver_preguntas" 
       
        href={{"http://".$_SERVER['HTTP_HOST']."/encuesta?id="}}{{$encuestaRespuestas->id}} 
        class="btn btn-primary" alt="Boton Volver">Volver</a>

        <button id="btn_confirmar_envio" name="btn_confirmar_envio" class="btn btn-primary" type="submit" form="frm" value="enviar" alt="Boton Confirmar Envio">
          Confirmar Envio
        </button>
	@else
                
        @if ($escuesta_bloqueda == ' disabled ')
            <a id="enlace_volver" name="enlace_volver" href="{{URL::to('home')}}" class="btn btn-primary" alt="Boton Volver"> Volver </a>
        @else
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="validar_encuesta_1" name="validar_encuesta" alt="Boton Validar Información">
                Validar la informaci&oacute;n
            </button>

        @endif
       @if (($encuestaRespuestas && $encuestaRespuestas->estados_encuesta_id == 2) && (Auth::user()->hasRole('snds')))
             <button type="button" class="btn btn-primary"  id="aprobar_encuesta" name="aprobar_encuesta" alt="Boton Aprobar" disabled >
                Aprobar
            </button>
            
         <button type="button" class="btn btn-danger" id="rechazar_encuesta" name="rechazar_encuesta" disabled data-toggle="modal" data-target="#rechazarModal" alt="Boton Rechazar">
          Rechazar
        </button>


       @endif
        
          @if (($encuestaRespuestas && $encuestaRespuestas->estados_encuesta_id ==5) && Auth::user()->hasRole('mncpld'))
             <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" id="validar_encuesta_1" name="validar_encuesta"  alt="Boton Validar la informaci&oacute;n">
                Validar la informaci&oacute;n
            </button>
          @endif

    @endif
</div>

<div class="row">
  <div class="col-md-12">
    
       @if(!empty($encuestaRespuestas->estados_encuesta_id) && ($encuestaRespuestas->estados_encuesta_id == 1))
         <div class="row"> 
            <div class="alert alert-warning">
              <strong>Advertencia..Una vez que el Usuario Municipal complete la encuesta debe hacer click en el botón Validar Información luego hacer click en el botón Guardar y Enviar, y por último hacer click en el botón Confirmar Envio para que la encuesta pase a estado Enviada.</strong>
            </div>
          </div>
       @endif
  </div>
</div>
<div class="row">
  <div class="col-sm-5">
    <h3>Encuesta<br>
        Indice de Inclusión <br>Municipal en Discapacidad (IMDIS)</h3>
       
          <div class="box box-widget widget-user-2">

            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li>
                  <a href="#"><strong>Municipalidad: </strong>
                      @if ($encuestaRespuestas)
                        {{ $encuestaRespuestas->nombreInstitucionEncuesta() }}
                      @else
                        {{ "--" }}
                      @endif
                  </a>
                </li>
                
                <li>
                  <a href="#"><strong>Encuesta registrada por: </strong>
                      @if ($encuestaRespuestas)
                        {{ $encuestaRespuestas->nombreUsuarioEncuesta() }}
                      @else
                         {{ "--" }}
                      @endif
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->

	</div>
	<div class="col-sm-7"> 
    <div id="indice_grafico" class="indice_general" alt="Grafico de Indice General">
  	</div>
   
   </div>
</div>
<br>

  <div class="form-group" style="display:none;" id="observacion_div">
        <h3>Observaciones:</h3>
        <textarea class="form-control" rows="5" id="observacion_rechazo" readonly></textarea>
 </div>
 <br>
<div class="box box-danger" id="collapse_preguntas" style="display:none;">
   	   <div class="box-header with-border" data-widget="collapse">
         	<i class="fa fa-plus" data-toggle="collapse"></i>
          	<h3 class="box-title">Lista de Preguntas con Observaciones</h3>
        </div>
         <div class="box-body" style="display:none;">
            <div class="col-xs-12 table-responsive">
                <div class="row">
                  	<div id="question_list_rechazadas"></div>
               </div>
            </div>
         </div>

       
</div>


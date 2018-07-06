<div class="modal fade modal_encuesta" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Env&iacute;o Definitivo de la Encuesta</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="alert alert-success" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            N&uacute;mero de preguntas contestadas <span class="badge" id="cant_contestada"></span>
                        </div>
                    </div>
                    <div>
                        <div class="alert alert-danger" role="alert" id="msj_error_preg_sin_contestar">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            N&uacute;mero de preguntas sin contestar <span class="badge" id="no_contestada"></span>

                        </div>
                    </div>
                   <div>
                        <div class="alert alert-danger" id="msj_error_img">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                            <span  id="lista_imagen"></span>

                        </div>
                        <div class="alert alert-danger" id="msj_adjunto_preg_rechazo">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only"></span>
                            <span>Debe adjuntar todos los medios de verificación indicados en el recuadro para Guardar Completa la Encuesta</span>
                        </div>
                         
                          <div class="alert alert-danger" id="msj_encabezado">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only"></span>
                            <span>Debe Llenar todos los encabezados de la encuesta para Guardar Completa la Encuesta...</span>

                        </div>
                         
                         <div class="alert alert-danger" id="msj_fecha_validacion" style="display:none;">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only"></span>
                            <span>No puede ingresar una fecha mayor al dia de hoy..</span>
                           
                        </div>


                    </div>

                    <div class="modal-footer">
                       
                        <button id="btn_guardar_borrador" name="btn_guardar_borrador" class="btn btn-primary" type="submit" form="frm" value="enviar" alt="Guardar Borrador">Guardar Borrador</button>

                        <a  class="btn btn-primary" id="btn_guardar_enviar" name="btn_guardar_enviar" onclick="enviar_formulario()" alt="Guardar y Enviar">Guardar y Enviar</a>
                          
                        <!--a  class="btn btn-primary" id="btn_guardar_borrador" name="btn_guardar_borrador" onclick="enviar_formulario()">Guardar Borrador</a>

                        <button id="btn_guardar_enviar" name="btn_guardar_enviar" class="btn btn-primary" type="button" form="frm" value="enviar">Guardar y Enviar</button!-->

                    <button type="button" class="btn btn-primary" data-dismiss="modal" alt="Salir">Salir</button>

                 </div>
            </div>
        </div>
    </div>
</div>

<!---Modal Preguntas Rechazadas !-->
    


<!-- Modal -->
<div class="modal fade" id="rechazarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     <div id="div_rechazo" style="display: none;" class="alert alert-success text-center">Su encuesta ha sido Evaluada</div>
      <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Preguntas Rechazadas</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" alt="Cerrar">&times;</span>
            </button>
          <button class="btn btn-lg btn-warning" style="display: none;" id="btn_loading">
          <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Cargando...</button> 
      </div>
      <div class="modal-body"  style="overflow:scroll;overflow-x:hidden;height:20em;width:560px;">
       <!--div class="loader" style="margin-left:250px;display: none;"></div!-->


        <form>
          <div class="form-group">
            <label for="recipient-name" class="form-control-label"><b>A continuación se listan las preguntas donde el Medio de Verificación NO cumplen:</b></label>
            <div class="form-group">
               <span id="preguntas_rechazadas" name="preguntas_rechazas" class="questionsName" readonly></span>
             </div>
          </div>
          
          <div class="form-group">
            <label for="message-text" class="form-control-label"><b>Motivos:</b></label>
            <textarea class="form-control" rows="5" id="motivo_rechazo" style="resize: none;"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" alt="Cerrar">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_enviar_preg_rechazo" disabled alt="Enviar">Enviar</button>
      </div>
    </div>
  </div>
</div>

<br><br>
<!--div class="loader_aprobada" id="img_aprobada" style="margin-left:492px;display:none;"></div!-->
<button class="btn btn-lg btn-warning" style="display: none;" id="btn_loading_aprobado" alt="Cargando">
          <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Cargando...
</button>

<div id="dialog-message" title="Encuesta Evaluada Exitosamente" style="display:none;">
    <div class="alert alert-success">La encuesta fue Evaluada Exitosamente el usuario municipal recibirá un email con el resultado de su evaluación.</div>
    
</div> 
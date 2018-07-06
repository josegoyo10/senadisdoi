<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" alt="Ingresar">Ingresar</button>
<!-- Modal -->
<div id="myModal" class="modal fade modal_encuesta" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" alt="Ingresar Nueva Municipalidad">&times;</button>
            <h4 class="modal-title text-center">Ingresar Nueva Municipalidad</h4>
         </div>
         <div class="modal-body">

          <form id="frmficha" action="{{ url('institucion/crearInstitucion') }}" class="form-horizontal" method="POST" enctype="multipart/form-data"  data-toggle="validator" role="form">
 
               <input name="_token" type="hidden" value="{{ csrf_token() }}">
               <div class="form-group">
                  <label class="control-label col-sm-2" for="region">Región:</label>
                  <div class="col-sm-10">
                      
                    <select class="form-control" name="regiones_id" required>
                      @if ($regiones->count())
                    <option value=" ">&laquo&laquo SELECCIONE &raquo&raquo</option>
                          @foreach($regiones as $regiones)
                            <option value="{{$regiones->id}}">{{$regiones->region_numero_romano }}</option>
                          @endforeach
                      @endif
                      <div class="help-block with-errors"></div>
                    </select>
                   
                 </div> 
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="proponente">Proponente:</label>
                  <div class="col-sm-10"> 
                     <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese proponente" required>
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="comuna">Comuna:</label>
                  <div class="col-sm-10"> 
                     <input type="text" class="form-control" id="comuna" name="comuna" placeholder="Ingrese comuna" required>
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="provincia">Provincia:</label>
                  <div class="col-sm-10"> 
                     <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Ingrese provincia" required>
                     <div class="help-block with-errors"></div>
                  </div>
               </div>
              <div class="form-group">
                  <label class="control-label col-sm-2" for="nombre_contacto">Nombre Contacto:</label>
                  <div class="col-sm-10"> 
                     <input type="text" class="form-control" id="persona_contacto" name="persona_contacto" placeholder="Ingrese nombre" required>
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="email_contacto">E-mail:</label>
                  <div class="col-sm-10"> 
                     <input type="email" class="form-control" id="correo_contacto" name="correo_contacto" placeholder="Ingrese e-mail">
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="telefono_contacto">Teléfono:</label>
                  <div class="col-sm-10"> 
                     <input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" placeholder="Ingrese telefono" maxlength="15" required>
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
              <button type="submit" class="btn btn-primary" id="enviar_ficha" alt="Guardar">Guardar</button>
               <button type="button" class="btn btn-primary" data-dismiss="modal" alt="Salir">Salir</button>
           </form>
         </div>
       
      </div>
   </div>
</div>


<script type="text/javascript">
$("#frmficha").validator()
</script>
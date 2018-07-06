<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Ingresar</button>
<!-- Modal -->
<div id="myModal" class="modal fade modal_encuesta" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center">Ingresar Nuevo Convenio</h4>
         </div>
         <div class="modal-body">

          <form id="frmconvenio" action="{{ url('convenios') }}" class="form-horizontal" method="POST" enctype="multipart/form-data"  data-toggle="validator" role="form">
 
               <input name="_token" type="hidden" value="{{ csrf_token() }}">
               
               <div class="form-group">
                  <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                  <div class="col-sm-10"> 
                     <input value="" type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del convenio" required maxlength="255">
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="encuestas_id">Encuesta:</label>
                  <div class="col-sm-10">
                      
                    <select class="form-control" name="encuestas_id" required>
                      @if ($encuestas->count())
                            <option value=" ">&laquo&laquo SELECCIONE &raquo&raquo</option>
                          @foreach($encuestas as $row)
                            <option value="{{$row->id}}">{{$row->nombre }}</option>
                          @endforeach
                      @endif
                      <div class="help-block with-errors"></div>
                    </select>
                   
                 </div> 
               </div>
                      
                <div class="form-group">
                  <label class="control-label col-sm-2" for="inicio_primera_aplicacion">Inicio 1era Aplicación:</label>
                  <div class="col-sm-3"> 
                    <input type="text" name="inicio_primera_aplicacion" id="inicio_primera_aplicacion" readonly="readonly" required maxlength="10" class="form-control" />
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-sm-1">
                    <img src="/img/calendario.png" id="calendario_inicio_primera_aplicacion" />
                  </div>
                  <label class="control-label col-sm-2" for="fin_primera_aplicacion">Fin 1era Aplicación:</label>
                  <div class="col-sm-3"> 
                    <input type="text" name="fin_primera_aplicacion" id="fin_primera_aplicacion" readonly="readonly" required class="form-control" maxlength="10" />
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-sm-1">
                    <img src="/img/calendario.png" id="calendario_fin_primera_aplicacion" />
                  </div>
               </div>
              <div class="form-group">
                  <label class="control-label col-sm-2" for="inicio_segunda_aplicacion">Inicio 2da Aplicación:</label>
                  <div class="col-sm-3"> 
                    <input type="text" name="inicio_segunda_aplicacion" id="inicio_segunda_aplicacion" readonly="readonly" required class="form-control" maxlength="10"/>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-sm-1">
                    <img src="/img/calendario.png" id="calendario_inicio_segunda_aplicacion" />
                  </div>
                  <label class="control-label col-sm-2" for="fin_segunda_aplicacion">Fin 2da Aplicación:</label>
                  <div class="col-sm-3"> 
                      <input type="text" name="fin_segunda_aplicacion" id="fin_segunda_aplicacion" readonly="readonly" required maxlength="10" class="form-control" />
                      <div class="help-block with-errors"></div>
                  </div>
                  <div class="col-sm-1 pull-left">
                    <img src="/img/calendario.png" id="calendario_fin_segunda_aplicacion" />
                  </div>
              </div>
                    <div class="form-group scroll_div" style="overflow:scroll;overflow-x:hidden;height:10em;width:560px;">
                         <div class="col-md-12">     
                              <table class="table table-striped">
                                 <div class="container">
                                    <thead>
                                       <tr>
                                          <th style="font-size:13px;" class="text-center"> </th>
                                          <th style="font-size:13px;" class="text-left">Seleccione las municipalidades</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($instituciones as $row)
                                       <tr> 
                                          <td style="font-size:13px;" class="text-right"> <input class="field" name="convenio_institucion[]" type="checkbox" value="{{ $row->id }}"></td>
                                          <td style="font-size:13px;" class="text-left"> {{ $row->nombre }}</td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                              </table>
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
$("#frmconvenio").validator()
</script>
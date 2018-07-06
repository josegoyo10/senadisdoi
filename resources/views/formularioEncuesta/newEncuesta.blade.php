<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" alt="Ingresar">Ingresar</button>
<!-- Modal -->
<div id="myModal" class="modal fade modal_encuesta" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center">Ingresar Nueva Encuesta</h4>
         </div> 
         <div class="modal-body">

          <form id="frm" action="{{ url('formulario-encuesta') }}" class="form-horizontal" method="POST" enctype="multipart/form-data"  data-toggle="validator" role="form">
 
               <input name="_token" type="hidden" value="{{ csrf_token() }}">
               
               <div class="form-group">
                  <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                  <div class="col-sm-10"> 
                    <input value="" type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                    <div class="help-block with-errors"></div>
                  </div>
                <div class="col-sm-6 pull-left"> 
                      Clonar a partir de otra encuesta
                      <input name="clonar" id="clonar" type="checkbox" onclick="toggle('.div_encuesta', this)" >
                      <div class="help-block with-errors"></div>
                  </div>
               </div>
              <div class="form-group div_encuesta" style="display: none;">
                  <label class="control-label col-sm-2" for="nombre">Encuesta:</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="encuesta_id">
                        @if ($encuesta->count())
                            <option value=" ">&laquo&laquo SELECCIONE &raquo&raquo</option>
                            @foreach($encuesta as $row)
                              <option value="{{$row->id}}">{{$row->nombre }}</option>
                            @endforeach
                        @endif
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
               </div>

              <button type="submit" class="btn btn-primary" id="enviar_ficha" alt="Guardar" >Guardar</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" alt="Salir">Salir</button>
           </form>
         </div>
       
      </div>
   </div>
</div>


<script type="text/javascript">
$("#frm").validator()
</script>
<script type="text/javascript">
  function toggle(className, obj) {
    var $input = $(obj);
      if ($input.prop('checked')) $(className).show();
      else $(className).hide();
  }
</script>
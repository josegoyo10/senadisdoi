    <div class="box box-primary">
         <div class="box-header with-border" data-widget="collapse">
         <i class="fa fa-minus"></i>
          <h3 class="box-title">Identificación de la evaluación - {{ $row_dimensiones->nombre }}</h3>
          <?php
               $id = Input::get('id');
              if ($id != null) 
              {
                $id = $_GET['id'];
              } else {
                $id = 0;   //dd($id);
              }
            

            $persona_responde = \App\PersonaRespondeDimension::where('encuesta_respuesta_id' , '=',$id)
                              ->where('dimension_id', '=', $row_dimensiones->id)->first();
            $nombre_responde = "";
            $correo_responde = "";
            $telefono_responde = "";
            $fecha_responde = date("d-m-Y");
            $cargo = "";
          if (count($persona_responde) > 0) {
            $nombre_responde = $persona_responde->nombre;
            $correo_responde = $persona_responde->correo;
            $telefono_responde = $persona_responde->telefono;
            $cargo = $persona_responde->cargo;
            $fecha_responde = $persona_responde->fecha_responde;

          }
          ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">            
            <div class="col-xs-12 table-responsive">
                <div class="row">
                  Por favor indique los datos de la persona que le suministro la información para esta dimensión.
                </div>
               
                    <table class="table table-striped  table-hover table-condensed">
                           <tr>
                            <td>Nombre del encuestado:</td>
                            <td><input type="text" data-encab-id="{{ $row_dimensiones->id }}" name="nombre_responde[{{ $row_dimensiones->id }}]"  id="nombre_responde_{{$row_dimensiones->id}}" value="{{ $nombre_responde }}" {{ $escuesta_bloqueda }}  class="encabezado form-control" data-identicacion="{{$row_dimensiones->id }}" maxlength="100">
                             <div style="text-align: center;"> 
                              <span id="error_nombre_{{$row_dimensiones->id}}" style="color:red;display:none;">Campo Obligatorio</span>
                             </div>
                            </td>

                            <td>Correo del encuestado:</td>
                            <td><input type="email" name="correo_responde[{{ $row_dimensiones->id }}]"  id="correo_responde_{{$row_dimensiones->id}}" value="{{ $correo_responde }}" {{ $escuesta_bloqueda }}  data-identicacion="{{$row_dimensiones->id }}" class="encabezado form-control" 
                               onkeyup="return(validateEmail(correo_responde_{{$row_dimensiones->id}},{{$row_dimensiones->id}}));" maxlength="100">
                             <div style="text-align: center;"> 
                                <span id="error_correo_{{$row_dimensiones->id}}" style="color:red;display:none;">Campo Obligatorio</span>
                                <span class="email_errors_{{$row_dimensiones->id}}" style="display:none;color:red;">email invalido</span>
                             </div>
                             
                            </td>
                        </tr>
                        <tr>
                            <td>Teléfono del encuestado:</td>
                            <td><input type="text" name="telefono_responde[{{ $row_dimensiones->id }}]"  id="telefono_responde_{{$row_dimensiones->id}}" value="{{ $telefono_responde }}" {{ $escuesta_bloqueda }}   maxlength="15"  class="encabezado form-control" data-identicacion="{{$row_dimensiones->id }} form-control ">
                             <div style="text-align: center;"> 
                               <span id="error_telefono_{{$row_dimensiones->id}}" style="color:red;display:none;">Campo Obligatorio</span>
                              </div>
                            </td>
                            <td> Cargo del encuestado: </td>
                            <td> 
                              <input type="text" name="cargo_responde[{{ $row_dimensiones->id }}]"  id="cargo_responde_{{$row_dimensiones->id}}" value="{{ $cargo }}" {{ $escuesta_bloqueda }} data-identicacion="{{$row_dimensiones->id }}" class="encabezado form-control" maxlength="100">
                              <div style="text-align: center;">
                              <span id="error_cargo_{{$row_dimensiones->id}}" style="color:red;display:none;">Campo Obligatorio</span>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha de la encuesta:</td>
                            <td>
                                <input type="text" name="fecha_responde[{{ $row_dimensiones->id }}]"  id="fecha_responde[{{$row_dimensiones->id}}]" 
                                  value="{{ $fecha_responde }}"  {{ $escuesta_bloqueda }}  
                                  class="encabezado form-control" 
                                  data-identicacion="{{$row_dimensiones->id }}" maxlength="10">
                            
                            <div style="text-align: left;">
                             <span id="error_fecha_{{$row_dimensiones->id}}" style="color:red;display:none;">Campo Obligatorio</span>
                            </div>
                            </td>
                            <td>
                              <img src="img/calendario.png" title="Fecha Inicial" id="lanzador_{{$row_dimensiones->id}}">&nbsp;
                            </td>
                            <td>&nbsp;</td>
                          </tr>

                          </table>
                     
                    </div>  
             </div><!-- /.box-body -->
      </div> <!-- /.box -->



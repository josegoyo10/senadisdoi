@foreach ($preguntas as $row_preguntas)

            <?php 
                if ($encuestaRespuestas) {
                    $encuesta_respuestas = $encuestaRespuestas->id;
                } else {
                    $encuesta_respuestas = 0;
                }
               

                $respuestas = \App\Preguntas::getRespuestas($row_preguntas->id, $encuesta_respuestas);
                 
                 //dd($respuestas);

                 $style = "";
                    

                     if (($respuestas->medio_verificacion_aprobado === 0) &&($encuestaRespuestas->estados_encuesta_id != 2))
                     {
                         $style ="border-style:solid;border-color:#d7191c";
                     }
                     
                     //dd($respuestas->medio_verificacion_aprobado);

                ?>
         
         <tr id="fila_{{$row_preguntas->id}}" class="dimension_{{$row_dimensiones->id}}" style="{{$style}}">
            
            <td>{{$num++}})</td>
            <td>&iquest;{{ $row_preguntas->desc_pregunta }}?</td>
            <td>
                <?php
                $si_checked = "";
                $no_checked = "";
                $vacio_checked = "";
                $medio = 0;
                ?>

                                               
                        <?php 
                        $medio =  (isset($respuestas->medio_verificacion_aprobado) ? $respuestas->medio_verificacion_aprobado : '2' ) 
                         ?>
                       
                        @if ($respuestas->valor === 1)
                            <?php $si_checked = " checked "; ?>
                            
                        @elseif ($respuestas->valor === 0)
                            <?php $no_checked = " checked " ; ?>
                        
                        @endif
                        
                      
  

                <label>
                     <input type="radio" class="radio_preg_si"  id="btn-inicio_{{$row_preguntas->id}}" data-boton="btn-inicios_{{$row_dimensiones->id}}" data-factor-id="{{$row_factores->id}}" data-valor-pond="{{$row_preguntas->ponderador }}" data-ponderacion="{{ $row_preguntas->ponderador }}" data-cant-preg="{{$cant_preg}}"  name="preguntas[{{ $row_preguntas->id }}]" data-valor="{{$row_factores->id}}" data-dimension="{{$row_dimensiones->id}}" data-preg="preguntas_{{$row_preguntas->id}}" data-factor="{{$row_factores->nombre}}" data-medio-verificacion ="{{$medio}}" data-descripc-pregunta="{{ $row_preguntas->desc_pregunta }}" value="1" {{$si_checked }}  {{$escuesta_bloqueda }}> Si
                </label>
                <label>
                     <input type="radio" class="radio_preg_no"  id="btn-inicio_{{ $row_preguntas->id }}" data-factor-id="{{$row_factores->id}}" data-boton="btn-inicios_{{$row_dimensiones->id}}" data-valor-pond="{{$row_preguntas->ponderador }}" data-ponderacion="{{ $row_preguntas->ponderador }}" data-cant-preg="{{$cant_preg}}" name="preguntas[{{ $row_preguntas->id }}]"   data-dimension="{{$row_dimensiones->id}}" data-preg="preguntas_{{$row_preguntas->id}}" data-factor="{{$row_factores->nombre}}" value="0" {{ $no_checked }}  {{ $escuesta_bloqueda }}> No
                </label>
            </td>
            <td class="dimension_{{$row_dimensiones->id}} text-center" data-val-dim="{{$row_dimensiones->id}}" data-val-pond="{{ $row_preguntas->ponderador }}">{{ $row_preguntas->ponderador }}
            </td>
            <td>
              <?php 
                $observacion = "";
                $observacion = $respuestas->observacion;
              ?>
              
              <textarea class="form-control" maxlength="500" rows="2" cols="89" name="observacion_{{ $row_preguntas->id }}" id="observacion_{{ $row_preguntas->id }}" placeholder="Observaci&oacute;n" type="comentario"
                {{ $escuesta_bloqueda }}
                >{{ $observacion }}</textarea> 

            </td>
             <td style="min-width: 200px;" class="text-center">
                <div><p id="msj_opcion_{{ $row_preguntas->id}}" style="color:#FF0000;display:none";>Seleccione una Opcion</p></div>
                
                @if($row_preguntas->req_medio_verificacion)

                    <label>
                      
                        <span class="btn btn-primary btn-file btn-group" id="span_image_{{ $row_preguntas->id }}">
                            <input name="image[{{ $row_preguntas->id }}]" type="file" class="file-loading" id="image_{{ $row_preguntas->id }}" data-factor="image_{{$row_preguntas->id}}" data-id-dimension= "{{$row_dimensiones->id}}"
                            {{ $escuesta_bloqueda }} data-img="image_{{ $row_preguntas->id }}" 
                            value="0" alt="Adjuntar Archivo">
                            Adjuntar  <i class="fa fa-file"></i>

                        </span>
                          <br>
                         <span id="file_name_{{ $row_preguntas->id }}" name="file_name" class="file_imagen" style="display: none;" alt="Adjuntar Archivo"></span>
                                             
                         <span id="file_error_{{ $row_preguntas->id}}" class="error_file"  style="display: none;"></span>

                    </label>
                     
                        @if ($respuestas->medio_verificacion != '')
                            <br>
                      
                            <a id="medio_{{ $row_preguntas->id }}" name="medio_{{ $row_preguntas->id }}"  href="/uploads/{{$respuestas->medio_verificacion }}" data-medio="medio_{{$row_preguntas->id }}" class="medio_imagen" target="_new" value="{{$respuestas->medio_verificacion }}" alt="Imagen Adjuntada">{{$respuestas->medio_verificacion }} </a>
                         
                         
                        @endif
                @endif
            </td>
            
            @if ((!$encuestaRespuestas || $encuestaRespuestas->estados_encuesta_id == 2))
                 @include('validar_encuesta.validarEncuesta')
            @endif
        </tr>
@endforeach
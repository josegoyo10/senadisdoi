         @if(Auth::user()->hasRole('snds'))  
            <td style="min-width: 15px;" class="text-center">
                @if($row_preguntas->req_medio_verificacion)

                        @if ($respuestas->medio_verificacion != '')

                          <br>
                          <?php 
                          $aprobado_checked = "";
                          $rechazado_checked = ""; 
                          ?>
                          @if ($respuestas->medio_verificacion_aprobado === 1)
                              <?php $aprobado_checked = " checked "; ?>
                          @elseif($respuestas->medio_verificacion_aprobado === 0)
                              <?php $rechazado_checked = " checked " ?>
                          @endif

                         <div class="form-group has-success">
                           <label for="myRadio" class="glyphy"><i class="fa fa-fw fa-check" title="Si"></i>
                                    <input type="radio" id="radio_{{ $row_preguntas->id }}" name="myRadio[{{ $respuestas->id }}]" data-pregunta-id="preguntas[{{ $row_preguntas->id }}]" class="RadioAprobacion" data-dimension="{{$row_dimensiones->id}}" data-id="{{ $row_preguntas->id }}" value="1" {{$aprobado_checked}}/>
                                                           
                            </label>


                           </div>
                           
                           <div class="form-group has-error">
                                    <label for="myRadio" class="glyphy"><i class="fa fa-times-circle-o" title="No"></i>&nbsp;
                                    
                                    <input type="radio" id="radio_{{ $row_preguntas->id }}" name="myRadio[{{ $respuestas->id }}]" class="RadioAprobacion" data-id="{{ $row_preguntas->id }}" data-pregunta="{{ $row_preguntas->id }}{{ $row_preguntas->desc_pregunta }}"  data-pregunta="preguntas[{{ $row_preguntas->id }}]" data-dimension="{{$row_dimensiones->id}}" data-id="{{ $row_preguntas->id }}" {{$rechazado_checked}} value="0" />
                                                           
                            </label>



                       @endif
                @endif
             
            </td>
@endif
       
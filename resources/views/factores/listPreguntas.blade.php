<div class="container-fluid spark-screen">
<div class="row">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h2>Listado de preguntas</h2>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="box box-primary direct-chat direct-chat-primary">
                     <div class="box-header with-border">
                        <div class="row">
                           <div class="box-body with-border">
                              <div class="col-md-12">
                                 <table class="table table-striped" width="100%">
                                    <div class="container">
                                       <thead>
                                          <tr>  
                                             <th width="2%"  style="font-size:13px;">N°</th>
                                             <th width="50%"  style="font-size:13px;">Pregunta</th>
                                             <th width="10%" style="font-size:13px;">Requiere adjunto</th>
                                             <th width="10%"  style="font-size:13px;" class="text-center">Ponderador</th>
                                             <th width="28%" style="font-size:13px;" class="text-center">Acciones</th>
                                          </tr>
                                       </thead>
                                       <?php $i = 1; ?>
                                       <tbody>
                                          @foreach($preguntas as $row)
                                          @php  

                                          $cont = $i++;
                                          @endphp

                                          <tr>
                                             <td width="2%">{{ $cont }}</td>
                                             <td width="50%">{{$row->desc_pregunta}}</td>
                                             <td width="10%" class="text-center">

                                              @if($row->req_medio_verificacion == 1)

                                                <?php      
                                                   $requiere = "Si";

                                                   echo $requiere;

                                                ?>
                                              @else
                                                <?php      
                                                   $requiere = "No";

                                                   echo $requiere;

                                                ?>

                                             @endif
                                             </td>
                                             <td width="10%" class="text-center">{{$row->ponderador}}</td>

                                             <td width="28%">
                                                <div class="col-md-2 col-md-offset-3"> 
                                                   <a id="ver" href="{!! url('pregunta-encuesta/edit/'.$row->id.'/'.$row->factores_id.'/'.$id_encuesta.'/'.$cont) !!}" class="btn btn-primary btn-xs" style="height:20px;" title="Editar Pregunta" alt="Editar Pregunta">
                                                   <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                   </a>
                                                </div>
                                                {{-- Eliminar Pregunta --}}
                                                <div class="col-md-2">
                                                   {!! Form::open(['route'=>['pregunta-encuesta.destroy',$row->id. '/' .$row->factores_id.'/'.$id_encuesta], 'method' => 'DELETE']) !!}
                                                   <button type="submit"  class="btn btn-danger btn-xs" style="height:20px;"
                                                      onclick='return confirm("¿Desea eliminar la pregunta?")'; title="Eliminar Pregunta" alt="Eliminar Pregunta">
                                                   <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                   </button>
                                                   {!! Form::close() !!}
                                                </div>
                                             </td>
                                          </tr>
                                          @endforeach      
                                       </tbody>
                                 </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Identificacion Evaluación - {{ $row_dimensiones->nombre }}</h3>

                      <?php 
                        $persona_responde = \App\PersonaRespondeDimension::where('encuesta_respuesta_id' , '=',$_GET['id'])
                                          ->where('dimension_id', '=', $row_dimensiones->id)->first();
                        $nombre_responde = "";
                        $correo_responde = "";
                        $telefono_responde = "";
                      if (count($persona_responde) > 0) {
                        $nombre_responde = $persona_responde->nombre;
                        $correo_responde = $persona_responde->correo;
                        $telefono_responde = $persona_responde->telefono;
                      }
                      ?>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row">
                      Por favor indique los datos de la persona que le suministro la información para esta dimensión. 
                    </div>
                    <div class="row">
                        <table class="table table-striped  table-hover table-condensed">
                          <tr>
                              <td>Nombre:</td><td>{{ $nombre_responde }}</td>
                              <td>Correo:</td><td>{{ $correo_responde }}</td>
                          </tr>
                          <tr>
                              <td>Teléfono:</td><td>{{ $telefono_responde }}</td>
                              <td> &nbsp;</td><td> &nbsp;</td>
                          </tr>
                          <tr>
                              <td>Nombre evaluador:</td><td>--</td>
                              <td>Fecha evaluacion:</td><td>--</td>
                          </tr>
                        </table>
                    </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
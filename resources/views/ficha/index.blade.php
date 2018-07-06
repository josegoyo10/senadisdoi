@extends('adminlte::layouts.app')
@section('main-content')
<div class="container-fluid spark-screen">
<div class="row">
   <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h2>Listado de Municipalidades</h2>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="box box-primary direct-chat direct-chat-primary">
                     <div class="box-header with-border">
                        @include('alerts.success')
                        @include('alerts.errors')
                        <div class="row">
                           <div style="text-align: right; margin-right: 50px;">
                              @include("ficha.new")
                           </div>
                        </div>
                        <div class="row">
                           <table class="table table-striped">
                              <div class="container">
                                 <thead>
                                    <tr>
                                       <th width="2%"  style="font-size:13px;">N°</th>
                                       <th width="2%"  style="font-size:13px;">Región</th>
                                       <th width="26%" style="font-size:13px;">Proponente</th>
                                       {{-- <th width="6%"  style="font-size:13px;">Comuna</th> --}}
                                       <th width="10%" style="font-size:13px;">Provincia</th>
                                       <th width="25%" style="font-size:13px;">Nombre Contacto</th>
                                       <th width="10%" style="font-size:13px;">E-mail</th>
                                       <th width="19%" style="font-size:13px;">Teléfono</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                      @php
                                        $pag = (isset($_GET['page']))? $_GET['page'] : 1 ;
                                      @endphp
                                    @foreach($institucion as $row)
                                      @php
                                          
                                       $id_user_pagina = (env('APP_REG_PAG') * ($pag - 1)) + $loop->index  + 1;

                                      @endphp

                                    <tr>
                                       <td width="2%"  style="font-size:13px;">{{$id_user_pagina}}</td>
                                       <td width="2%"  style="font-size:13px;">{{$row->regiones->region_numero_romano}}</td>
                                       <td width="26%" style="font-size:13px;">{{$row->nombre}}</td>
                                       {{-- <td width="6%"  style="font-size:13px;">{{$row->comuna}}</td> --}}
                                       <td width="10%" style="font-size:13px;">{{$row->provincia}}</td>
                                       <td width="27%" style="font-size:13px;">{{$row->persona_contacto}}</td>
                                       <td width="10%" style="font-size:13px;">{{$row->correo_contacto}}</td>
                                       <td width="19%" style="font-size:13px;">{{$row->telefono_contacto}}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                           </table>
                           </div>
                        </div>
                     </div>
                     {{ $institucion->links() }}
                  </div>

               </div>
            </div>
            
         </div>

      </div>

   </div>

</div>
 
@endsection 
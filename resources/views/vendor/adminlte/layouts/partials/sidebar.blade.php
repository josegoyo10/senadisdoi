<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- search form (Optional) -->
      <?php /* 
         Por jose.escalante - Se deshabilita el buscador - 10/02/2017 
         
             <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                   <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
                   <span class="input-group-btn">
                   <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                   </span>
                </div>
             </form>
          */
         ?>
      <!-- /.search form -->
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         {{-- 
         <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
         --}}
         <li class="header text-center" style="color: white; font-size: 14px;" title="Indice de Inclusión Municipal en Discapacidad" alt="Indice de Inclusión Municipal en Discapacidad">IMDIS</li>
         <!-- Optionally, you can add icons to the links -->
         <li class="active">
            <a href="{{ url('home') }}" alt="Inicio">
            <i class='fa  fa-home'></i>
            <span>{{ trans('adminlte_lang::message.home') }}</span>
            </a>
         </li>
         @if(Auth::user()->hasRole('snds'))
         <li class="treeview">
            <a href="#">
            <i class='fa fa-dashboard'></i>
            <span>{{ trans('traduction.administrator') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{url('users')}}">{{ trans('traduction.users') }}</a></li>
            {{--    
               // Se deshabilita porque debe conocerse bien la administeación
               // Si en algun momento desean habilitarlo para algun administrador
               // pueden habilitar las rutas, las opciones en el menú y en el dashboard. 
               // - Por: jose.escalante - 01/03/2017 / Kibernum.
               /*
               <li><a href="{{url('roles')}}">{{ trans('traduction.roles') }}</a></li>
               <li><a href="{{url('permissions')}}">Permisos</a></li>
               --}}
               <li><a href="{{url('formulario-encuesta')}}" alt="Opcion Encuestas">Encuestas</a></li>
               <li><a href="{{url('convenios')}}" alt="Opcion Convenios">Convenios</a></li>
               <li><a href="{{url('institucion')}}" alt="Opcion Municipalidades">Municipalidades</a></li>
            </ul>
         </li>
         <!-- Noticias -->
         <li class="treeview">
            <a href="#">
            <i class='fa fa-book'></i>
            <span>Noticias</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li><a id="nueva-noticia" href="{{ url('nueva-noticia') }}" alt="Opcion Nueva Noticia">Nueva Noticia</a></li>
               <li>
                 <a id="borradores" href="{{ url('borradores') }}"  alt="Opcion Borradores">Borradores</a></li>
               <li><a id="noticias_publicas" href="{{ url('noticias') }}" alt="Opcion Noticias Publicadas">Noticias Publicadas</a></li>
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
            <i class='glyphicon glyphicon-list-alt'></i>
            <span alt="Opcion Reportes">Reportes</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li> 
                  <a id="reporte-municipios" href="{{ url('reportes/municipios') }}" alt="Reporte IMDIS por Municipios">IMDIS por Municipios
                  </a>
               </li>
               <li>
                  <a id="reporte-cumplimiento_dimension" href="{{ url('reportes/cumplimiento_dimension') }}" alt="Reporte Cumplimiento por Dimensión">Cumplimiento por Dimensión</a>
               </li>
               <li>
                  <a id="reporte-dimension_municipalidad" href="{{ url('reportes/dimension_municipalidad') }}" alt="Reporte Dimensión por Municipalidad">Dimensión por Municipalidad
                  </a>
               </li>
               <li>
                  <a id="reporte-cumplimiento_factor" href="{{ url('reportes/cumplimiento_factor') }}" alt="Reporte Cumplimiento por Factor">Cumplimiento por Factor
                  </a>
               </li>
               <li>
                  <a id="reporte-factor_municipalidad" href="{{ url('reportes/factor_municipalidad') }}" alt="Reporte Factor por Municipalidad">Factor por Municipalidad
                  </a>
               </li>
            </ul>
         </li>
         <!-- Reportes !-->
         <!-- Mensajería -->
         <li class="">
            <a href="{{URL::to('mensajes')}}" alt="Opcion de Mensajería">
            <i class='fa fa-users'></i>
            <span>Mensajer&iacute;a</span>
            </a>
         </li>
         <!-- Modificaciones  04.01.2017-->
         @elseif(Auth::user()->hasRole('mncpld'))
         <!-- Mensajería -->
         <li class="">
            <a href="{{URL::to('mensajes')}}" alt="Opcion de Mensajería">
            <i class='fa fa-users'></i>
            <span>Mensajer&iacute;a</span>
            </a>
         </li>
         @endif

         @if(Auth::user()->hasRole('otrousersenadis'))
            <!-- Reportes para otro usuario municipal -->
            <li class="treeview">
               <a href="#">
               <i class='glyphicon glyphicon-list-alt'></i>
               <span  alt="Opcion Reportes">Reportes</span>
               <i class="fa fa-angle-left pull-right"></i>
               </a>
               <ul class="treeview-menu">
                  <li> 
                     <a id="reporte-municipios" href="{{ url('reportes/municipios') }}" alt="Reporte IMDIS por Municipios">IMDIS por Municipios
                     </a>
                  </li>
                  <li>
                     <a id="reporte-cumplimiento_dimension" href="{{ url('reportes/cumplimiento_dimension') }}" alt="Reporte Cumplimiento por Dimensión">Cumplimiento por Dimensión</a>
                  </li>
                  <li>
                     <a id="reporte-dimension_municipalidad" href="{{ url('reportes/dimension_municipalidad') }}" alt="Reporte Dimensión por Municipalidad">Dimensión por Municipalidad
                     </a>
                  </li>
                  <li>
                     <a id="reporte-cumplimiento_factor" href="{{ url('reportes/cumplimiento_factor') }}" alt="Reporte Cumplimiento por Factor">Cumplimiento por Factor
                     </a>
                  </li>
                  <li>
                     <a id="reporte-factor_municipalidad" href="{{ url('reportes/factor_municipalidad') }}" alt="Reporte Factor por Municipalidad">Factor por Municipalidad
                     </a>
                  </li>
               </ul>
            </li>
         @endif

         <!-- Glosario -->
         <li class="">
            <a href="{{URL::to('glosario')}}">
            <i class='glyphicon glyphicon-book'></i>
            <span alt="Opcion Glosario">Glosario</span>
            </a>
         </li>
         <!-- Manual de usuario -->
         <li class="">
            <li class="">
               @if(Auth::user()->hasRole('snds'))
                  <a href="{{URL::to('manuales/SENADIS-IMDIS-Manual-Usuario-(Administrador-SENADIS).pdf')}}" target="_new">
               @elseif (Auth::user()->hasRole('otrousersenadis'))
                     <a href="{{URL::to('manuales/SENADIS-IMDIS-Manual-Usuario-(Otro-Usuario-SENADIS).pdf')}}"  target="_new">
               @elseif (Auth::user()->hasRole('mncpld'))
                     <a href="{{URL::to('manuales/SENADIS-IMDIS-Manual-Usuario-(Funcionario-Municipal).pdf')}}"  target="_new">
               @elseif (Auth::user()->hasRole('oum'))
                     <a href="{{URL::to('manuales/SENADIS-IMDIS-Manual-Usuario-(Otro-Funcionario-Municipal).pdf')}}"  target="_new">
               @endif

            <i class='glyphicon glyphicon-question-sign'></i>
            <span alt="Manual de usuario">Manual de usuario</span>
            </a>
         </li>
      </ul>
      <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
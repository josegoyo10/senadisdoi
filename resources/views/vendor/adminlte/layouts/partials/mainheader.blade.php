<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo" title="Logo SENADIS">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" title="Indice de Inclusión Municipal en Discapacidad"><b>IMDIS</b></span>
        <!-- logo for regular state and mobile devices -->

        <span class="logo-lg">
            <img src="/img/ministerio/logo_ministerio_desarroll_social_mitad.png" style="margin-left: 50px; margin-top: 10px; height: 35px;" class="pull-left">
            <b>IMDIS</b>
            <br>
        </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <?php 
                            // Por: jos.escalante - 25/01/2017 - Se deshabilita.
                            //<img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                             ?>

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <?php 
                                    // Por: jos.escalante - 25/01/2017 - Se deshabilita.
                                //<img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                             ?>
                                <p>
                                    {{ Auth::user()->name }}

                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" alt="Salir" 
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </nav>
</header>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9">
<link rel="stylesheet" href="{{ asset('asset/css/ie8.css') }}">
<![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta property="og:locale" content="es_ES" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta name="description" property="og:description" content="" />
    <meta property="og:site_name" content="" />

    <title>SENADIS - IMDIS</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"  />

</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=454500034628078";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="menu-movil">
    <div class="wrap">
        <nav id="menu-principal">
            <ul id="menu-main-menu" class="menu-main">
                <li><a href="/">Inicio</a></li>
                <li><a href="#">Item Men&uacute; 1</a></li>
                <li><a href="#">Item Menú 2</a>
                    <ul>
                        <li><a href="#">Item Sub-menú 1</a></li>
                        <li><a href="#">Item Sub-menú 2</a></li>
                        <li><a href="#">Item Sub-menú 3</a></li>
                    </ul>
                </li>
                <li><a href="#">Item Menú 3</a>
                    <ul>
                        <li><a href="#">Item Sub-menú 1</a></li>
                        <li><a href="#">Item Sub-menú 2</a></li>
                    </ul>
                </li>
                <li><a href="#">login</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- header style="background-image:url('http://placehold.it/1920x1440')" -->
<header>
    <div class="wrap">

        <h1 id="logo-main">
            <a href="/">
                <img src="{{ asset('asset/img/logo-main.png') }}">
            </a>
        </h1>

        <nav id="menu-principal">
            <ul id="menu-main-menu" class="menu-main">
                <li><a href="/">Inicio</a></li>
                <li><a href="#">EDLI</a></li>
                <li>
                    <a href="#">IMDIS</a>
                    <ul class="sub-menu">
                        <li><a href="#">¿Que es?</a></li>
                        <li><a href="#">¿Como se calcula?</a></li>
                        <li><a href="#">¿Quienes participan?</a></li>
                    </ul>
                </li>
                <li><a href="#">¿Quienes Somos?</a></li>
                <li><a href="#">Beneficios</a></li>
                <li><a href="{{URL::to('/autoridades')}}">Autoridades</a></li>
                <li>

                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                @else
                    <li><a href="{{ url('/home') }}">{{ Auth::user()->name }}</a></li>
                    @endif
                    </li>
            </ul>
        </nav>

        <a href="#" id="menu-movil-trigger">Menú Principal</a>

    </div>
</header>
<div id="content">

    <div class="wrap">

        <div id="main">

            <div class="stream">

                <h5 class="titulo-seccion">últimas Noticias</h5>

                <div class="post tarjeta destacado">
                    <div class="pic">
                        <a href="{{URL::to('/single')}}">
                            <img src="http://placehold.it/660x250">
                        </a>
                    </div>
                    <div class="texto">
                        <div class="left">
                            <h4 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis pretium seme, turpis mi mollis leo</a></h4>
                        </div>
                        <div class="right">
                            <span class="meta">11 de marzo de 2014</span>
                            <p>Etiam vel tempor urna, eu viverra lacus. Vestibulum imperdiet, eros ac tristique ullamcorper, turpis mi mollis leo, tempor pellentesque lectus eros quis arcu. Nunc condimentum orci a mi cursus porttitor. Etiam aliquam vulputate mauris et blandit. Nunc tortor nunc</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="social">
                        <ul>
                            <li>
                                <div class="fb-like" data-href="#" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            </li>
                            <li>
                                <div class="g-plus" data-action="share" data-annotation="bubble"></div>
                            </li>
                            <li>
                                <a href="https://twitter.com/share" class="twitter-share-button" data-lang="es">Twittear</a>
                            </li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>

                <div class="post tarjeta">
                    <div class="pic">
                        <a href="#">
                            <img src="http://placehold.it/320x210">
                        </a>
                    </div>
                    <div class="texto">
                        <span class="meta">11 de marzo de 2014</span>
                        <h4 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis pretium seme, turpis mi mollis leo</a></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="post tarjeta">
                    <div class="pic">
                        <a href="#">
                            <img src="http://placehold.it/320x210">
                        </a>
                    </div>
                    <div class="texto">
                        <span class="meta">11 de marzo de 2014</span>
                        <h4 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis pretium seme, turpis mi mollis leo</a></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="post tarjeta">
                    <div class="pic">
                        <a href="#">
                            <img src="http://placehold.it/320x210">
                        </a>
                    </div>
                    <div class="texto">
                        <span class="meta">11 de marzo de 2014</span>
                        <h4 class="title"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis pretium seme, turpis mi mollis leo</a></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <a href="#" id="mas-noticias" class="boton">+ Ver más <strong>Noticias</strong></a>

            </div>

            <div class="buscar clearfix">
                <form action="">
                    <label for="query">Busca en las noticias</label>
                    <input type="text" id="query" placeholder="Ej.:�Lorem Ipsum� ">
                    <input type="submit" id="boton" value="Enviar">
                </form>
            </div>

            <div class="banner banner-foto">
                <a href="#">
                    <div class="imagen">
                        <img src="http://placehold.it/660x130" alt="">
                    </div>
                    <div class="velo"></div>
                    <div class="texto">
                        <span>Lorem Ipsum</span>
                        <span><strong>Dolor sit amet.</strong></span>
                    </div>
                </a>
            </div>

            <div class="clearfix"></div>

        </div>

        <div id="sidebar">

            <div class="redes-lista">
                <h5 class="titulo-seccion">Síguenos</h5>
                <ul>
                    <li id="facebook">
                        <a class="clearfix" href="https://www.facebook.com/senadisgobchile" target="_new">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Facebook</span>
                                <span class="usuario">senadisgobchile</span>
                            </div>
                        </a>
                    </li>
                    <li id="twitter">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Twitter</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="flickr">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Flickr</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="youtube">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Youtube</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="instagram">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Instagram</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="pinterest">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Pinterest</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="vimeo">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Vimeo</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="linkedin">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Linkedin</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="slideshare">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">SlideShare</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="scribd">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Scribd</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <li id="soundcloud">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">SoundCloud</span>
                                <span class="usuario">usuario</span>
                            </div>
                        </a>
                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>

            <div class="fotodeldia">

                <a href="#" class="foto">
                    <img src="http://placehold.it/320x210" alt="Foto Destacada">
                    <div class="clearfix"></div>
                    <h5>Foto Destacada</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam volutpat dui vel tellus ultricies, id sollicitudin lorem </p>
                </a>

                <a href="#" class="boton mas-fotos">+ Ver más <strong>Fotos Destacadas</strong></a>

            </div>

            <div class="banners">

                <div class="banner banner-corto">
                    <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
                </div>

                <div class="banner banner-corto">
                    <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
                </div>

                <div class="banner banner-corto">
                    <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
                </div>

            </div>

            <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

    </div>

</div>

<div id="prefooter">
    <div class="wrap">

        <div id="cita-destacada">
            <div class="bicolor">
                <span class="azul"></span>
                <span class="rojo"></span>
            </div>
            <div class="left">
                <div class="texto">
                    <span class="nombre">Autor de la Cita</span>
                    <span class="descripcion">Cargo del autor de la cita</span>
                    <span class="usuario">usuario</span>
                </div>
            </div>
            <div class="right">
                <div class="texto">
                    Nullam scelerisque ut tortor eu ullamcorper. Proin gravida dolor vitae sem semper feugiat. Ut at semper velit. Maecenas sit amet blandit sapien. Vivamus blandit diam.
                </div>
                <span class="fecha">15 de abril de 2014</span>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="banners banners-mosaico">

            <div class="banner banner-corto">
                <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
            </div>

            <div class="banner banner-corto">
                <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
            </div>

            <div class="banner banner-corto">
                <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
            </div>

            <div class="banner banner-corto">
                <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
            </div>

            <div class="banner banner-corto">
                <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
            </div>

            <div class="banner banner-corto">
                <a href="#"><img src="http://placehold.it/320x100" alt="Banner 320x120"></a>
            </div>

            <div class="clearfix"></div>

        </div>

    </div>
</div>

<div class="clearfix"></div>


<footer>
    <div class="wrap">

        <div class="bicolor">
            <span class="azul"></span>
            <span class="rojo"></span>
        </div>

        <div class="top">

            <div class="listas">

                <div class="lista">
                    <h5>Enlaces 1</h5>
                    <ul>
                        <li><a href="#">Item 1</a></li>
                        <li><a href="#">Item 2</a></li>
                        <li><a href="#">Item 3</a></li>
                        <li><a href="#">Item 4</a></li>
                        <li><a href="#">Item 5</a></li>
                        <li><a href="#">Item 6</a></li>
                        <li><a href="#">Item 7</a></li>
                    </ul>
                </div>

                <div class="lista">
                    <h5>Enlaces 2</h5>
                    <ul>
                        <li><a href="#">Item 1</a></li>
                        <li><a href="#">Item 2</a></li>
                        <li><a href="#">Item 3</a></li>
                        <li><a href="#">Item 4</a></li>
                        <li><a href="#">Item 5</a></li>
                        <li><a href="#">Item 6</a></li>
                        <li><a href="#">Item 7</a></li>
                    </ul>
                </div>

                <div class="lista">
                    <h5>Enlaces 3</h5>
                    <ul>
                        <li><a href="#">Item 1</a></li>
                        <li><a href="#">Item 2</a></li>
                        <li><a href="#">Item 3</a></li>
                        <li><a href="#">Item 4</a></li>
                        <li><a href="#">Item 5</a></li>
                        <li><a href="#">Item 6</a></li>
                        <li><a href="#">Item 7</a></li>
                    </ul>
                </div>


            </div>

            <div class="clearfix"></div>
            <div class="sep"></div>

        </div>

        <div class="bottom">

            <div class="left">
                <span>Dirección Lorem Ipsum 1234 - Teléfono: <a href="tel:+56 2 12341234">+56 2 12341234</a></span>
            </div>

            <nav>
                <ul>
                    <li><a href="#">Polística de Privacidad</a></li>
                    <li><a href="#">Enlace 2</a></li>
                    <li><a href="#">Enlace 3</a></li>
                </ul>
            </nav>

            <div class="clearfix"></div>

            <div class="bicolor">
                <span class="azul"></span>
                <span class="rojo"></span>
            </div>

        </div>

    </div>

</footer>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="{{ asset('asset/js/main.js') }}" ></script>

<script type="text/javascript">
    window.___gcfg = {lang: 'es-419'};
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</body>
</html>
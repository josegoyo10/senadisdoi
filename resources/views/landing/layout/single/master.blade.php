<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9">
<link rel="stylesheet" href="css/ie8.css">
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

    <title>Título</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"  />

</head>
<body class="single">

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
                <li><a href="#">Item Menú 1</a></li>
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
                <li><a href="#">Item Menú 4</a></li>
                <li><a href="#">Item Menú 5</a></li>
            </ul>
        </nav>
    </div>
</div>

<header style="background-image:url('http://placehold.it/1920x1440')">
    <div class="wrap">

        <h1 id="logo-main">
            <a href="/">
                <img src="{{ asset('asset/img/logo-main.png') }}">
            </a>
        </h1>

        <nav id="menu-principal">
            <ul id="menu-main-menu" class="menu-main">
                <li><a href="/">Inicio</a></li>
                <li><a href="#">Item Menú 1</a></li>
                <li><a href="#">Item Menú 2</a>
                    <ul class="sub-menu">
                        <li><a href="#">Item Sub-menú 1</a></li>
                        <li><a href="#">Item Sub-menú 2</a></li>
                        <li><a href="#">Item Sub-menú 3</a></li>
                    </ul>
                </li>
                <li><a href="#">Item Menú 3</a>
                    <ul class="sub-menu">
                        <li><a href="#">Item Sub-menú 1</a></li>
                        <li><a href="#">Item Sub-menú 2</a></li>
                    </ul>
                </li>
                <li><a href="#">Item Menú 4</a></li>
                <li><a href="#">Item Menú 5</a></li>
            </ul>
        </nav>

        <a href="#" id="menu-movil-trigger">Menú Principal</a>

    </div>
</header>

<div id="content">

    <div class="wrap">

        <div id="main">

            <div id="breadcrumbs">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li class="sep">/</li>
                    <li><a href="#">Noticias »</a></li>

                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="post">

                <div class="pic">
                    <img src="http://placehold.it/660x300" alt="">
                </div>

                <div class="clearfix"></div>

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

                <div class="fontsize">
                    <ul>
                        <li class="small"><a data-size="10">a</a></li>
                        <li class="medium current"><a data-size="14">a</a></li>
                        <li class="large"><a data-size="20">a</a></li>
                    </ul>
                </div>

                <div class="clearfix"></div>

                <div class="texto">
                    <span class="meta">Junio 20, 2014</span>
                    <h3 class="title">Quisque accumsan lorem at metus pulvinar, vitae iaculis est convallis.</h3>

                    <div class="contenido">
                        <h4>Nullam tempor porta fermentum. Donec cursus, ligula quis pulvinar semper, erat odio lobortis nunc, ac dapibus erat diam ac mi. Maecenas porttitor rhoncus ornare. Quisque.</h4>

                        <p>Nullam ultrices <strong>vehicula nisi et pulvinar</strong>. Sed vitae ullamcorper augue. Nulla viverra hendrerit ipsum, non vehicula dui dignissim nec. Cras lobortis, libero quis mollis semper, dolor enim sollicitudin enim, vel hendrerit dui nisl eu dui. Cras felis dui, <em>ullamcorper eget mattis et</em>, vulputate in diam. Mauris vehicula laoreet lacus vel egestas. Nunc sit amet ante sollicitudin, tempor dui ac, sagittis risus. Fusce vel dui ut sapien sagittis dapibus. Nam pulvinar odio quis iaculis cursus. Nunc et <a href="#">neque eget arcu auctor blandit</a>. Donec placerat quam ut risus ultrices, at sollicitudin elit imperdiet. Vivamus felis est, consequat vitae sem in, elementum imperdiet sem. Proin adipiscing rutrum arcu, sit amet facilisis ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse vel lectus sodales, aliquam orci at, malesuada augue.</p>

                        <ol>
                            <li>Cum sociis natoque penatibus</li>
                            <ol>
                                <li>Proin adipiscing rutrum</li>
                                <li>Nulla viverra hendrerit</li>
                                <li>Fusce vel dui ut</li>
                            </ol>
                            </li>
                            <li>Donec placerat quam ut</li>
                            <li>Nunc et neque eget
                        </ol>

                        <p><blockquote>Aliquam erat volutpat. Donec rhoncus ipsum nec vehicula commodo. Nulla vitae consectetur velit. Aenean mattis, urna id viverra ultrices, magna massa accumsan dolor, sit amet commodo enim purus ut arcu.</blockquote></p>

                        <ul>
                            <li>Cras felis dui</li>
                            <li>Vivamus felis est consequat
                                <ul>
                                    <li>Proin adipiscing rutrum</li>
                                    <li>Nulla viverra hendrerit</li>
                                    <li>Fusce vel dui ut</li>
                                </ul>
                            </li>
                            <li>Cras lobortis, libero</li>
                        </ul>

                        <p>Nullam ultrices vehicula nisi et pulvinar. Sed vitae ullamcorper augue. Nulla viverra hendrerit ipsum, non vehicula dui dignissim nec. Cras lobortis, libero quis mollis semper, dolor enim sollicitudin enim, vel hendrerit dui nisl eu dui. Cras felis dui, ullamcorper eget mattis et, vulputate in diam. Mauris vehicula laoreet lacus vel egestas. Nunc sit amet ante sollicitudin, tempor dui ac, sagittis risus. Fusce vel dui ut sapien sagittis dapibus. Nam pulvinar odio quis iaculis cursus. Nunc et neque eget arcu auctor blandit. Donec placerat quam ut risus ultrices, at sollicitudin elit imperdiet. Vivamus felis est, consequat vitae sem in, elementum imperdiet sem. Proin adipiscing rutrum arcu, sit amet facilisis ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse vel lectus sodales, aliquam orci at, malesuada augue.</p>

                        <p>Sed vitae ullamcorper augue. Nulla viverra hendrerit ipsum, non vehicula dui dignissim nec. Cras lobortis, libero quis mollis semper, dolor enim sollicitudin enim, vel hendrerit dui nisl eu dui.</p>

                    </div>

                </div>
                <div class="clearfix"></div>

            </div>

        </div>

        <div id="sidebar">

            <div class="redes-lista">
                <h5 class="titulo-seccion">Síguenos</h5>
                <ul>
                    <li id="facebook">
                        <a class="clearfix" href="#">
                            <span class="icono"></span>
                            <div class="texto">
                                <span class="red">Facebook</span>
                                <span class="usuario">usuario</span>
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
                    <li><a href="#">Política de Privacidad</a></li>
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

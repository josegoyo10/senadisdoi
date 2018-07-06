<head>
    <meta charset="UTF-8">
    <title>IMDIS - @yield('htmlheader_title', 'IMDIS') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/css/senadis.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="/css/calendario.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/img/ministerio/favicon.ico"  />

      <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
         
          <script src="/js/calendar.js" type="text/javascript"></script>
          <script src="/js/calendar-es.js" type="text/javascript"></script>
          <script src="/js/calendar-setup.js" type="text/javascript"></script>
          <!----Js para validacion de aprobar o rechazar encuesta !-->
          <script src="/js/validator.js"></script>
          <!-- Js para reportes!-->
          <script src="/js/reportes/reportes.js"></script>
        
</head>

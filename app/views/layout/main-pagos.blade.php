<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistema de facturación y pagos WebMachine">
        <meta name="author" content="Est">
        
        <title>ERP 2015 - WebMachine</title>
        
        <script src="{{ URL::to('js/jquery-1.10.2.js') }}"></script>
        <script src="{{ URL::to('js/jquery-ui.js') }}"></script>
        <script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::to('js/jquery.bxslider.min.js') }}"></script>
        <script src="{{ URL::to('js/jquery.js') }}"></script>
        <script src="{{ URL::to('js/jquery-ui.min.js') }}"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        
        <script type="text/javascript" src="{{ URL::to('js/bootstrap-filestyle.js') }}"> </script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script> <!-- Gráficos -->
        <link rel="stylesheet" href="{{ URL::to('css/menufix.css') }}"> <!-- Posición del menú superior -->
        <link rel="stylesheet" href="{{ URL::to('css/footer.css') }}">  <!-- Footer -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/dark-hive/jquery-ui.css"> <!-- Tema dark -->
        <link rel="stylesheet" href="{{ URL::to('css/estilo.css') }}"> <!-- Ajustes varios -->
        
        <link rel="stylesheet" href="{{ URL::to('css/jquery-ui.css') }}">   
        <link rel="stylesheet" href="{{ URL::to('css/bootstrap.min.css') }}">
               
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> <!-- Íconos -->
    </head>
    <body>
        @if(Session::has('global'))
        <div class="container">
            <div class="bs-example bs-example-bg-classes">

                <div class=" div bg-success f25" style="padding: 10px; color: #3c763d; margin-bottom: 10px"><b>{{ Session::get('global') }} <i class="fa fa-smile-o"></i></b></div>

            </div>        
        </div>

        @endif

        @include('layout.navigation-pagos')
        @yield('content-pagos')
        <div id="footer">
            <div class="container texto-centrado" style="filter:alpha(opacity=50); opacity:0.5; font-size: 11px;">
                <img  src="{{ URL::to('images/logo_pequeño.png') }}"> Development by Est <i class="fa fa-copyright"></i> 2015 
               
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
              $( "#tabs" ).tabs();
              $( document ).tooltip();
              $( "#accordion" ).accordion({
                collapsible: true,
                heightStyle: "content"
              });
            });
        </script>
    </body>        
</html>
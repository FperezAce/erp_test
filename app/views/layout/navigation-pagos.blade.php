<div class="navbar-inverse navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">           
            @if(Auth::check())
            <li><a href="{{ URL::route('erp') }}"><i class="fa fa-home fa-2x"></i> </a></li>
           
                 
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pagos<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('pagar-gasto') }}">Pagar gasto fijo</a></li>
                        <li><a href="{{ URL::route('ver-pagos-gastos') }}">Calendario gastos fijos</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::route('agregar-remuneracion') }}">Pagar remuneración</a></li>
                        <li><a href="{{ URL::route('ver-remuneracion') }}">Calendario remuneraciones</a></li>
                        <!--<li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gastos fijos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('agregar-gasto') }}">Agregar</a></li>
                        <li><a href="{{ URL::route('ver-gasto') }}">Ver</a></li>
                       <!-- <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funcionarios <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('agregar-funcionario') }}">Agregar</a></li>
                        <li><a href="{{ URL::route('ver-funcionarios') }}">Ver</a></li>
                       <!-- <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cargos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('agregar-cargo') }}">Agregar</a></li>
                        <li><a href="{{ URL::route('ver-cargos') }}">Ver</a></li>
                       <!-- <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contratos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('agregar-contrato') }}">Agregar</a></li>
                        <li><a href="{{ URL::route('ver-contratos') }}">Ver</a></li>
                       <!-- <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tipos de cargo <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('agregar-tipo-cargo') }}">Agregar</a></li>
                        <li><a href="{{ URL::route('ver-tipos-cargo') }}">Ver</a></li>
                       <!-- <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li> -->
                    </ul>
                </li>
                <li><a href="{{ URL::route('home') }}">Facturación</a></li>
                
            @else
                <li><a href="{{ URL::route('index') }}"><i class="fa fa-home fa-2x"></i> </a></li>
                <li><a href="{{ URL::route('account-sign-in') }}"><i class="fa fa-sign-in fa-2x"> Ingresar</i></a></li>   
            @endif
          
          </ul>
          <script>
                $('.dropdown-toggle').dropdown()
          </script>
          <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
                <li><a href="{{ URL::route('account-create') }}">Crear cuenta</a></li> 
                <li><a href="{{ URL::route('account-sign-out') }}"><i class="fa fa-sign-out fa-2x"></i></a>  <!--( {{ Auth::user()->name . ' '. Auth::user()->last_name }} )--></li>
              @endif         
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
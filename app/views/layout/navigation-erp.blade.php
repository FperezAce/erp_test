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
            
                
            @else
                <li><a href="{{ URL::route('index') }}"><i class="fa fa-home fa-2x"></i> </a></li>
                <li><h1><a href="{{ URL::route('account-sign-in') }}"><i class="fa fa-sign-in fa-2x"></i></a></h1></li>   
            @endif
          
          </ul>
            <script>
     $('.dropdown-toggle').dropdown()
</script>
          <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
              <li><a href="{{ URL::route('account-sign-out') }}"><i class="fa fa-sign-out fa-2x"></i>Cerrar sesiòn</a>  <!--( {{ Auth::user()->name . ' '. Auth::user()->last_name }} )--></li>
              @endif         
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
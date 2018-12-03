@extends('layout.main-pagos')

@section('content-pagos')
<div class="container">
    <div class="titulo-pagos">
    <h1><i class="fa fa-chevron-right"></i> CONFIGURACIONES</h1>
</div>
    
    <div style="overflow: hidden; width: 100%;" class="padding-30">
        <a href="{{ URL::route('ver-usuarios') }}">
            <div class="col-md-3 facturas-asociadas texto-centrado f25 pointer"><b><i class="fa fa-users "></i> USUARIOS</b></div>
        </a>
        <a href="{{ URL::route('ver-funcionarios') }}">
            <div class="col-md-3 facturas-asociadas texto-centrado f25 pointer"><b><i class="fa fa-users "></i> FUNCIONARIOS</b></div>
        </a>
    </div>  
    @yield('content-configuracion-pagos')
</div>
@stop
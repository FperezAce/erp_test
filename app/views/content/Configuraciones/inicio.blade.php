@extends('layout.main')

@section('content')
<div class="div">
    <div class="div fuente-blanca azul-principal">
        <h1><i class="fa fa-chevron-right"></i> Configuraciones</h1>
    </div>
    
    <div class="div" style="width: 100%; overflow: hidden;">
        <a href="{{ URL::route('ver-clientes') }}">
            <div class="col-md-3 facturas-asociadas texto-centrado f25 pointer"><b><i class="fa fa-users"></i> CLIENTES</b></div>
        </a>
        <a href="{{ URL::route('ver-usuarios') }}">
            <div class="col-md-3 facturas-asociadas texto-centrado f25 pointer"><b><i class="fa fa-users "></i> USUARIOS</b></div>
        </a>
    </div>  
    @yield('content-configuracion')
</div>
@stop
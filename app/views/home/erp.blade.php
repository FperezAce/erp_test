@extends('layout.main-erp')

@section('content-erp')
<div class="container">
    <div class="jumbotron">
        <h1><i class="fa fa-chevron-right"></i> ERP WEBMACHINE 2015</h1>
        <div style="overflow: hidden; width: 100%;">
            <a href="{{ URL::route('home') }}">
                <div class="col-md-3 totales-propios-rojo texto-centrado f25 pointer"><b><i class="fa fa-users"></i> FACTURACIÓN</b></div>
            </a>
            <a href="{{ URL::route('ver-remuneracion') }}">
                <div class="col-md-3 datos-generales texto-centrado f25 pointer"><b><i class="fa fa-folder"></i> REMUNERACIONES </b></div>
            </a>
            <a href="{{ URL::route('ver-pagos-gastos') }}">
                <div class="col-md-3 totales-propios azul-secundario texto-centrado f25 pointer"><b><i class="fa fa-folder"></i> GASTOS FIJOS </b></div>
            </a>
        </div>     
    </div>
</div>
@stop

@extends('layout.main')

@section('content')

    <div class="container">
        @if(Auth::check())
        <h3>Hola, {{ Auth::user()->username}}</h3>
        @else
        <p> no estas logeado</p>
        @endif
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
          <div class="row">
              <div style="filter:alpha(opacity=50); opacity:0.9;"><img src="{{ URL::to('images/logo.png') }}"></div>
             
              <div><h1>ERP 2015</h1></div>
          </div>
          
      </div>
    </div>
@stop
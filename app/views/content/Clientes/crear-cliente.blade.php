@extends('layout.main')

@section('content')

<div class="container">
    <div class="div azul-principal fuente-blanca">
        <h1><i class="fa fa-chevron-right"></i> Crear cliente</h1>
    </div>
      <!-- Main component for a primary marketing message or call to action -->
   
          <div class="div">
              
         
        {{ Form::open(array('url' => 'crear-cliente', 'class' => 'form-horizontal', 'files' => true )) }}
        <div class="form-group">
            {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Ingrese nombre de cliente'), Input::old('name'))}}
                @if($errors->has('name'))
                {{ $errors->first('name') }}
                @endif
            </div>
            @if($errors->has('name'))
            {{ '*' }}
            @endif
        </div>
        
    
        <div class="form-group">
            {{ Form::label('rut', 'RUT', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('rut', null, array('class' => 'form-control', 'placeholder' => 'Rut de cliente'), Input::old('rut'))}}
                @if($errors->has('rut'))
                {{ $errors->first('rut') }}
                @endif
            </div>
            @if($errors->has('rut'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('tefono', 'TELÉFONO', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('fono', null, array('class' => 'form-control', 'placeholder' => 'Ingrese número de teléfono'), Input::old('fono'))}}
                @if($errors->has('fono'))
                {{ $errors->first('fono') }}
                @endif
            </div>
            @if($errors->has('fono'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('mail', 'EMAIL', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('mail', null, array('class' => 'form-control', 'placeholder' => 'Ingrese email de cliente'), Input::old('mail'))}}
                @if($errors->has('mail'))
                {{ $errors->first('mail') }}
                @endif
            </div>
            @if($errors->has('mail'))
            {{ '*' }}
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('tipo', 'TIPO', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                <b>PROPIO </b>
                {{ Form::radio('tipo', '1',true)}}
                <b> ALIANZA </b>
                {{ Form::radio('tipo', '2')}}
                
                @if($errors->has('tipo'))
                {{ $errors->first('tipo') }}
                @endif
            </div>
            @if($errors->has('tipo'))
            {{ '*' }}
            @endif
        </div>
        
            
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('AGREGAR', array('class' => 'btn azul-terciario fuente-blanca'))}}        
            </div>
        </div>
            {{ Form::token() }}
            {{ Form::close() }}
  
          </div>
    
@stop

      
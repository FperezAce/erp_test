@extends('layout.main-pagos')

@section('content-pagos')

<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Agregar tipos de cargo</h1>
</div>
<div>
    {{ Form::open(array('url' => 'agregar-tipo-cargo', 'class' => 'form-horizontal', 'files' => true )) }}
    <div class="form-group">
        {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' => 'Ingrese nombre del tipo de cargo'), Input::old('nombre'))}}
            @if($errors->has('nombre'))
            {{ $errors->first('nombre') }}
            @endif
        </div>
        @if($errors->has('nombre'))
        {{ '*' }}
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('color', 'COLOR DE ETIQUETA', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::input('color', 'car_color', null, array('class' => 'input-big form-control')) }}
            @if($errors->has('color'))
            {{ $errors->first('color') }}
            @endif
        </div>
        @if($errors->has('color'))
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
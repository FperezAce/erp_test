@extends('layout.main-pagos')

@section('content-pagos')

<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Agregar cargo</h1>
</div>
<div>
    {{ Form::open(array('url' => 'agregar-cargo', 'class' => 'form-horizontal', 'files' => true )) }}
    <div class="form-group">
        {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' => 'Ingrese nombre del cargo'), Input::old('nombre'))}}
            @if($errors->has('nombre'))
            {{ $errors->first('nombre') }}
            @endif
        </div>
        @if($errors->has('nombre'))
        {{ '*' }}
        @endif
    </div>
    
    <div class="form-group">
        {{ Form::label('descripcion', 'DESCRIPCIÓN', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'placeholder' => 'Ingrese descripción'), Input::old('descripcion'))}}
            @if($errors->has('descripcion'))
            {{ $errors->first('descripcion') }}
            @endif
        </div>
        @if($errors->has('descripcion'))
        {{ '*' }}
        @endif

    </div>
    
    <div class="form-group">
        {{ Form::label('tipo', 'TIPO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::select('tipo', $tipos_combo, $selected, array('class'=> 'form-control')) }}
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
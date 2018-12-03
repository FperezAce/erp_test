@extends('layout.main-pagos')

@section('content-pagos')

<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Agregar funcionario</h1>
</div>
<div>
    {{ Form::open(array('url' => 'agregar-funcionario', 'class' => 'form-horizontal', 'files' => true )) }}
    <div class="form-group">
        {{ Form::label('nombre', 'NOMBRES', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('nombre', null, array('class' => 'form-control', 'placeholder' => 'Ingrese nombres'), Input::old('nombre'))}}
            @if($errors->has('nombre'))
            {{ $errors->first('nombre') }}
            @endif
        </div>
        @if($errors->has('nombre'))
        {{ '*' }}
        @endif
    </div>
    
    <div class="form-group">
        {{ Form::label('apellido', 'APELLIDOS', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('apellido', null, array('class' => 'form-control', 'placeholder' => 'Ingrese apellidos'), Input::old('apellido'))}}
            @if($errors->has('apellido'))
            {{ $errors->first('apellido') }}
            @endif
        </div>
        @if($errors->has('apellido'))
        {{ '*' }}
        @endif
    </div>
    
    <div class="form-group">
        {{ Form::label('cargo', 'CARGO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::select('cargo', $cargos_combo, $selected, array('class'=> 'form-control')) }}
        @if($errors->has('cargo'))
        {{ $errors->first('cargo') }}
        @endif
        </div>
        @if($errors->has('cargo'))
        {{ '*' }}
        @endif
    </div>
    
    <div class="form-group">
        {{ Form::label('bruto', 'MONTO BRUTO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('bruto', null, array('class' => 'form-control', 'placeholder' => 'Ingrese monto bruto', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'), Input::old('bruto'))}}
            @if($errors->has('bruto'))
            {{ $errors->first('bruto') }}
            @endif
        </div>
        @if($errors->has('bruto'))
        {{ '*' }}
        @endif
    </div>
    
    <div class="form-group">
        {{ Form::label('liquido', 'MONTO LÍQUIDO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('liquido', null, array('class' => 'form-control', 'placeholder' => 'Ingrese monto liquido', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'), Input::old('liquido'))}}
            @if($errors->has('liquido'))
            {{ $errors->first('liquido') }}
            @endif
        </div>
        @if($errors->has('liquido'))
        {{ '*' }}
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('contrato', 'TIPO DE CONTRATO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::select('contrato', $contratos_combo, $selected, array('class'=> 'form-control')) }}
        @if($errors->has('contrato'))
        {{ $errors->first('contrato') }}
        @endif
        </div>
        @if($errors->has('contrato'))
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

<script>

    $(function() {
        $("#fecha").datepicker({
            dateFormat: "yy-mm-dd",
            numberOfMonths: 3,
            showButtonPanel: true
        });
    });

</script>
@stop
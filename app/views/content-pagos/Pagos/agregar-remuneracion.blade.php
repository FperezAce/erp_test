@extends('layout.main-pagos')

@section('content-pagos')

<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Agregar Pago</h1>
</div>
<div>
    {{ Form::open(array('url' => 'agregar-remuneracion', 'class' => 'form-horizontal', 'files' => true )) }}
    <div class="form-group">
        {{ Form::label('funcionario', 'FUNCIONARIO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::select('funcionario', $funcionarios_combo, $selected, array('class'=> 'form-control'), Input::old('funcionario')); }}
        </div>
        @if($errors->has('funcionario'))
        {{ $errors->first('funcionario') }}
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
        {{ Form::label('bruto', 'MONTO LÍQUIDO', array('class' => 'col-sm-2 control-label'))}}
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
        {{ Form::label('pdf', 'BOLETA', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::file('boleta', array('class' => 'filestyle'), Input::old('boleta'))}}
            @if($errors->has('boleta'))
            {{ $errors->first('boleta') }}
            @endif 
        </div>
        @if($errors->has('boleta'))
        {{ '*' }}
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('pdf', 'COMPROBANTE', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::file('comprobante', array('class' => 'filestyle'), Input::old('comprobante'))}}
            @if($errors->has('comprobante'))
            {{ $errors->first('comprobante') }}
            @endif
        </div>
        @if($errors->has('comprobante'))
        {{ '*' }}
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('fecha', 'FECHA', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3"> 
            {{ Form::text('fecha', null, array('class' => 'form-control', 'placeholder' => 'Ingrese fecha', 'id' => 'fecha'), Input::old('fecha'))}}
            @if($errors->has('fecha'))
            {{ $errors->first('fecha') }}
            @endif
        </div>
        @if($errors->has('fecha'))
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
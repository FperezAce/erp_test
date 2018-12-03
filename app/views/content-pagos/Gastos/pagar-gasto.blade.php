@extends('layout.main-pagos')

@section('content-pagos')

<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Pagar gasto fijo</h1>
</div>
<div>
    {{ Form::open(array('url' => 'pagar-gasto', 'class' => 'form-horizontal', 'files' => true )) }}
    <div class="form-group">
        {{ Form::label('gasto', 'GASTO FIJO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::select('gasto', $gastos_combo, $selected, array('class'=> 'form-control'), Input::old('gasto')); }}
        </div>
        @if($errors->has('gasto'))
        {{ $errors->first('gasto') }}
        @endif
    </div>
    
    <div class="form-group">
        {{ Form::label('monto', 'MONTO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::text('monto', null, array('class' => 'form-control', 'placeholder' => 'Ingrese monto', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'), Input::old('monto'))}}
            @if($errors->has('monto'))
            {{ $errors->first('monto') }}
            @endif
        </div>
        @if($errors->has('monto'))
        {{ '*' }}
        @endif
    </div>

    <!--<div class="form-group">
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
-->
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
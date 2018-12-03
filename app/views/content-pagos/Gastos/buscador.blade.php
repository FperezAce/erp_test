@extends('layout.main-pagos')

@section('content-pagos')



<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Calendario gastos fijos</h1>
</div>
<div>
    {{ Form::open(array('url' => 'ver-pagos-gastos', 'class' => 'form-horizontal', 'files' => true )) }}
    <div class="form-group">
        {{ Form::label('ano', 'AÑO', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            <select class="form-control" name="ano">
                <?php
                
                foreach (range(2014, (int) date("Y")) as $year) {
                    echo "\t<option value='" . $year . "'>" . $year . "</option>\n\r";
                }
                ?>
            </select>
            @if($errors->has('ano'))
            {{ $errors->first('ano') }}
            @endif
        </div>
        @if($errors->has('bruto'))
        {{ '*' }}
        @endif
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('BUSCAR', array('class' => 'btn azul-terciario fuente-blanca'))}}        
        </div>
    </div>
    {{ Form::token() }}
    {{ Form::close() }}
</div>
@yield('ver-pagos-gastos')
@stop


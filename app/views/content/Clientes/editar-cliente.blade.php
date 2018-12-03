@extends('content.Clientes.ver-clientes')

@section('editar-cliente')
<div class="facturas-asociadas">
    <h1><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar Cliente</h1>
    
    {{ Form::open(array('url' => 'editar-cliente', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('nombre',  $cliente->nombre, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('rut', 'RUT', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('rut',  $cliente->rut, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('email', 'EMAIL', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('mail',  $cliente->mail, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('telefono', 'TELÉFONO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('fono',  $cliente->fono, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Editar', array('class' => 'btn btn-primary'))}}        
            </div>
        </div>
    {{ Form::hidden('id',  $cliente->id, array('class' => 'form-control')) }}
        {{ Form::token() }}
    {{ Form::close() }}
</div>

@stop
@extends('content-pagos.Contratos.ver-contratos')

@section('editar-contrato')
<div class="div azul-terciario fuente-blanca" style="margin-top: 55px;">
    <h1><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar Contrato</h1>
</div>
<div class="div">
    @foreach($contrato as $c)
    {{ Form::open(array('url' => 'editar-contrato', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('nombre',  $c->nombre, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Editar', array('class' => 'btn azul-terciario fuente-blanca'))}}        
            </div>
        </div>
    {{ Form::hidden('id',  $c->id, array('class' => 'form-control')) }}
        {{ Form::token() }}
    {{ Form::close() }}
    @endforeach
</div>
@stop
@extends('content-pagos.Tipos.ver-tipos-cargo')

@section('editar-tipo')
<div class="div azul-terciario fuente-blanca" style="margin-top: 55px;">
    <h1><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar tipo de cargo</h1>
</div>
<div class="div">
    @foreach($tipo as $c)
    {{ Form::open(array('url' => 'editar-tipo-cargo', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('nombre',  $c->nombre, array('class' => 'form-control')) }}
                </div>
        </div>
    <div class="form-group">
                {{ Form::label('color', 'COLOR DE ETIQUETA', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::input('color', 'car_color', $c->color, array('class' => 'input-big form-control')) }}
                   
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
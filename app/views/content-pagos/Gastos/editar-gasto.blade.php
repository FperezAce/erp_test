@extends('content-pagos.Gastos.ver-gastos')

@section('editar-gasto')
<div class="div azul-terciario fuente-blanca" style="margin-top: 55px;">
    <h1><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar Gasto</h1>
</div>
<div class="div">
    {{ Form::open(array('url' => 'editar-gasto', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('nombre',  $gasto->nombre, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Editar', array('class' => 'btn azul-terciario fuente-blanca'))}}        
            </div>
        </div>
    {{ Form::hidden('id',  $gasto->id, array('class' => 'form-control')) }}
        {{ Form::token() }}
    {{ Form::close() }}
   
</div>
@stop
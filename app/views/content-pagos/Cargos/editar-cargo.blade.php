@extends('content-pagos.Cargos.ver-cargos')

@section('editar-cargo')
<div class="div azul-terciario fuente-blanca" style="margin-top: 55px;">
    <h1><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar Cargo</h1>
</div>
<div class="div">
    @foreach($cargo as $c)
    {{ Form::open(array('url' => 'editar-cargo', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('nombre',  $c->nombre, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('descripcion', 'DESCRIPCIÓN', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::textarea('descripcion',  $c->descripcion, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('job_type_id', 'TIPO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::select('tipo', $tipos_combo, $c->job_type_id, array('class'=> 'form-control')); }}
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
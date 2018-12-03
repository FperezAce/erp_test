@extends('content-pagos.Funcionarios.ver-funcionarios')

@section('editar-funcionario')
<div class="div azul-terciario fuente-blanca" style="margin-top: 55px;">
    <h1><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar Funcionario</h1>
</div>
<div class="div">
    @foreach($funcionario as $f)
    {{ Form::open(array('url' => 'editar-funcionario', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('nombre',  $f->nombre, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('apellido', 'APELLIDO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('apellido',  $f->apellido, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('salario_bruto', 'SALARIO BRUTO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('salario_bruto',  $f->salario_bruto, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('salario_liquido', 'SALARIO LÍQUIDO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('salario_liquido',  $f->salario_liquido, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('job_id', 'CARGO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::select('cargo', $cargos_combo, $f->jobs->id, array('class'=> 'form-control')); }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('job_id', 'CONTRATO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::select('contrato', $contratos_combo, $f->contract_types->id, array('class'=> 'form-control')); }}
                </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Editar', array('class' => 'btn azul-terciario fuente-blanca'))}}        
            </div>
        </div>
    {{ Form::hidden('id',  $f->id, array('class' => 'form-control')) }}
        {{ Form::token() }}
    {{ Form::close() }}
    @endforeach
</div>
@stop
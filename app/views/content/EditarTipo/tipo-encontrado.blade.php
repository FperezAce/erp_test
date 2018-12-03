@extends('content.EditarTipo.editar-tipo')

@section('tipo-encontrado')
<div class="div azul-secundario fuente-blanca">
    <h2><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> Editar Tipo <b>{{ $detalle_tipo->tipo}}</b>" </h2>
</div>

        {{ Form::open(array('url' => 'editart', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) }}        
        <div class="form-group">
            {{ Form::label('type_label', 'Tipo', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-5">
                {{ Form::text('type',  $detalle_tipo->tipo, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('code_label', 'Código', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('code',  $detalle_tipo->codigo, array('class' => 'form-control')) }}
                @if($errors->has('code'))
                    {{ $errors->first('code') }}
                @endif
            </div>
        </div>
        
        <div class="form-group">
            {{ Form::label('V', 'Valor', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('value',  $detalle_tipo->valor, array('class' => 'form-control')) }}
            </div>
        </div>
        
                {{ Form::hidden('id',  $detalle_tipo->id, array('class' => 'form-control')) }}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Editar', array('class' => 'btn btn-primary'))}}        
            </div>
        </div>   
        {{ Form::token() }}
        {{ Form::close() }} 
@stop
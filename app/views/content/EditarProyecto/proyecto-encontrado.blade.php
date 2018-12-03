@extends('content.EditarProyecto.editar-proyecto')

@section('proyecto-encontrado')
<div class="div azul-secundario fuente-blanca">
    <h2><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> Editar proyecto <b>{{ $detalle_proyecto->nombre}}</b></h2>
</div>

        {{ Form::open(array('url' => 'editar', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')) }}        
        <div class="form-group">
            {{ Form::label('nombre', 'Nombre', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-5">
                {{ Form::text('name',  $detalle_proyecto->nombre, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('oc', 'Orden de compra', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('orden_compra',  $detalle_proyecto->orden_compra, array('class' => 'form-control')) }}
                @if($errors->has('orden_compra'))
                    {{ $errors->first('orden_compra') }}
                @endif
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('fecha_oc', 'Fecha OC', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('fecha_orden_compra',  $detalle_proyecto->fecha_orden_compra, array('class' => 'form-control', 'id' => 'datepicker')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('it', 'Item', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('item',  $detalle_proyecto->item_comprado, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('V', 'Valor', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('valor',  $detalle_proyecto->valor, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('valor_uf', 'Uf del día', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                {{ Form::text('valor_uf',  $detalle_proyecto->valor_uf, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('pdf_label', 'PDF', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-2">
            <input type="file" name="archivo" class="filestyle">
        </div>
        </div>       
        <div class="form-group">
            {{ Form::label('na', 'Nombre Alianza', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-2">
                @if($detalle_proyecto->type == 1)
                    {{ Form::text('nombre_alianza',  $detalle_proyecto->nombre_alianza, array('class' => 'form-control', 'disabled')) }}
                @else
                    {{ Form::text('nombre_alianza',  $detalle_proyecto->nombre_alianza, array('class' => 'form-control')) }}
                @endif
            </div>
        </div>
        @if($facturas)
            @foreach($facturas as $factura)
                <div class="form-group">
                    {{ Form::label('na', 'Porcentaje Hito', array('class' => 'col-sm-2 control-label'))}}
                    <div class="col-sm-1">                  
                            {{ Form::text($factura->id,  $factura->porcentaje, array('class' => 'form-control')) }}              
                    </div>
                </div>
            @endforeach
        @endif
        <div class="form-group">
            {{ Form::label('porca', '% para Alianza', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-1">
                @if($detalle_proyecto->type == 1)
                    {{ Form::text('porcentaje_alianza',  $detalle_proyecto->porcentaje_alianza, array('class' => 'form-control','disabled')) }}
                @else
                    {{ Form::text('porcentaje_alianza',  $detalle_proyecto->porcentaje_alianza, array('class' => 'form-control')) }}
                @endif
                {{ Form::hidden('id',  $detalle_proyecto->id, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Editar', array('class' => 'btn btn-primary'))}}        
            </div>
        </div>   
        {{ Form::token() }}
        {{ Form::close() }} 
@stop
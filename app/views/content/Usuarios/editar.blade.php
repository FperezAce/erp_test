@extends('content.Usuarios.ver')

@section('editar-usuario')
<div class="facturas-asociadas">
    <h1><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Editar Usuario</h1>
    
    {{ Form::open(array('url' => 'editar-user', 'class' => 'form-horizontal')) }}
        <div class="form-group">
                {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('name',  $usuario->name, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('apellido', 'APELLIDO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('last_name',  $usuario->last_name, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('direccion', 'DIRECCIÓN', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('address',  $usuario->address, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('email', 'EMAIL', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('email',  $usuario->email, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('telefono', 'TELÉFONO', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    {{ Form::text('phone',  $usuario->phone, array('class' => 'form-control')) }}
                </div>
        </div>
        <div class="form-group">
                {{ Form::label('passs', 'CONTRASEÑA', array('class' => 'col-sm-2 control-label'))}}
                <div class="col-sm-5">
                    <input type="password" name="pass" class="form-control"> (dejar en blanco si no desea editar)
                </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
               
                 {{ Form::submit('Editar', array('class' => 'btn btn-primary'))}}        
            </div>
        </div>
    {{ Form::hidden('id',  $usuario->id, array('class' => 'form-control')) }}
        {{ Form::token() }}
    {{ Form::close() }}
</div>

@stop
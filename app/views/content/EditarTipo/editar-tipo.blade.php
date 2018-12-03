@extends('layout.main')

@section('content')
<div class="div azul-principal fuente-blanca">
    <h1><i class="fa fa-chevron-right"></i> Editar tipos</h1>
</div>
    <div class="div">
        
        {{ Form::open(array('url' => 'editar-tipo', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) }}        

        <div class="form-group">
            {{ Form::label('proyec', 'Tipos', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::select('tipos', $combobox, '', array('class'=> 'form-control')) }}
               
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Buscar', array('class' => 'btn btn-primary'))}}        
            </div>
        </div> 
        {{ Form::token() }}
        {{ Form::close() }} 
          
    </div> 
@yield('tipo-encontrado')
@stop
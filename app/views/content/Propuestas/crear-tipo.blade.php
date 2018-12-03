@extends('layout.main')

@section('content')

<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
          <h1><i class="fa fa-chevron-right"></i> Crear Tipo</h1> 
          {{ Form::open(array('url' => 'crear-tipo', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) }}        
        <div class="form-group">
            {{ Form::label('type_label', 'Tipo', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                <input type="text" name="type" class="form-control" placeholder="Enter Type" {{ Input::old('type') ? 'value="'.e(Input::old('type')).'"': '' }}>
                        @if($errors->has('type'))
                            {{ $errors->first('type') }}
                        @endif
            </div>
        </div>
          <div class="form-group">
            {{ Form::label('type_label', 'Código', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                <input type="text" name="code" class="form-control" placeholder="Enter Code" {{ Input::old('code') ? 'value="'.e(Input::old('code')).'"': '' }}>
                        @if($errors->has('code'))
                            {{ $errors->first('code') }}
                        @endif
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('value_label', 'Valor (UF)', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-1">
                <input type="text" name="value" class="form-control" placeholder="Enter Value" {{ Input::old('value') ? 'value="'.e(Input::old('value')).'"': '' }}>
                        @if($errors->has('value'))
                            {{ $errors->first('value') }}
                        @endif
            </div>
        </div>  
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                 {{ Form::submit('Crear', array('class' => 'btn btn-primary'))}}        
            </div>
        </div>   
        {{ Form::token() }}
        {{ Form::close() }} 
          
          
      </div>
</div>
@stop
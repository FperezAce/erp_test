@extends('layout.main')

@section('content')

<div class="container">
    <div class="div azul-principal fuente-blanca">
        <h1><i class="fa fa-chevron-right"></i> Crear proyecto</h1>
    </div>
      <!-- Main component for a primary marketing message or call to action -->
   
          <div class="div">
              
         
        {{ Form::open(array('url' => 'crear-proyecto', 'class' => 'form-horizontal', 'files' => true )) }}
        <div class="form-group">
            {{ Form::label('nombre', 'NOMBRE', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Ingrese nombre proyecto'), Input::old('name'))}}
                @if($errors->has('name'))
                {{ $errors->first('name') }}
                @endif
            </div>
            @if($errors->has('name'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('customer', 'CLIENTE', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::select('customer', $combobox, $selected, array('class'=> 'form-control')); }}
                @if($errors->has('customer'))
                {{ $errors->first('customer') }}
                @endif
            </div>
            <div class="col-sm-3">
                <a class="btn btn-primary" href="{{ URL::route('crear-cliente') }}"> <i class="fa fa-plus fa-lg"></i> Agregar</a>
            </div>
            @if($errors->has('customer'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('oc', 'ORDEN DE COMPRA', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('orden_compra', null, array('class' => 'form-control', 'placeholder' => 'Ingrese orden de compra'), Input::old('orden_compra'))}}
                @if($errors->has('orden_compra'))
                {{ $errors->first('orden_compra') }}
                @endif
            </div>
            @if($errors->has('orden_compra'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('fecha_oc', 'FECHA ORDEN DE COMPRA', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('purchase_date', null, array('class' => 'form-control', 'placeholder' => 'Ingrese fecha oc', 'id' => 'datepicker'), Input::old('purchase_date'))}}
                @if($errors->has('purchase_date'))
                {{ $errors->first('purchase_date') }}
                @endif
            </div>
            @if($errors->has('purchase_date'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('item', 'ITEM', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('item', null, array('class' => 'form-control', 'placeholder' => 'Ingrese item a comprar'), Input::old('item'))}}
                @if($errors->has('item'))
                {{ $errors->first('item') }}
                @endif
            </div>
            @if($errors->has('item'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('valor', 'VALOR', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('value', null, array('class' => 'form-control', 'placeholder' => 'Ingrese valor'), Input::old('value'))}}
                @if($errors->has('value'))
                {{ $errors->first('value') }}
                @endif
            </div>
            @if($errors->has('value'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
            {{ Form::label('uf', 'UF CORRESPONDIENTE', array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-3">
                {{ Form::text('valua_uf', null, array('class' => 'form-control', 'placeholder' => 'Clic para calcular', 'onclick' => 'putUF();', 'id' => 'value_uf'), Input::old('value_uf'))}}
                <p id="cargando" class="f15">Cargando UF <i class="fa fa-spinner fa-pulse"></i></p>
                <a href="http://www.sii.cl/pagina/valores/uf/uf2014.htm" target="_blank">Uf online</a>
                @if($errors->has('value'))
                {{ $errors->first('value') }}
                @endif
            </div>
            @if($errors->has('value'))
            {{ '*' }}
            @endif
        </div>
        
        <div class="form-group">
        {{ Form::label('pdf', 'PDF', array('class' => 'col-sm-2 control-label'))}}
        <div class="col-sm-3">
            {{ Form::file('archivo', array('class' => 'filestyle'), Input::old('archivo'))}}
            @if($errors->has('archivo'))
            {{ $errors->first('archivo') }}
            @endif 
        </div>
        @if($errors->has('archivo'))
        {{ '*' }}
        @endif
    </div>
        <h1>Hitos</h1>
     <table class="table" id="tabla">
         <tr>
            <td>Hito</td>
            <td><div class="col-lg-3"><input type="text" name="milestone" class="form-control" placeholder="Enter %" {{ Input::old('milestone') ? 'value="'.e(Input::old('milestone')).'"': '' }}></div>
                @if($errors->has('milestone'))
                    {{ $errors->first('milestone') }}
                @endif
            </td>                    
         </tr>               
    </table>
            <div id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-lg"></i> Hito</div>
            <input type="submit" value="Crear proyecto" class="btn btn-danger">
            {{ Form::token() }}
            {{ Form::close() }}
      </div>
          </div>
    
<script>
                          
            $(function() {
                $("#cargando").hide();
                
                
              $( "#datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",    
                numberOfMonths: 3,
                showButtonPanel: true
                
              });
              var count = 0;
              $("#agregar").on('click', function(){
                       count = count+1;       
                               
		$("#tabla tr:last").after('<tr><td>Hito</td>'
                        +'<td><div class="col-lg-3"><input type="text" class="form-control" name="'+count+'" placeholder="Enter %"></div></td>'
                        +'<td class="eliminar"><button class="btn btn-warning">Eliminar</buton></td></tr>');
              });
                
              $(document).on("click",".eliminar",function(){
		var parent = $(this).parents().get(0);
		$(parent).remove();
	       });
              
              
            });
            
    
            function putUF(){
                var date = $("#datepicker").val();
        
                $.ajax({
                    datatype: 'json',
                    url:'{{URL::to("/uf?date='+date+'")}}',
                    type: "post",
                    beforeSend: function(){
                     $("#cargando").show();
                    },
                    success: function(response){
                        $("#value_uf").val(response.valor);
                        $("#cargando").hide();
                    }
            
                }); 
            }
                      
</script>
@stop

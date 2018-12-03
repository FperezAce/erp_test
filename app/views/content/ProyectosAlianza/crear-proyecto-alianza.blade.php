@extends('layout.main')

@section('content')

<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
     
        <h1><i class="fa fa-chevron-right"></i> Crear proyecto Alianza</h1>
        <form action="{{ URL::route('crear-proyecto-alianza-post') }}" method="post"  enctype= "multipart/form-data">
            <table class="table table-hover" id="tabla">
                <tr>
                    <td width="15%">Nombre</td>
                    <td width="40%" colspan="3"><div class="col-lg-3"><input type="text" name="name" class="form-control" placeholder="Enter Name" {{ Input::old('name') ? 'value="'.e(Input::old('name')).'"': '' }}></div>
                        @if($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="15%">Nombre Alianza</td>
                    <td width="40%" colspan="3"><div class="col-lg-3"><input type="text" name="name_alianza" class="form-control" placeholder="Enter Alianza Name" {{ Input::old('name_alianza') ? 'value="'.e(Input::old('name_alianza')).'"': '' }}></div>
                        @if($errors->has('name_alianza'))
                            {{ $errors->first('name_alianza') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Cliente </td>
                    <td colspan="3"><div class="col-lg-3">{{ Form::select('customer', $combobox, $selected, array('class'=> 'form-control')); }}</div> 
                        <a class="btn btn-primary" href="{{ URL::route('crear-cliente') }}"> <i class="fa fa-plus fa-lg"></i> Agregar</a>
             
                    </td>                
                </tr>
                <tr>
                    <td>Orden de compra</td>
                    <td colspan="3"><div class="col-lg-3"><input type="text" name="orden_compra" class="form-control" placeholder="Enter Purchase order" {{ Input::old('orden_compra') ? 'value="'.e(Input::old('purchase_order')).'"': '' }}></div>
                        @if($errors->has('orden_compra'))
                            {{ $errors->first('orden_compra') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Fecha OC</td>
                    <td colspan="3">
                        <div class="col-lg-2"><p> <input name="purchase_date" type="text" id="datepicker" class="form-control" {{ Input::old('purchase_date') ? 'value="'.e(Input::old('purchase_date')).'"': '' }}></p></div>
                        @if($errors->has('purchase_date'))
                            {{ $errors->first('purchase_date') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Item a comprar</td>
                    <td colspan="3"><div class="col-lg-3"><input type="text" name="item" class="form-control" placeholder="Enter Item" {{ Input::old('item') ? 'value="'.e(Input::old('item')).'"': '' }}></div>
                        @if($errors->has('item'))
                            {{ $errors->first('item') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td colspan="3"><div class="col-lg-3"><input type="text" name="value" class="form-control" placeholder="Enter Value" {{ Input::old('value') ? 'value="'.e(Input::old('value')).'"': '' }}></div>
                        @if($errors->has('value'))
                            {{ $errors->first('value') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Uf del día</td>
                    <td colspan="3"><div class="col-lg-2"><input type="text" name="value_uf" id="value_uf" onclick="putUF();" class="form-control"> <p id="cargando">Calculando UF...</p><a href="http://www.sii.cl/pagina/valores/uf/uf2014.htm" target="_blank">Uf online</a></div>                     
                    </td>
                </tr>
                <tr >
                    <td>PDF</td>
                    <td colspan="3"><div class="col-lg-3"><input type="file" name="archivo" class="filestyle" data-input="false"></div>                   
                    </td>
                </tr>
                <tr>
                    <td>Hito</td>
                    <td><div class="col-lg-3"><input type="text" name="milestone" class="form-control" placeholder="Enter %" {{ Input::old('milestone') ? 'value="'.e(Input::old('milestone')).'"': '' }}></div>
                        @if($errors->has('milestone'))
                                {{ $errors->first('milestone') }}
                        @endif
                    </td>
                    <td><div class="col-lg-3"><input type="text" name="porcentaje_alianza" class="form-control" placeholder="Enter Alianza %" {{ Input::old('porcentaje_alianza') ? 'value="'.e(Input::old('porcentaje_alianza')).'"': '' }}></div>
                        @if($errors->has('milestone'))
                                {{ $errors->first('porcentaje_alianza') }}
                        @endif
                    </td>
                    <td></td>
                    
                </tr>              
            </table>
            <div id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-lg"></i> Hito</div>
            <input type="submit" value="Crear proyecto" class="btn btn-danger">
            {{ Form::token() }}
        </form>
        
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

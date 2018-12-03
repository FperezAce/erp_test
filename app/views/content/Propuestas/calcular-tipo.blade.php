@extends('layout.main')

@section('content')
<div class="container" >
    <div class="jumbotron" style="min-width: 1400px; overflow: hidden; float: left;">
        <form class="formGuardar">
        <h1><i class="fa fa-chevron-right"></i> Calcular tipo</h1>  
        
        </br>
            <table class="table-condensed table-responsive">
            <thead>
                <th>Tipos</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Valor UF <a href="http://www.sii.cl/pagina/valores/uf/uf2014.htm" target="_blank">ver online</a> </th>
                <th>Horas Diarias</th>
                <th>N° Días</th>
                <th>Horas totales</th>
                <th>Total</th>
                <th>PPM</th>
                <th>Gastos Asociados</th>
                <th>Utilidad</th>
            </thead>
            <tbody>
                <tr>
                    <td width="17%">
                        <div>
                            {{ Form::select('tipos', $combobox, '', array('class' => 'form-control', 'onchange' => 'cambiar(this.value)')) }}               
                        </div>    
                    </td>
                    <td>
                        <div>
                            {{ Form::text('codigo',  '', array('class' => 'form-control', 'id' => 'codigo')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('values',  '', array('class' => 'form-control', 'id' => 'values')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('cantidad',  '', array('class' => 'form-control', 'id' => 'cantidad')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            <input name="datepicker" type="text" id="datepicker" onmouseover="picker()"  class="form-control" {{ Input::old('datepicker') ? 'value="'.e(Input::old('datepicker')).'"': '' }}>
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('values_uf', '', array('class' => 'form-control', 'id' => 'values_uf', 'onclick' => 'putUF()')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('horas_diarias',  '', array('class' => 'form-control', 'id' => 'horas_diarias', 'onblur' => 'totales()')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('numeros_dias',  '', array('class' => 'form-control', 'id' => 'numeros_dias', 'onblur' => 'totales()')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('horas_totales',  '', array('class' => 'form-control', 'id' => 'horas_totales'  )) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('total2',  '', array('class' => 'form-control', 'id' => 'total2', 'onclick' => 'totalvalor2()')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('ppm',  '', array('class' => 'form-control', 'id' => 'ppm')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('gastos',  '', array('class' => 'form-control', 'id' => 'gastos', 'onblur' => 'utilidadgastos()')) }}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ Form::text('utilidad',  '', array('class' => 'form-control', 'id' => 'utilidad')) }}
                        </div>
                    </td> 
                  </tr>
                  <tr>                  
                      <td colspan="5">
                        <div>
                             
                        </div>
                    </td>
                    <td><b>Nombre</b></td>
                    <td colspan="6">
                       
                              {{ Form::text('name',  '', array('class' => 'form-control', 'id' => 'name')) }}
                    
                    </td>
                    <td>
                        <div>
                           <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o fa-lg"> Guardar todo</i></button>      
                        </div>
                    </td>
                  </tr>
                {{ Form::token() }}
                {{ Form::close() }} 
            </tbody>
        </table>
        <div class="bg-info pull-right" style="width: auto; padding: 15px; color: #3c763d; margin-bottom: 10px" id="resultado"></div>
        <div class="bg-warning pull-left" style="width: auto; padding: 15px; color: #FE9D36; margin-bottom: 10px" id="alerta"></div>
    </div>  
</div>
<script>
    $(document).ready(function(){
 
        $("#resultado").hide();
  
        $('#alerta').hide();

    });

    function picker(){
        $( "#datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",    
                numberOfMonths: 3,
                showButtonPanel: true
                
              });
    }
    
    function putUF(){
        var date = $("#datepicker").val();
        
        $.ajax({
            datatype: 'json',
            url:'{{URL::to("/uf?date='+date+'")}}',
            type: "post",
            beforeSend: function(){
                $("#resultado").show();
                $('#resultado').html("<b>calculando...</b>");
            },
            success: function(response){
                $("#values_uf").val(response.valor);
                $("#resultado").hide();
            }
            
        }); 
    }
    
    function cambiar(tipo){
        var id_ = tipo;
        
        $.ajax({
            data: id_,
            url:'{{URL::to("/detalles?data='+id_+'")}}',
            type: "post",
            beforeSend: function(){
                $("#resultado").show();
                $('#resultado').html("buscando...");
            },
            success: function(response){
                var valor = document.getElementById("values");
                var codig = document.getElementById("codigo");
                document.getElementById("cantidad").value = '';
                document.getElementById("values").value = '';
                document.getElementById("codigo").value = '';
                document.getElementById("horas_diarias").value = '';
                document.getElementById("numeros_dias").value = '';
                document.getElementById("horas_totales").value = '';
                document.getElementById("total2").value = '';
                document.getElementById("ppm").value = '';
                document.getElementById("gastos").value = '';
                document.getElementById("utilidad").value = '';

                valor.value = response.valor;
                codig.value = response.codigo;
                $("#guardado").hide();
                $("#resultado").hide();
                $("#alerta").show();
                
                $("#alerta").html('<i class="fa fa-exclamation-triangle"></i><b>Recuerde guardar antes de cambiar de tipo.</b>');
                
                
            }
            
        });      
    }
       
    function totales(){     
        var horas_diarias = document.getElementById("horas_diarias").value;
        var numero_dias   = document.getElementById("numeros_dias").value;
        
        $.ajax({
            datatype: 'json',
            url:'{{URL::to("/totales?horas_diarias='+horas_diarias+'&numero_dias='+numero_dias+'")}}',
            type: "post",
            beforeSend: function(){
                $("#resultado").show();
                $('#resultado').html("<b>calculando...</b>");
            },
            success: function(response){
                $("#horas_totales").val(response.valor);
                $("#resultado").show();
                $('#resultado').html("<b>Último valor calculado:</b></br> Horas diarias: "+response.valor)
            }
            
        });      
    }
    
    function totalvalor2(){ 
        var valor         = document.getElementById("values").value;
        var cantidad      = document.getElementById("cantidad").value;
        var valor_uf      = document.getElementById("values_uf").value;
        var horas_totales = document.getElementById("horas_totales").value;
        
        $.ajax({
            datatype: 'json',
            url:'{{URL::to("/totalvalor?valor='+valor+'&cantidad='+cantidad+'&valor_uf='+valor_uf+'&horas_totales='+horas_totales+'")}}',
            type: "post",
            beforeSend: function(){
                $("#resultado").show();
                $('#resultado').html("<b>calculando...</b>");
            },
            success: function(response){
                $("#total2").val(response.valor);
                $("#ppm").val(response.ppm);
                $("#resultado").show();
                $('#resultado').html("<b>Último valor calculado:</b></br> Total:  "+response.valor+" </br>PPM: "+response.ppm);
            }
            
        });      
    }
    
    function utilidadgastos(){ 
        var total         = document.getElementById("total2").value;
        var gastos        = document.getElementById("gastos").value;
        $.ajax({
            datatype: 'json',
            url:'{{URL::to("/utilidad?total='+total+'&gastos='+gastos+'")}}',
            type: "post",
            beforeSend: function(){
                $("#resultado").show();
                $('#resultado').html("<b>calculando...</b>");
            },
            success: function(response){
                $("#utilidad").val(response.valor);
                $("#resultado").show();
                $('#resultado').html("<b>Último valor calculado:</b></br> Utilidad: "+response.valor);
            }
            
        });      
    }
    
    $('.formGuardar').submit(function (e) {
                           
         e.preventDefault();
         var formData = new FormData($(this)[0]);
         
         $.ajax({
             type: 'post',
             url: '<?php echo URL::to('/guardar'); ?>',
             data: formData,
             cache:false,
             contentType: false,
             processData: false,
             async: false,
             dataType: 'json',
             success: function (data) {
                 
                    if (data.success == true){
                          $('#resultado').html('<b>'+data.mensaje+'</b>');
                    }
                    
                    if (data.success == false){
                          for (datos in data.mensaje){
                                $("#alerta").show();
                                $('#alerta').html('<i class="fa fa-exclamation-triangle"></i><b>'+' '+data.mensaje[datos]+'</b>');
                           }
                    }

             }
          });
     }); 
</script>
@stop
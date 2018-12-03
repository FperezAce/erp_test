@extends('layout.main')

@section('content')
<div class="container"  style="min-width: 100%;">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="container"> 
        <div class="div azul-principal fuente-blanca">
             <h1><i class="fa fa-chevron-right"></i> Proyectos alianza</h1>
        </div>
       
        <?php
        $final_total_emitido = 0;
        $final_total_por_emitir = 0;
        $final_total_cancelado = 0;
        $final_total_por_cancelar = 0;
        ?>
        @if($customers != false)
        <?php $c = 1; ?>
        <div id="accordion">
            @foreach ($customers as $customer)

            <h3  title="Haga clic para abrir o cerrar cliente"><i class="fa fa-user"></i> {{$customer->nombre}} ({{ $customer->projects->count() }})</h3>
            <div id="cliente-{{$customer->id }}">

                @if($customer->projects!= false)

                @foreach ($customer->projects as $project)
                <?php
                $fecha_orden_compra = new DateTime($project->fecha_orden_compra);
                ?>
                <div class="datos-generales">
                    <div class="row" style="width: 100%; margin-left: 10px;">
                        <div style="width: 50%; float: left;"><h1><i class="fa fa-folder-open"></i> <b>{{ $project->nombre  }}</b></h1></div>
                        <div style="width: 20%; float: right;">
                            <div class=" div azul-terciario texto-centrado fuente-blanca f20">
                                @if($project->situation_id != 1)
                                <a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('activar', [$project->id])}}"><i title="Activar proyecto" class="fa fa-check fa-2x hover-grey"></i></a> 
                                @endif
                                @if($project->situation_id != 2)
                                <a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('historico', [$project->id])}}"><i title="Mover proyecto a histórico" class="fa fa-book fa-2x hover-grey"></i></a>
                                @endif
                                @if($project->situation_id != 3)
                                <a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('eliminar', [$project->id])}}"><i title="Eliminar proyecto" class="fa fa-times fa-2x hover-grey"></i></a> 
                                @endif
                                @if($project->situation_id != 4)
                                <a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('terminar', [$project->id])}}"><i title="Finalizar proyecto" class="fa fa-flag-checkered fa-2x hover-grey"></i></a> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <table class="table">
        <tr>
            <th>NOMBRE</th><td>{{ $project->nombre  }}</td><th>OC</th><td>{{ $project->orden_compra  }} | <a style="text-decoration: none; color: white;" href="{{ URL::to('archivos/pdf/'.$project->pdf) }}" target="_blank"><i class="fa fa-file-pdf-o"></i> Ver pdf</a></td><th>ITEM</th><td>{{$project->item_comprado}}</td><th>HITOS</th><td> <?php $acum_porcentaje = 0; ?>
                                @foreach($project->bills as $hito)

                                {{ $hito->porcentaje}}%&nbsp; 
                                <?php $acum_porcentaje = $acum_porcentaje + $hito->porcentaje; ?>    
                                @endforeach

                                @if($acum_porcentaje < 100)
                                <div class="totales-propios-rojo texto-centrado">
                                    <b> FALTAN <?php echo 100 - $acum_porcentaje.'%'; ?> </b>
                                </div> 
                                <form action="{{ URL::route('editar-hito-post') }}" method="post">
                                    <table class="tablaporcentaje{{ $project->id }}" style="padding: 10px;">
                                        <tr>
                                            <td width="80px">
                                                <input type="text" class="form-control " name="hito">
                                            </td>
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
                                        <td>
                                            &nbsp;<i class="fa fa-plus fa-lg agregarporcentaje{{ $project->id }}"></i>
                                        </td>
                                        </tr>
                                    </table>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-lg"></i></button> 
                                </form>
                                <script>
                                            var count = 0
                                            $(".agregarporcentaje{{ $project->id }}").on('click', function(){
                                                count = count+1;       
                               

                                            $(".tablaporcentaje{{ $project->id }} tr:last").after('<tr>'
                                                        +'<td width="80px"><input type="text" class="form-control"  name="'+count+'"></td>'
                                                        +'<td></td>'
                                                        +'</tr>'
                                                        );
                                              });
                                </script>
                                @endif
            </td>
        </tr>
        <tr>
            <th>RUT {{ $customer->nombre }}</th><td>{{$customer->rut}}</td><th>FECHA OC</th><td>{{ $fecha_orden_compra->format('d-m-Y') }}</td><th>VALOR</th><td>{{ number_format($project->valor, 2, ',', '.')  }} UF - ($ {{number_format($project->valor*$project->valor_uf, '2', ',', '.')}})</td><th>VALOR UF</th><td>$ {{ number_format($project->valor_uf, 2, ',', '.')  }}</td>
        </tr>
    </table>
                </div>
                <div class="facturas-asociadas f10" style="width: auto;">
                    <h3><i class="fa fa-file"></i> <b>Facturas asociadas</b></h3>
                    <table class="table" id="tabla-proyecto-{{ $project->id }}">
                        <thead>
                        <th>NÚMERO</th>
                        <th>EMISIÓN</th>
                        <th>MONTO</th>
                        <th>HITO</th>
                        <th>F.PAGO</th>           
                        <th>PPM</th>
                        <th>FAC. WM</th>
                        <th></th>
                        <th></th>
                        <th>MONTO FACTURA {{$project->nombre_alianza}} A WM ({{$project->porcentaje_alianza}}%)</th>
                        <th>NÚMERO</th>
                        <th>FACTURA DE {{$project->nombre_alianza}} RECIBIDA?</th>
                        <th>PAGADO A {{$project->nombre_alianza}}</th>
                        <th>FAC RECIBIDA</th>
                        <th>COMPROBANTE</th>
                        <th>DESCARGAS</th>
                        </thead> 
                        <tbody>                                      
                            <?php
                            $contador = 0;
                            $suma_monto = 0;
                            $suma_cancelado = 0;
                            $suma_ppm = 0;
                            $suma_ganancia = 0;
                            ?>
                            @if($project->bills != false)
                            @foreach($project->bills as $bill)

                            <?php
                            //càlculo 20 dìas
                            //calculo de 20 dias habiles

                            $fecha1 = strtotime($bill->fecha_emision);
                            $fecha2 = strtotime(date('Y-m-d'));

                            $contador1 = 0;
                            for ($fecha1; $fecha1 <= $fecha2; $fecha1 = strtotime('+1 day ' . date('Y-m-d', $fecha1))) {
                                if ((strcmp(date('D', $fecha1), 'Sun') != 0) && (strcmp(date('D', $fecha1), 'Sat') != 0)) {
                                    $contador1 ++;
                                }
                            }
                            $clase = '';

                            if ($contador1 >= 15 && !$bill->fecha_cancelado) {
                                $clase = 'class="rojo"';
                            }

                            if (!$bill->fecha_emision) {
                                $clase = '';
                            }

                            $contador = $contador + 1;

                            if ($bill->fecha_emision) {

                                $fecha_emision = new DateTime($bill->fecha_emision);
                                $fecha_emision = $fecha_emision->format('d-m-Y');
                                $suma_monto = $suma_monto + $bill->monto;
                                $suma_ppm = $suma_ppm + $bill->ppm;
                            } else {

                                $fecha_emision = "";
                            }

                            if ($bill->fecha_cancelado) {

                                $fecha_cancelado = new DateTime($bill->fecha_cancelado);
                                $fecha_cancelado = $fecha_cancelado->format('d-m-Y');
                                $suma_cancelado = $suma_cancelado + $bill->monto;
                            } else {

                                $fecha_cancelado = "";
                            }
                            ?>
                            <tr {{$clase}}>
                        <form class="formGuardar">

                            <td width="5%"> <input type="text" name="numero" placeholder="{{ $bill->numero }}" value="{{ $bill->numero }}" class="form-control" > </td>
                            <td> <input type="text" name="fecha_emision" value="{{ $fecha_emision }}" class="fechaD form-control"></td>
                            <td> <input title="Monto esperado $ {{ number_format(($project->valor*$project->valor_uf)*$bill->porcentaje/100, 2, ',', '.') }} - {{$bill->porcentaje}}%"type="text" name="monto" value="{{ ($project->valor*$project->valor_uf)*$bill->porcentaje/100 }}" class="form-control" onblur="{{ 'ppm'.$bill->id}}();" id="monto-{{ $bill->id }}"></td>
                            <td width="15%"> <input type="text" name="hito" value="{{ $bill->hito }}" class="form-control"></td>                               
                            <td> <input type="text" name="fecha_cancelado" value="{{ $fecha_cancelado }} " class="fechaD form-control" id="fechado-{{ $bill->id}}"></td>
                            <td> <input type="text" name="ppm" value="{{(($project->valor*$project->valor_uf)*$bill->porcentaje/100)*0.035}}" class="form-control" id="ppm-{{ $bill->id }}"></td>
                            <td> <input type="file" name="archivo" class="filestyle" data-input="false"></td> 
                            <input type="hidden"  name="id" value="{{ $bill->id }}" class="form-control">
                            <input type="hidden"  name="project_id" value="{{ $project->id }}" class="form-control">
                            <input type="hidden"  name="monto_esperado" value="{{ ($project->valor*$project->valor_uf)*$bill->porcentaje/100 }}" class="form-control">
                            <td>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-lg"></i></button>                                               
                            </td>

                            <?php
                            $monto = ($project->valor * $project->valor_uf) * $bill->porcentaje / 100;
                            $suma_ganancia = $suma_ganancia + ($monto * (100 - $project->porcentaje_alianza)) / 100;
                            ?>
                            <td> <div class="botonPagado form-control btn-info" id="pagado-{{$bill->id}}" onclick="pagar{{$bill->id}}();"><i class="fa fa-dollar"></i></div></td>
                            <td width="6%"><input type="text"  name="monto_alianza" value="{{ $monto*$project->porcentaje_alianza/100 }}" class="form-control" ></td>
                            <td width="4%"><input type="text"  name="numero_alianza" value="{{ $bill->numero_alianza }}" class="form-control" ></td>                                            
                            <td width="5%">
                                <div class="radio">
                                    <label>
                                        <input type="checkbox" name="facturados" value="1" <?php
                                        if ($bill->factura_recibida == 1) {
                                            echo "checked";
                                        }
                                        ?>>
                                        Sí
                                    </label>

                                </div>

                            </td>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="checkbox" name="pagados"  value="1" <?php
                                        if ($bill->pagado == 1) {
                                            echo "checked";
                                        }
                                        ?>>
                                        Sí
                                    </label>

                                </div>                                               
                            </td>
                            <td> <input type="file" name="frecibidas" class="filestyle" data-input="false"></td>
                           <td> <input type="file" name="comprobante" class="filestyle" data-input="false"></td> 
                        </form>
                        <td>
                            <button id="button" type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo-{{$bill->id}}">
                                <i class="fa fa-cloud-download fa-2x"></i>  <b>ARCHIVOS</b>
                            </button>
                            <div id="demo-{{$bill->id}}" class="collapse">
                                <a style="text-decoration: none; color: white;" href="{{ URL::to('archivos/facturas/'.$bill->url) }}" target="_blank"><i class="fa fa-cloud-download"></i> Factura webmachine</a><br>
                                <a style="text-decoration: none; color: white;" href="{{ URL::to('archivos/facturas_recibidas/'.$bill->url_frecibida) }}" target="_blank"><i class="fa fa-cloud-download"></i> Factura alianza</a><br>
                                <a style="text-decoration: none; color: white;" href="{{ URL::to('archivos/comprobantes/'.$bill->url_comprobante) }}" target="_blank"><i class="fa fa-cloud-download"></i> Comprobante alianza</a>

                            </div>
                        </td>
                        
                        </tr>
                        <script>

                                    function ppm<?php echo $bill->id; ?>(){

                                    var monto = document.getElementById("monto-<?php echo $bill->id; ?>").value;
                                            document.getElementById("ppm-<?php echo $bill->id; ?>").value = monto * 0.035;
                                    }

                            function pagar<?php echo $bill->id ?>()
                            {
                            var date = new Date();
                                    var year = date.getFullYear();
                                    var month = (1 + date.getMonth()).toString();
                                    month = month.length > 1 ? month : '0' + month;
                                    var day = date.getDate().toString();
                                    day = day.length > 1 ? day : '0' + day;
                                    document.getElementById("fechado-<?php echo $bill->id; ?>").value = day + '-' + month + '-' + year;
                            }
                        </script>
                        @endforeach
                        @endif                                      
                        </tbody>
                    </table>
                </div>
                <div class="totales-proyecto">
                    <h3><i class="fa fa-calculator"></i> <b>TOTALES</b></h3>
                    <table class="table">
                        <tr>
                            <th>TOTAL EMITIDO</th>
                            <td>$ {{ number_format($suma_monto, 2, ',', '.') }}</td>
                            <th>TOTAL CANCELADO</th>
                            <td>$ {{ number_format($suma_cancelado, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th> TOTAL POR EMITIR</th>                                      
                            <td> $ {{ number_format($project->valor*$project->valor_uf - $suma_monto, 2, ',', '.') }}</td>
                            <th> TOTAL POR CANCELAR</th>
                            <td> $ {{ number_format($project->valor*$project->valor_uf - $suma_cancelado, 2, ',', '.') }}</td>
                            <?php
                            $final_total_emitido = $final_total_emitido + $suma_monto;
                            $final_total_por_emitir = $final_total_por_emitir + $project->valor * $project->valor_uf - $suma_monto;
                            $final_total_cancelado = $final_total_cancelado + $suma_cancelado;
                            $final_total_por_cancelar = $final_total_por_cancelar + $project->valor * $project->valor_uf - $suma_cancelado;
                            ?>
                        </tr>
                    </table> 
                </div>
                <hr class="div" style="background-color: black;">
                @endforeach
                @else
                <p>No hay proyectos</p>

                @endif
            </div>  <!-- div cliente -->
        <?php $c = $c + 1; ?>  
        
        @endforeach <!-- foreach clientes -->
        </div><!-- acordion -->
        @else
        <h4>No hay clientes</h4>
        @endif
        <div class="totales-propios-rojo">
            <table class="table"> <!-- TABLA TOTALES -->
            <thead>
            <th>Total Emitido</th>
            <th>Total por Emitir</th>
            <th>Total cancelado</th>
            <th>Total por Cancelar</th>
            </thead>
            <tbody>
                <tr>
                    <td><h3>$ {{number_format($final_total_emitido, 2, ',', '.')}}</h3></td>
                    <td><h3>$ {{number_format($final_total_por_emitir, 2, ',', '.')}}</h3></td>
                    <td><h3>$ {{number_format($final_total_cancelado, 2, ',', '.')}}</h3></td>
                    <td><h3>$ {{number_format($final_total_por_cancelar, 2, ',', '.')}}</h3></td>
                </tr>
            </tbody>
        </table>
        </div>
        
    </div> <!-- container secundario -->
</div> <!-- container principal -->
<script>
    $(document).ready(function() {


    $('.formGuardar').submit(function (e) {

    e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
            type: 'post',
                    url: '<?php URL::to('/ver-proyectos-alianza'); ?>',
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    async: false,
                    dataType: 'json',
                    success: function (data) {

                    if (data.success == true)
                    {
                    alert(data.mensaje)
                    }
                    if (data.success == false){
                    for (datos in data.mensaje){
                    alert(data.mensaje[datos])
                    }
                    }

                    }
            });
    });
            $(".fechaD").datepicker({
    dateFormat: "dd-mm-yy",
            numberOfMonths: 3,
            showButtonPanel: true

    });
            });
</script>      
@stop
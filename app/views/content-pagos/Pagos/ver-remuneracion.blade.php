@extends('content-pagos.Pagos.buscador')

@section('ver-pagos')
<?php
$meses = array(
    '1' => 'Enero',
    '2' => 'Febrero',
    '3' => 'Marzo',
    '4' => 'Abril',
    '5' => 'Mayo',
    '6' => 'Junio',
    '7' => 'Julio',
    '8' => 'Agosto',
    '9' => 'Septiembre',
    '10' => 'Octubre',
    '11' => 'Noviembre',
    '12' => 'Diciembre',
    '13' => 'tapa'
    );
$liquido = 0;$bruto = 0;
$totales_liquidos = array(
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0,
    11 => 0,
    12 => 0,
    13 => 0
    );
$totales_brutos = array(
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0,
    11 => 0,
    12 => 0,
    13 => 0
    );
?>
<hr> 
<div class="div">
   <h3><b>Año actual: {{$ano_actual}}</b></h3>
    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs" role="tablist">
        @for ($i = 1; $i <= 12; $i++)
            <li role="presentation"><a href="#{{$i}}" id="{{$i.'-tab'}}" role="tab" data-toggle="tab" aria-controls="{{$i}}" aria-expanded="false">{{$meses[$i]}}</a></li>
        @endfor
        <li role="presentation"><a href="#anual" id="anual-tab" role="tab" data-toggle="tab" aria-controls="anual" aria-expanded="false">Anual</a></li>
        <li role="presentation" class="active"><a href="#grafico" id="grafico-tab" role="tab" data-toggle="tab" aria-controls="grafico" aria-expanded="true">Gráficos</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
          <?php 
                    $diainicio = 1;
                    $diatermino = 2;      
            ?>
    @for ($ij = 1; $ij <= 12; $ij++)
            <?php
            $cero = 0;
            $cero_octubre = 0;
            $final_diciembre = '01';

            if ($ij < 10) {
                $cero = 0;
                $cero_octubre = 0;
            } else {
                $cero = '';
                $cero_octubre = '';
            }
            if ($cero_octubre.$diatermino == '010') {
                $cero_octubre = '';
            }

            if ($ij == 12) {
                $final_diciembre = '31';
                $diatermino = '12';
            }
            ?>
     <div role="tabpanel" class="tab-pane fade in div azul-secundario fuente-blanca <?php if($i == 2){echo 'active';} ?>" id="{{$ij}}" aria-labelledby="{{$ij.'-tab'}}">
        
          <table class="table">
                <thead>
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>TIPO</th>
                <th>LÍQUIDO PAGADO</th>
                <th>BRUTO PAGADO</th>
                <th>FECHA</th>
                <th>ACCIONES</th>
                </thead>
                <tbody>
                    <?php $mes_liquido = 0; ?>
                    <?php $mes_bruto = 0;  ?>
                    @foreach($pagos as $pago)
                      @if($pago->fecha >= $ano_actual.'-'.$cero.$diainicio.'-01' && $pago->fecha <= $ano_actual.'-'.$cero_octubre.$diatermino.'-'.$final_diciembre)
                 
                        <?php $mes_liquido = $mes_liquido+$pago->monto_liquido;?>
                      <?php 
                      $liquido = $liquido+$pago->monto_liquido;
                      $bruto = $bruto+$pago->monto_bruto;
                      ?>
                        <?php $mes_bruto = $mes_bruto+$pago->monto_bruto;?>
                      
                            
                            <td>{{$pago->employee->nombre}}</td>
                            <td>{{$pago->employee->apellido}}</td>
                            <td><span class="label" style="background-color:  {{ $pago->employee->jobs->job_types->color}}">{{ $pago->employee->jobs->job_types->nombre}}</span></td>
                            <td>$ {{number_format($pago->monto_liquido, 0, '','.')}}</td>
                            <td>$ {{number_format($pago->monto_bruto, 0, '', '.')}}</td>
                            <td>{{date("d/M/Y",strtotime($pago->fecha))}}</td>
                            <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('eliminar-pago', [$pago->id]);}}"><i title="Eliminar" class="fa fa-times fa-2x hover-grey"></i></a></td>
                        </tr>
                        @endif
                          
                    @endforeach
              </tbody>
          </table>
          <div class="div azul-principal fuente-blanca f25 texto-centrado">
              TOTAL LÍQUIDO: $ {{number_format($mes_liquido, 0, '', '.')}}<br>
              TOTAL BRUTO: $ {{number_format($mes_bruto, 0, '', '.')}}
              <?php $totales_liquidos[$ij] = $mes_liquido; ?>
              <?php $totales_brutos[$ij] = $mes_bruto; ?>
        </div>
      </div>
    <?php $diainicio ++;$diatermino ++; ?>
    @endfor
    <div role="tabpanel" class="tab-pane fade in div azul-secundario fuente-blanca" id="anual" aria-labelledby="anual-tab">
        
          <table class="table">
                <thead>
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>LÍQUIDO PAGADO</th>
                <th>BRUTO PAGADO</th>
                </thead>
                <tbody>
                    <?php
               
                    $mes_liquido = 0;  ?>
                    <?php $mes_bruto = 0;  ?>
                    @foreach($funcionarios as $funcionario)
                   
                        <tr>
                            <td>{{$funcionario->nombre}}</td>
                            <td>{{$funcionario->apellido}}</td>
                            <td>$ {{number_format($funcionario->payments->sum('monto_liquido'), 0, '','.')}}</td>
                          
                            <td>$ {{number_format($funcionario->payments->sum('monto_bruto'), 0, '', '.')}}</td>
                            
                        </tr>
                 
                    @endforeach
              </tbody>
          </table>
        </div>
        <div role="tabpanel" class="tab-pane fade in div active" id="grafico" aria-labelledby="grafico-tab">
            <div class="div" style="overflow:hidden;">
                <div class="div" style="float:left;">
                <div class="texto-centrado">
                     <h2><b>TOTAL REMUNERACIÓN ANUAL LIQUIDO</b></h2>
                </div>
                <div>
                     <div id="donut-example"></div>
                </div>
                    <div class="texto-centrado">
                        <h3><b>TOTAL: </b>   $ {{number_format($liquido, 0, '', '.')}}</h3>    
                 </div>    
            
            </div> 
                <div class="div" style="float:right;">
                <div class="texto-centrado">
                     <h2><b>TOTAL REMUNERACIÓN ANUAL BRUTO</b></h2>
                </div>
                <div>
                     <div id="donut-example2"></div>
                </div>
                    <div class="texto-centrado">
                        <h3><b>TOTAL: </b>   $ {{number_format($bruto, 0, '', '.')}}</h3>    
                 </div>
            
            </div>
            </div>
           
           
      </div>
    </div>
  </div>
   <script type="text/javascript">
       Morris.Donut({
            element: 'donut-example',
            data: [
              {label: "ENERO", value: <?php echo $totales_liquidos[1]; ?>},
              {label: "FEBRERO", value: <?php echo $totales_liquidos[2]; ?>},
              {label: "MARZO", value: <?php echo $totales_liquidos[3]; ?>},
              {label: "ABRIL", value: <?php echo $totales_liquidos[4]; ?>},
              {label: "MAYO", value: <?php echo $totales_liquidos[5]; ?>},
              {label: "JUNIO", value: <?php echo $totales_liquidos[6]; ?>},
              {label: "JULIO", value: <?php echo $totales_liquidos[7]; ?>},
              {label: "AGOSTO", value: <?php echo $totales_liquidos[8]; ?>},
              {label: "SEPTIEMBRE", value: <?php echo $totales_liquidos[9]; ?>},
              {label: "OCTUBRE", value: <?php echo $totales_liquidos[10]; ?>},
              {label: "NOVIEMBRE", value: <?php echo $totales_liquidos[11]; ?>},
              {label: "DICIEMBRE", value: <?php echo $totales_liquidos[12]; ?>}
            ],
             colors:['#5e2d2d', '#5e2d4d', '#412d5e', '#2d515e', '#2d5e49', '#3f5e2d', '#5e582d', '#5e342d', '#c1dd4f', '#4fa0dd', '#c64fdd', '#ed5c5c']
    });
    
     Morris.Donut({
            element: 'donut-example2',
            data: [
              {label: "ENERO", value: <?php echo $totales_brutos[1]; ?>},
              {label: "FEBRERO", value: <?php echo $totales_brutos[2]; ?>},
              {label: "MARZO", value: <?php echo $totales_brutos[3]; ?>},
              {label: "ABRIL", value: <?php echo $totales_brutos[4]; ?>},
              {label: "MAYO", value: <?php echo $totales_brutos[5]; ?>},
              {label: "JUNIO", value: <?php echo $totales_brutos[6]; ?>},
              {label: "JULIO", value: <?php echo $totales_brutos[7]; ?>},
              {label: "AGOSTO", value: <?php echo $totales_brutos[8]; ?>},
              {label: "SEPTIEMBRE", value: <?php echo $totales_brutos[9]; ?>},
              {label: "OCTUBRE", value: <?php echo $totales_brutos[10]; ?>},
              {label: "NOVIEMBRE", value: <?php echo $totales_brutos[11]; ?>},
              {label: "DICIEMBRE", value: <?php echo $totales_brutos[12]; ?>}
            ],
             colors:['#5e2d2d', '#5e2d4d', '#412d5e', '#2d515e', '#2d5e49', '#3f5e2d', '#5e582d', '#5e342d', '#c1dd4f', '#4fa0dd', '#c64fdd', '#ed5c5c']
    });
   </script>

@stop
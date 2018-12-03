@extends('content-pagos.Funcionarios.ver-funcionarios')

@section('editar-funcionario')
@foreach($funcionario as $f)
<div class="div azul-terciario fuente-blanca" style="margin-top: 55px;">
    <h1><i class="fa fa-chevron-right "></i><i class="fa fa-chevron-right"></i> Historial {{$f->nombre.' '.$f->apellido}}</h1>
</div>
<div  style="overflow: hidden; width: 100%;">
    <div class="col-md-3 div totales-propios-rojo f15 fuente-blanca" style="width: 17%; margin-top: 0px; float: left;">
        <b>INFORMACIÓN GENERAL</b>
        <hr>
        cargo: <b>{{$f->jobs->nombre}}</b><br>
        tipo: <b>{{$f->jobs->job_types->nombre}}</b><br>
        contrato: <b>{{$f->contract_types->nombre}}</b><br>
        sueldo bruto: <b>$ {{number_format($f->salario_bruto, 0, '', '.')}}</b><br>
        sueldo líquido: <b>$ {{number_format($f->salario_liquido, 0, '', '.')}}</b><br>
        total bruto pagado: <b>$ {{number_format($f->payments->sum('monto_bruto'), 0, '', '.')}}</b><br>
        total líquido pagado: <b>$ {{number_format($f->payments->sum('monto_liquido'), 0, '', '.')}}</b><br>      
    </div>
    <div class="col-md-3 div azul-secundario f20 fuente-blanca" style="margin-left: 0px; margin-top: 0px;width: 75%; float: right;">
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a  class="tab-func" href="#historialpagos" id="historialpagos-tab" role="tab" data-toggle="tab" aria-controls="historialpagos" aria-expanded="false">Historial pagos</a></li>
                <li role="presentation" class="tab-func"><a class="tab-func"  href="#historialcargos" role="tab" id="febrero-tab" data-toggle="tab" aria-controls="historialcargos" aria-expanded="false">Historial cargos</a></li>                
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in " id="historialpagos" aria-labelledby="historialpagos-tab">
                    <table class="table">
                        <thead>
                        <th>FECHA</th>
                        <th>MONTO BRUTO</th>
                        <th>MONTO LÍQUIDO</th>
                        </thead>
                        <tbody>
                            @foreach($f->payments as $pago)
                            <tr>
                                <td>{{date("d/M/Y",strtotime($pago->fecha))}}</td>
                                <td>$ {{number_format($pago->monto_bruto, 0, '', '.')}}</td>
                                <td>$ {{number_format($pago->monto_liquido, 0, '', '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div role="tabpanel" class="tab-pane fade  in" id="historialcargos" aria-labelledby="historialcargos-tab">
                 <table class="table">
                        <thead>
                        <th>FECHA</th>
                        <th>CARGO</th>
                        </thead>
                        <tbody>
                            @foreach($f->job_records as $records)
                            <tr>
                                <td>{{date("d/M/Y H:i",strtotime($records->created_at))}}</td>
                                <td>{{$records->jobs->nombre}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
        
     
</div>
 
@endforeach
@stop
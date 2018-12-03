@extends('layout.main-pagos')
@section('content-pagos')
<div class="div azul-principal fuente-blanca">
     <h1><i class="fa fa-chevron-right"></i> Funcionarios</h1>
</div>
<div class="div azul-secundario fuente-blanca f15">
    @if($funcionarios != false)
        <table class="table table-responsive ">
            <thead>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>SALARIO BRUTO</th>
                <th>SALARIO LÍQUIDO</th>
                <th>CARGO</th>
                <th>TIPO</th>
                <th>CONTRATO</th>
                <th>N° PAGOS</th>
                <th>TOTAL PAGADO BRUTO</th>
                <th>TOTAL PAGADO LÍQUIDO</th>
                <th colspan="2" class="text-center">ACCIONES</th>
            </thead>
            <tbody>
                @foreach($funcionarios as $funcionario)
                @if($funcionario->jobs->job_types->id == 1)
                <?php $clase = 'label'; ?>
                @else
                <?php $clase = 'label'; ?>
                @endif
                <tr>
                    <td>{{$funcionario->nombre}}</td>
                    <td>{{$funcionario->apellido}}</td>
                    <td>$ {{number_format($funcionario->salario_bruto, 0, '', '.')}}</td>
                    <td>$ {{number_format($funcionario->salario_liquido, 0, '', '.')}}</td>
                    <td>{{$funcionario->jobs->nombre}}</td>
                    <td><span class="{{$clase}}" style="background-color: {{$funcionario->jobs->job_types->color}}">{{$funcionario->jobs->job_types->nombre}}</span></td>
                    <td>{{$funcionario->contract_types->nombre}}</td>
                    <td>{{$funcionario->payments->count()}}</td>
                    <td>$ {{number_format($funcionario->payments->sum('monto_bruto'), 0, '', '.')}}</td>
                    <td>$ {{number_format($funcionario->payments->sum('monto_liquido'), 0, '', '.')}}</td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('editar-funcionario', [$funcionario->id]);}}"><i title="Editar" class="fa fa-pencil fa-2x hover-grey"></i></a></td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('historial-funcionario', [$funcionario->id]);}}"><i title="Ver Historial" class="fa fa-eye fa-2x hover-grey"></i></a></td>
                    <!--<td><i title="Deshabilitar" class="fa fa-minus-square fa-2x hover-grey"></i></td>-->
                   
                </tr>
                @endforeach
            </tbody>  
        </table>
    <div style="float: right; margin-bottom:  30px;">
        {{$funcionarios->links()}}
    </div>           
    @else
      <p>No hay funcionarios disponibles</p>
    @endif
</div>
@yield('editar-funcionario')
@stop
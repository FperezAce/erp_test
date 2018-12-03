@extends('layout.main-pagos')
@section('content-pagos')
<div class="div azul-principal fuente-blanca">
     <h1><i class="fa fa-chevron-right"></i> Gastos fijos</h1>
</div>
<div class="div azul-secundario fuente-blanca f15">
    @if($gastos != false)
        <table class="table table-responsive ">
            <thead>
                <th>NOMBRE</th>
                <th>N° PAGOS</th>
                <th>TOTAL PAGADO</th>
                <th>FECHA ÚLTIMO PAGO</th>
                <th>ACCIONES</th>
            </thead>
            <tbody>
                @foreach($gastos as $gasto)
                <tr>
                    <td>{{$gasto->nombre}}</td>
                    <td>{{$gasto->utility_payments->count()}}</td>
                    <td>{{$gasto->utility_payments->sum('monto')}}</td>
                    <td>{{date("d/M/Y",strtotime($gasto->utility_payments->max('fecha')))}}</td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('editar-gasto', [$gasto->id]);}}"><i title="Editar" class="fa fa-pencil fa-2x hover-grey"></i></a></td>
                    
                </tr>
                @endforeach
            </tbody>  
        </table>
    <div style="float: right; margin-bottom:  30px;">
        {{$gastos->links()}}
    </div>           
    @else
      <p>No hay gastos disponibles</p>
    @endif
</div>
@yield('editar-gasto')
@stop

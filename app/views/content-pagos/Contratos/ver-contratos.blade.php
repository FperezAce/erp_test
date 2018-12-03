@extends('layout.main-pagos')
@section('content-pagos')
<div class="div azul-principal fuente-blanca">
     <h1><i class="fa fa-chevron-right"></i> Contratos</h1>
</div>
<div class="div azul-secundario fuente-blanca f15">
    @if($contratos != false)
        <table class="table table-responsive ">
            <thead>
                <th>NOMBRE</th>
                <th>N° FUNCIONARIOS</th>
                <th>ACCIONES</th>
            </thead>
            <tbody>
                @foreach($contratos as $contrato)
                <tr>
                    <td>{{$contrato->nombre}}</td>
                    <td>{{$contrato->employee->count()}}</td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('editar-contrato', [$contrato->id]);}}"><i title="Editar" class="fa fa-pencil fa-2x hover-grey"></i></a></td>
                    <!--<td><a style="text-decoration: none; color: #FFFFFF;" href="#"><i title="" class="fa fa-eye fa-2x hover-grey"></i></a></td>
                    <td><i title="Deshabilitar" class="fa fa-minus-square fa-2x hover-grey"></i></td>-->
                </tr>
                @endforeach
            </tbody>  
        </table>
    <div style="float: right; margin-bottom:  30px;">
        {{$contratos->links()}}
    </div>           
    @else
      <p>No hay contratos disponibles</p>
    @endif
</div>
@yield('editar-contrato')
@stop
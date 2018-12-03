@extends('layout.main-pagos')
@section('content-pagos')
<div class="div azul-principal fuente-blanca">
     <h1><i class="fa fa-chevron-right"></i> Cargos</h1>
</div>
<div class="div azul-secundario fuente-blanca f15">
    @if($cargos != false)
        <table class="table table-responsive ">
            <thead>
                <th>NOMBRE</th>
                <th>TIPO</th>
                <th>DESCRIPCIÓN</th>
                <th>N° FUNCIONARIOS</th>
                <th class="text-center">ACCIONES</th>
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                <tr>
                    <td>{{$cargo->nombre}}</td>
                    <td><span class="label" style="background-color:{{$cargo->job_types->color}} ">{{$cargo->job_types->nombre}}</span></td>
                    <td>{{$cargo->descripcion}}</td>
                    <td>{{$cargo->employees->count()}}</td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('editar-cargo', [$cargo->id]);}}"><i title="Editar" class="fa fa-pencil fa-2x hover-grey"></i></a></td>
                   <!-- <td><a style="text-decoration: none; color: #FFFFFF;" href="#"><i title="" class="fa fa-eye fa-2x hover-grey"></i></a></td>
                    <td><i title="Deshabilitar" class="fa fa-minus-square fa-2x hover-grey"></i></td>-->
                </tr>
                @endforeach
            </tbody>  
        </table>
    <div style="float: right; margin-bottom:  30px;">
        {{$cargos->links()}}
    </div>           
    @else
      <p>No hay cargos disponibles</p>
    @endif
</div>
@yield('editar-cargo')
@stop
@extends('layout.main')
@section('content')
<div class="div azul-principal fuente-blanca">
     <h1><i class="fa fa-chevron-right"></i> Historico de proyectos alianza</h1>
</div>
<div class="div azul-secundario fuente-blanca f15">
    @if($projects != false)
        <table class="table table-responsive ">
            <thead>
                <th>NOMBRE</th>
                <th>Nº OC</th>
                <th>CLIENTE</th>
                <th>RUT</th>
                <th>VALOR UF</th>
                <th>Nº HITOS</th>
                <th width="5%" colspan="2">ACCIONES</th>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{$project->nombre}}</td>
                    <td>{{$project->orden_compra}}</td>
                    <td>{{$project->customers->nombre}}</td>
                    <td>{{$project->customers->rut}}</td>
                    <td>{{$project->valor}}</td>
                    <td>{{$project->bills->count()}}</td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('activar', [$project->id])}}"><i title="Activar proyecto" class="fa fa-check fa-2x hover-grey"></i></a></td> 
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('eliminar', [$project->id])}}"><i title="Eliminar proyecto" class="fa fa-times fa-2x hover-grey"></i></a></td>
                   
                </tr>
                @endforeach
            </tbody>  
        </table>
    <div style="float: right; margin-bottom:  30px;">
        {{$projects->links()}}
    </div>           
    @else
      <p>No hay proyectos disponibles</p>
    @endif
</div>
@stop
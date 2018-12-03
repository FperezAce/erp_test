@extends('content.Configuraciones.inicio')

@section('content-configuracion')
<div class="datos-generales">
    <h1><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> Clientes</h1>
    @if($clientes != false)
        <table class="table f20">
            <thead>
                <th>NOMBRE</th>
                <th>RUT</th>
                <th>EMAIL</th>
                <th>TELÉFONO</th>
                <th>TIPO</th>
                <th colspan="2" class="text-center">ACCIONES</th>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nombre}}</td>
                    <td>{{$cliente->rut}}</td>
                    <td>{{$cliente->mail}}</td>
                    <td>{{$cliente->fono}}</td>
                    <td>@if($cliente->tipo == 1)
                        PROPIO
                        @else
                        ALIANZA
                        @endif
                        </td>
                    <td><a style="text-decoration: none; color: white;" href="{{URL::route('editar-cliente', $cliente->id)}}"><i title="Editar" class="fa fa-pencil-square fa-2x hover-grey"></i></a></td>
                    <td><i title="Deshabilitar" class="fa fa-minus-square fa-2x hover-grey"></i></td>
                </tr>
        
            @endforeach
            </tbody>
            
        </table>
    @else
      <p>No hay clientes disponibles</p>
    @endif
</div>
@yield('editar-cliente')
@stop
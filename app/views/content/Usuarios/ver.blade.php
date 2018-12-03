@extends('content.Configuraciones.inicio')

@section('content-configuracion')
<div class="datos-generales">
    <h1><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i> Usuarios</h1>
    @if($usuarios != false)
        <table class="table f20">
            <thead>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>DIRECCIÓN</th>
                <th>EMAIL</th>
                <th>TELÉFONO</th>
                <th>NOMBRE DE USUARIO</th>
                <th colspan="2" class="text-center">ACCIONES</th>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->username}}</td>
                    <td><a style="text-decoration: none; color: white;" href="{{URL::route('editar-usuarios', $user->id)}}"><i title="Editar" class="fa fa-pencil-square fa-2x hover-grey"></i></a></td>
                    <td><a style="text-decoration: none; color: white;" href="{{URL::route('eliminar-user', $user->id)}}"><i title="Eliminar" class="fa fa-times fa-2x hover-grey"></i></a></td>
                </tr>
        
            @endforeach
            </tbody>
            
        </table>
    @else
      <p>No hay Usuarios disponibles</p>
    @endif
</div>
@yield('editar-usuario')
@stop
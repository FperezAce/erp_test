@extends('layout.main-pagos')
@section('content-pagos')
<div class="div azul-principal fuente-blanca">
     <h1><i class="fa fa-chevron-right"></i> Tipos de cargo</h1>
</div>
<div class="div azul-secundario fuente-blanca f15">
    @if($tipos != false)
        <table class="table table-responsive ">
            <thead>
                <th width="1%">NOMBRE</th>
                <th width="10%">COLOR</th>
                <th width="1%">ACCIONES</th>
            </thead>
            <tbody>
                @foreach($tipos as $t)
                <tr>
                    <td>{{$t->nombre}}</td>
                    <td><div class="div" style="background-color: {{$t->color}}">{{$t->color}}</div></td>
                    <td><a style="text-decoration: none; color: #FFFFFF;" href="{{URL::to('editar-tipo-cargo', [$t->id]);}}"><i title="Editar" class="fa fa-pencil fa-2x hover-grey"></i></a></td>
                    <!--<td><a style="text-decoration: none; color: #FFFFFF;" href="#"><i title="" class="fa fa-eye fa-2x hover-grey"></i></a></td>
                    <td><i title="Deshabilitar" class="fa fa-minus-square fa-2x hover-grey"></i></td>-->
                </tr>
                @endforeach
            </tbody>  
        </table>
    <div style="float: right; margin-bottom:  30px;">
        {{$tipos->links()}}
    </div>           
    @else
      <p>No hay tipos disponibles</p>
    @endif
</div>
@yield('editar-tipo')
@stop
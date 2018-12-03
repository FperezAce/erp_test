@extends('layout.main')

@section('content')

<div class="container">
    <div class="div azul-principal fuente-blanca">
        <h1><i class="fa fa-chevron-right"></i> Listado de propuestas</h1>
    </div>
     
      <div class="div azul-secundario fuente-blanca">
          
          <table class="table">
                <thead>
                <th style="text-align: center;">Propuesta | Tipo | Código</th>
                <th style="text-align: center;">Horas</th>
                <th style="text-align: center;">Personas</th>
                <th style="text-align: center;">Total</th>
                <th style="text-align: center;">PPM</th>
                <th style="text-align: center;">Gastos</th>
                <th style="text-align: center;">Utilidad</th>
              </thead>
              <tbody>
                 @if($propuestas) 
                 
             
                    @foreach($propuestas as $p)
                    
                    
                        <tr>
                            <td style="background-color:#CCD4F1; text-align: center;"><p style="color: #245269"><a href="{{URL::to("/editar-propuesta/".$p->proposal_detail_id)}}">{{$p->nombre.' | '.$p->tipo.' | '.$p->codigo}}</a></p></td>
                            <td style="text-align: center;">{{ number_format($p->horas_totales, 1, ',', '.') }}</td>
                            <td style="text-align: center;">{{ number_format($p->cantidad, 0, ',', '.') }}</td>
                            <td style="text-align: center;"><i class="fa fa-usd"></i> {{ number_format($p->total, 2, ',', '.') }}</td>
                            <td style="text-align: center;"><i class="fa fa-usd"></i> {{ number_format($p->ppm, 2, ',', '.') }}</td>
                            <td style="text-align: center;"><i class="fa fa-usd"></i> {{ number_format($p->gastos_asociados, 2, ',', '.') }}</td>
                            <td style="text-align: center;"><i class="fa fa-usd"></i> {{ number_format($p->utilidad, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="7"></td>
                        </tr>          
                    @endforeach
                 @else
                 <tr>
                     <td colspan="7" style="text-align: center;">Aún no hay propuestas.<a href="{{ URL::route('calcular-tipo') }}"> Haga clic aquí para calcular nueva propuesta.</a> </td>                     
                 </tr>
                 @endif
             </tbody>
          </table>
      </div>
</div>
@stop
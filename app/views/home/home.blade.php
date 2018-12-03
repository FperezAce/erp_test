@extends('layout.main')

@section('content')

    <div class="container">

        <div class="div azul-principal fuente-blanca">
            <h1><i class="fa fa-chevron-right"></i> Indicadores de proyectos</h1>
        </div>
      <!-- Main component for a primary marketing message or call to action -->
     
      <div class="div">
          <div id="bar-example"></div>
        </div>
    </div>
<script type="text/javascript">
        
        var jsonData = $.ajax({
            url: "{{URL::to('/datos')}}",
            dataType: "json",
            async: false,
            type: "post",
        }).responseText;


        var totales = JSON.parse(jsonData);
        
        Morris.Bar({
            element: 'bar-example',
            data: [
                { y: 'PROYECTOS PROPIOS', total_por_emitir: totales.propios_total_por_emitir, total_emitido: totales.propios_total_emitido, total_por_cancelar:totales.propios_total_por_cancelar, total_cancelado: totales.propios_total_cancelado },
                { y: 'PROYECTOS ALIANZA', total_por_emitir: totales.alianza_total_por_emitir, total_emitido: totales.alianza_total_emitido, total_por_cancelar:totales.alianza_total_por_cancelar, total_cancelado: totales.alianza_total_cancelado },
                { y: 'TOTAL PROYECTOS', total_por_emitir: totales.total_por_emitir, total_emitido: totales.total_emitido, total_por_cancelar:totales.total_por_cancelar, total_cancelado: totales.total_cancelado },
              
            ],
            xkey: 'y',
            ykeys: ['total_por_emitir', 'total_emitido', 'total_por_cancelar', 'total_cancelado'],
            labels: ['Total por emitir', 'Total emitido', 'Total por cancelar', 'Total cancelado'],
            barColors:['#366684', '#4b93b7', '#a53337', '#ed5c5c']
        });
        
        Morris.Bar({
            element: 'bar-example-2',
            data: [
                { y: '2006', Remuneracion: 500000, Gastosfijos: 234324.5, b:123123 },
                { y: '2007', a: 400000,  b: 300000 },
                { y: '2008', a: 50,  b: 40 },
                { y: '2009', a: 75,  b: 65 },
            ],
            xkey: 'y',
            ykeys: ['Remuneracion', 'Gastosfijos', 'b'],
            labels: ['Remuneracion', 'gastos fijos']
        });
        
        
   
   function format(num){
    var n = num.toString(), p = n.indexOf('.');
    return n.replace(/\d(?=(?:\d{3})+(?:\.|$))/g, function($0, i){
        return p<0 || i<p ? ($0+',') : $0;
    });
}
   
   
   
      google.load("visualization", "1", {packages:["corechart"]});

    function drawChart() {


       

      
    }
</script>
@stop
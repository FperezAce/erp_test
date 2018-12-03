<?php

class HomeController extends BaseController {

     public function index(){
     
        return View::make('index');
     }
    
    public function Home(){
     
        return View::make('home.home');
    }
    
    public function erp(){
     
        return View::make('home.erp');
    }
    
    public function homePagos(){
     
        return View::make('home.home-pagos');
    }
   
    public function Datos(){
        
        $totales_emitidos = Project::total_emitidos();
               

        foreach ($totales_emitidos as $t){
            $totales_emitidos_[] = array(
                    'total_emitido'    => $t->total_emitido,
                    'total_por_emitir' => $t->total_por_emitir,
                    );
        }
        
        $totales_cancelados = Project::total_cancelados();

        foreach ($totales_cancelados as $t){
            $totales_cancelados_[] = array(
                    'total_cancelado'    => $t->total_cancelado,
                    'total_por_cancelar' => $t->total_por_cancelar,
                    );
        }
        
       $cancelado_propios = Project::cancelado_propios();
       $cancelado_alianza = Project::cancelado_alianza();
       
       $emitido_propios = Project::emitido_propios();
       $emitido_alianza = Project::emitido_alianza();
        
       $total_alianza = Project::total_alianza();
       $total_propio  = Project::total_propio();
       
       
    
       
       $total_alianza = $total_alianza->total;
       $total_propio  = $total_propio->total;
          
       //-----TOTALES-----------------------
       
       $total_emitido      = $totales_emitidos_[0]['total_emitido'];
       $total_por_emitir   = $totales_emitidos_[0]['total_por_emitir'];       
       $total_cancelado    = $totales_cancelados_[0]['total_cancelado'];
       $total_por_cancelar = $totales_cancelados_[0]['total_por_cancelar'];
       
       $propios_total_cancelado    = $cancelado_propios->cancelado_propio;
       $propios_total_por_cancelar = $total_propio - $propios_total_cancelado;
       
       $propios_total_emitido      = $emitido_propios->emitido_propio;
       $propios_total_por_emitir   = $total_propio - $propios_total_emitido;
       
       $alianza_total_cancelado    = $cancelado_alianza->cancelado_alianza;
       $alianza_total_por_cancelar = $total_alianza - $alianza_total_cancelado;
       $alianza_total_emitido      = $emitido_alianza->emitido_alianza;
       $alianza_total_por_emitir   = $total_alianza - $alianza_total_emitido;
       
       $int = (int)$total_por_cancelar;
                 
                return Response::json(array(
                    'total_emitido'              => $total_emitido,
                    'total_por_emitir'           => $total_por_emitir,
                    'total_cancelado'            => $total_cancelado,
                    'total_por_cancelar'         => $int,
                    'propios_total_cancelado'    => $propios_total_cancelado,
                    'propios_total_por_cancelar' => $propios_total_por_cancelar,
                    'propios_total_emitido'      => $propios_total_emitido,
                    'propios_total_por_emitir'   => $propios_total_por_emitir,
                    'alianza_total_cancelado'    => $alianza_total_cancelado,
                    'alianza_total_por_cancelar' => $alianza_total_por_cancelar,
                    'alianza_total_emitido'      => $alianza_total_emitido,
                    'alianza_total_por_emitir'   => $alianza_total_por_emitir      
                    ));
                
             
    }
                
                
}

?>

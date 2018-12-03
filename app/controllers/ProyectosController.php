<?php

class ProyectosController extends BaseController {

    public function getVer() {
                                                                              
        $customers = Customer::with(array('projects.bills', 'projects' => function($query) {
                        $query->where('situation_id', '=', '1')->orWhere('situation_id', '=', '4');
                    }))->where('tipo', '=', 1)->get();

        return View::make('content.ProyectosPropios.ver-proyectos')
                        ->with('customers', $customers);
                        
    }
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    //Función para mostrar todos los proyectos, agrupados por cliente
    public function postVer() {
   
        $project_id = Input::get('project_id');
        $bill_id = Input::get('id');
        $numero = Input::get('numero');
        $monto_esperado = Input::get('monto_esperado');
        $monto = Input::get('monto');
        $hito = Input::get('hito');
        $ppm = Input::get('ppm');
        if (Input::File('archivo')) {

            $archivo = Input::File('archivo')
                            ->move('archivos/facturas', $project_id.'_'.$numero . '_' . Input::File('archivo')->getClientOriginalName());
                $archivo = $project_id.'_'.$numero . '_' . Input::File('archivo')->getClientOriginalName();
            }
            else{
                
                $archivo = NULL;
            }
        if(Input::File('comprobante_factura')){
                
                $comprobante_factura = Input::File('comprobante_factura')
                            ->move('archivos/facturas', $project_id.'_'.$numero . '_comprobante_factura_recibida_' . Input::File('comprobante_factura')->getClientOriginalName());
                $comprobante_factura = $project_id.'_'.$numero . '_comprobante_factura_recibida_' . Input::File('comprobante_factura')->getClientOriginalName();
            }
            else{
                
                $comprobante_factura = NULL;
            }

        if (!Input::has('fecha_emision')) {
            
            $fecha_emision = NULL;
            $fecha = NULL;
            $nuevafecha = NULL;
        } else {
            
            $fecha_emision = new DateTime(Input::get('fecha_emision')); 
            $fecha_emision->format('Y-m-d');
            $fecha         = $fecha_emision->format('Y-m-d');
            $nuevafecha    = strtotime('-1 day', strtotime($fecha));
            $nuevafecha    = date('Y-m-d', $nuevafecha);
        }
        
        if (!Input::has('fecha_cancelado')) {
            
            $fecha_cancelado = NULL;
        } else {
            
            $fecha_cancelado = new DateTime(Input::get('fecha_cancelado')); 
            $fecha_cancelado->format('Y-m-d');
        }

        $validator = Validator::make(Input::all(), array(
                    'fecha_cancelado' => 'after:' . $nuevafecha . '',
                    'monto'           => 'numeric|max:' . $monto_esperado . '',
                    'numero'          => 'required|unique:bills,numero,'.$bill_id,
                     ), array(
                    'after'           => 'La fecha de pago no puede ser menor a la fecha de emisión',
                    'max'             => 'Supera el promedio permitido',
                    'unique'          => 'El número de factura debe ser único',
                    'required'        => 'Debe ingresar al menos el número de factura', 
        ));

        if ($validator->fails()) {

            return Response::json(array(
                        'success' => false,
                        'mensaje' => $validator->errors()->toArray()
            ));
        } else {
           
              $bill = Bill::find($bill_id);
              
              $bill->numero             = $numero;
              $bill->fecha_emision      = $fecha_emision;
              $bill->monto              = $monto;
              $bill->hito               = $hito;
              $bill->fecha_cancelado    = $fecha_cancelado;
              $bill->ppm                = $ppm;
              
              if($archivo != NULL){
                 $bill->url                = $archivo; 
              }
              if($comprobante_factura != NULL){
                 $bill->url_comprobantefr  = $comprobante_factura; 
              }
              
      
            if ($bill->save()) {

                return Response::json(array(
                            'success' => true,
                            'mensaje' => 'Editado correctamente'
                ));
            } else {
                return Response::json(array(
                            'success' => false,
                            'mensaje' => 0,
                ));
            }
        }
    }
    
    //-------------------------------------------------------------------------------------------------------------------------------------------
    
    public function getCreate() {

        //Busca todos los clientes para ser mostrado mediante un combobox en el formulario de registro de proyecto
        $clientes = Customer::where('tipo', '=', 1)->get()->lists('nombre', 'id');
        $combobox = array(0 => "Seleccione ... ") + $clientes;
        $selected = array();
        
        return View::make("content.ProyectosPropios.crear-proyecto", compact('combobox', 'selected'));
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------
    
    public function postCreate() {

       
        $validator = Validator::make(Input::all(), array(
                    'name'          => 'required',
                    'customer'      => 'required',
                    'orden_compra'  => 'unique:projects',
                    'purchase_date' => 'required',
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',
                    'unique'        => 'El número de orden debe ser único',      
        ));

        if ($validator->fails()) {
            
            return Redirect::route('crear-proyecto')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $name           = Input::get('name');
            $customer       = Input::get('customer');
            $purchase_order = Input::get('orden_compra');
            $purchase_date  = Input::get('purchase_date');
            $item           = Input::get('item');
            $value          = Input::get('value');
            
            if(Input::File('archivo')){
                
                $archivo = Input::File('archivo')
                            ->move('archivos/pdf', $purchase_order . '_' . Input::File('archivo')->getClientOriginalName());
                $archivo = $purchase_order . '_' . Input::File('archivo')->getClientOriginalName();
            }
            else{
                
                $archivo = NULL;
            }

            $suma_porcentaje = Input::get('milestone');
            
            for ($r = 0; $r <= 100; $r++) {
                
                $suma_porcentaje = $suma_porcentaje + Input::get($r);
            }
            
            if ($suma_porcentaje > 100) {
                
                return Redirect::route('crear-proyecto')
                                ->with('global', 'Atención!, Porcentajes superan el 100%');
                
            }
            
            //---------------CALCULO DE UF----------------------------
            
            $url = "http://www.sii.cl/pagina/valores/uf/uf".date('Y').".htm";
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $html = curl_exec($ch);
            curl_close($ch);

            $dom = new DOMDocument();

            @$dom->loadHTML($html);
          
            list($year, $month, $day) = explode("-",$purchase_date); 
          
            $uf = ( $day * 12 )-( 12 - $month );

            $array_td = array();
            $celdas = $dom->getElementsByTagName('td');
            $contador = 1;
            
            foreach ($celdas as $td) {
                
                foreach ($td->childNodes as $attr) {
                    $value_td = $attr->nodeValue;
                    $array_td[$contador] = $value_td;
                    $contador = $contador + 1;   
                }
            }
         
            $value_uf = $array_td[$uf];
            
            $simbolos = array("$", ".", ",");
            $blanco   = array("", "", ".");
            $value_uf = str_replace($simbolos, $blanco, $value_uf);
                   
            $project = new Project;
            
            $project->customer_id        = $customer;
            $project->nombre             = $name;
            $project->orden_compra       = $purchase_order;
            $project->fecha_orden_compra = $purchase_date;
            $project->item_comprado      = $item;
            $project->valor              = $value;
            $project->valor_uf           = $value_uf;
            $project->pdf                = $archivo;
            $project->type               = 1;
            $project->situation_id       = 1;
            
            $project->save();
            
            $project_id = $project->id;

            $milestones[] = array();
            $milestones[0] = Input::get('milestone');

            $bill = new Bill;
            
            $bill->project_id = $project_id;
            $bill->porcentaje = $milestones[0];
             
            $bill->save();
            
            for ($x = 1; $x <= 100; $x++) {
                
                if (Input::has($x)) {
                    
                    $milestones[$x] = Input::get($x);
                   
                    $bill = new Bill;
                    
                    $bill->project_id = $project_id;
                    $bill->porcentaje = $milestones[$x];
                    
                    $bill->save();
                }
            }

            if ($project_id) {

                return Redirect::route('ver-proyectos')
                                ->with('global', 'Proyecto creado');
            }
        }
    }
    
    //-------------------------------------------------------------------------------------------------------------------------------------------
    
    public function postEditarhito(){
         
            $suma_porcentaje = Bill::where('project_id', Input::get('project_id'))->sum('porcentaje');
        
            Bill::where('porcentaje', '=', 0)->where('project_id', '=', Input::get('project_id'))->delete();
        
            $suma_porcentaje = $suma_porcentaje + Input::get('hito');
            
            for ($r = 0; $r <= 100; $r++) {
               
                if (Input::has($r)) {
                    
                    $suma_porcentaje =  $suma_porcentaje + Input::get($r);                   
                }
            }
            
            if($suma_porcentaje > 100){
                
                return Redirect::route('ver-proyectos')
                        ->with('global', 'Porcentaje supera el 100%');
            }else{
                
                    $bill = new Bill;
            
                    $bill->project_id = Input::get('project_id');
                    $bill->porcentaje = Input::get('hito'); 
            
                    $bill->save();
            
                    for ($r = 0; $r <= 100; $r++) {
                
                        if (Input::has($r)) {
                    
                            $bill = new Bill;
                    
                            $bill->project_id = Input::get('project_id');
                            $bill->porcentaje = Input::get($r);
                    
                            $bill->save();
                        }
                    }
            
                    return Redirect::route('ver-proyectos');
                
            }
        
    }
    
    public function historico($id) {
        
        $proyecto = Project::find($id);
        
        $proyecto->situation_id = 2;
        
        $proyecto->save();
        
        if($proyecto->type == 1){
            return Redirect::route('ver-proyectos')
                        ->with('global', 'Movido a histórico!');
        }elseif($proyecto->type == 0){
            return Redirect::route('ver-proyectos-alianza')
                        ->with('global', 'Movido a histórico!');
        }
        
         
    }
    
    public function eliminar($id) {
        
        $proyecto = Project::find($id);
        
        $proyecto->situation_id = 3;
        
        $proyecto->save();
        
        if($proyecto->type == 1){
            return Redirect::route('ver-proyectos')
                        ->with('global', 'Proyecto eliminado!');
        }elseif($proyecto->type == 0){
            return Redirect::route('ver-proyectos-alianza')
                        ->with('global', 'Proyecto eliminado!');
        }
    }
    
    public function activar($id) {
        
        $proyecto = Project::find($id);
        
        $proyecto->situation_id = 1;
        
        $proyecto->save();
        
        if($proyecto->type == 1){
            return Redirect::route('ver-proyectos')
                        ->with('global', 'Proyecto activado!');
        }elseif($proyecto->type == 0){
            return Redirect::route('ver-proyectos-alianza')
                        ->with('global', 'Proyecto activado!');
        }
    }
    
    public function terminar($id) {
        
        $proyecto = Project::find($id);
        
        $proyecto->situation_id = 4;
        
        $proyecto->save();
        
        if($proyecto->type == 1){
            return Redirect::route('ver-proyectos')
                        ->with('global', 'Proyecto terminado!');
        }elseif($proyecto->type == 0){
            return Redirect::route('ver-proyectos-alianza')
                        ->with('global', 'Proyecto terminado!');
        }
    }
    
    public function getHistoricos(){
         $projects = Project::with('customers', 'bills')
                 ->where('type','=','1')
                 ->where('situation_id', '=', '2')->orWhere('situation_id', '=', '4')
                 ->paginate(10);
                    
         return View::make('content.ProyectosPropios.ver-historicos')
                        ->with('projects', $projects);
    }
    public function getEliminados(){
         $projects = Project::with('customers', 'bills')
                 ->where('type','=','1')
                 ->where('situation_id', '=', '3')
                 ->paginate(10);
                    
         return View::make('content.ProyectosPropios.ver-eliminados')
                        ->with('projects', $projects);
    }

}

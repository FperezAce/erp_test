<?php

class ProyectosAlianzaController extends BaseController {

    public function getVer() {

        $customers = Customer::with(array('projects.bills', 'projects' => function($query) {
                        $query->where('situation_id', '=', '1')->orWhere('situation_id', '=', '4');
                    }))->where('tipo', '=', 2)->get();

        return View::make('content.ProyectosAlianza.ver-proyectos-alianza')
                        ->with('customers', $customers);
        
    }
    
    //-------------------------------------------------------------------------------------------------------------------------------------------------
    
    //Función para modificar facturas
    public function postVer(){

        $project_id             = Input::get('project_id');
        $bill_id                = Input::get('id');
        $numero                 = Input::get('numero');
        $monto_esperado         = Input::get('monto_esperado');
        $monto                  = Input::get('monto'); //Monto principal
        $hito                   = Input::get('hito');
        $monto_alianza          = Input::get('monto_alianza'); //Monto que recibe alianza
        $numero_alianza         = Input::get('numero_alianza');
        $pagados                = Input::get('pagados');
        $facturados             = Input::get('facturados');
        $porcentaje_ganancia    = Input::get('porcentaje_ganancia'); //monto ganancia web machine
        $ppm                    = Input::get('ppm');
        
        $bill = Bill::find($bill_id);
        
        if(Input::File('archivo')){
                
                $archivo = Input::File('archivo')
                            ->move('archivos/facturas', $project_id.'_'.$numero . '_' . Input::File('archivo')->getClientOriginalName());
                $archivo = $project_id.'_'.$numero . '_' . Input::File('archivo')->getClientOriginalName();
                $bill->url    =  $archivo;
            }
            
        if(Input::File('comprobante')){
                
                $comprobante = Input::File('comprobante')
                            ->move('archivos/comprobantes', $project_id.'_'.$numero . '_' . Input::File('comprobante')->getClientOriginalName());
                $comprobante = $project_id.'_'.$numero . '_' . Input::File('comprobante')->getClientOriginalName();
                $bill->url_comprobante    =  $comprobante;
                
        }
            
            
         if(Input::File('frecibidas')){
                
                $frecibida = Input::File('frecibidas')
                            ->move('archivos/facturas_recibidas', $project_id.'_'.$numero . '_' . Input::File('frecibidas')->getClientOriginalName());
                $frecibida = $project_id.'_'.$numero . '_' . Input::File('frecibidas')->getClientOriginalName();
          
                $bill->url_frecibida    =  $frecibida;
         }
            
        
        if (!Input::has('fecha_emision')) {
            
            $fecha_emision = NULL;
            $fecha = NULL;
            $nuevafecha = NULL;           
        } else {
            
            $fecha_emision = new DateTime(Input::get('fecha_emision')); 
            $fecha_emision->format('Y-m-d');
            $fecha = $fecha_emision->format('Y-m-d');
            $nuevafecha = strtotime('-1 day', strtotime($fecha));
            $nuevafecha = date('Y-m-d', $nuevafecha);
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
                        'numero_alianza'  => 'unique:bills,numero_alianza,'.$bill_id,
                        ), array(
                        'after'           => 'La fecha de pago no puede ser menor a la fecha de emisión',
                        'max'             => 'Supera el promedio permitido',
                        'unique'          => 'El número debe ser único',
                        'required'        => 'Debe ingresar al menos el número de factura'    
                     ));

        if ($validator->fails()) {

            return Response::json(array(
                        'success' => false,
                        'mensaje' => $validator->errors()->toArray()
            ));
            
        } else {
           
              
              
              $bill->numero             = $numero;
              $bill->fecha_emision      = $fecha_emision;
              $bill->monto              = $monto;
              $bill->hito               = $hito;
              $bill->fecha_cancelado    = $fecha_cancelado;
              $bill->ppm                = $ppm;
              $bill->factura_recibida   = $facturados;
              $bill->monto_alianza      = $monto_alianza;
              $bill->numero_alianza     = $numero_alianza;
              $bill->pagado             = $pagados;
         
              if($bill->save()){
                  
                   return Response::json(array(
                            'success' => true,
                            'mensaje' => 'Editado correctamente'
                ));
                   
              }else{
                  
                   return Response::json(array(
                            'success' => false,
                            'mensaje' => 0,
                ));
              }         
        }
    }
    
    //----------------------------------------------------------------------------------------------------------------------------------
    
    //Llamado de vista de formulario crear proyecto
    public function getCreate() {

        //Busca todos los clientes para ser mostrado mediante un combobox en el formulario de registro de proyecto
        $clientes = Customer::where('tipo', '=', 2)->get()->lists('nombre', 'id');
        $combobox = array(0 => "Seleccione ... ") + $clientes;
        $selected = array();
        
        return View::make("content.ProyectosAlianza.crear-proyecto-alianza", compact('combobox', 'selected'));
    }
    
    //----------------------------------------------------------------------------------------------------------------------------------
    
    //Crea un nuevo proyecto alianza.
    public function postCreate() {
        
        
        //Reglas de validación.
        $validator = Validator::make(Input::all(), array(
                            'name'            => 'required',
                            'customer'        => 'required',
                            'orden_compra'    => 'required|unique:projects',
                            'purchase_date'   => 'required',
                            'item'            => 'required',
                             ), array(
                            'required'        => 'Este campo no puede quedar vacio',
                     ));
        
        //Si validador falla, muestra errores. Sino; procesa los datos e ingresa proyecto.
        if ($validator->fails()) {
            
            return Redirect::route('crear-proyecto-alianza')
                            ->withErrors($validator)
                            ->withInput();
        }else{
            
            $name               = Input::get('name');
            $name_alianza       = Input::get('name_alianza');
            $customer           = Input::get('customer');
            $purchase_order     = Input::get('orden_compra');
            $purchase_date      = Input::get('purchase_date');
            $item               = Input::get('item');
            $value              = Input::get('value');
            $porcentaje_alianza = Input::get('porcentaje_alianza');
            
            //Mover el archivo a la carpeta de archivos
            if(Input::File('archivo')){
                
                 $archivo        = Input::File('archivo')
                                    ->move('archivos/pdf', $name . '_' . $name_alianza . '_' . Input::File('archivo')->getClientOriginalName());
                 $archivo        = $name . '_' . $name_alianza . '_' . Input::File('archivo')->getClientOriginalName();
            }else{
                
                 $archivo = NULL;
            }
            
            $suma_porcentaje = Input::get('milestone');
            
            for ($r = 0; $r <= 100; $r++) {
                
                               
                    $suma_porcentaje = $suma_porcentaje + Input::get($r);
                
            }
                               
            if ($suma_porcentaje > 100) {
                
                return Redirect::route('crear-proyecto-alianza')
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
            
            //Ingreso de proyecto        
            $project = new Project;

            $project->customer_id        = $customer;
            $project->nombre             = $name;
            $project->nombre_alianza     = $name_alianza;
            $project->orden_compra       = $purchase_order;
            $project->fecha_orden_compra = $purchase_date;
            $project->item_comprado      = $item;
            $project->valor              = $value;
            $project->valor_uf           = $value_uf;
            $project->pdf                = $archivo;
            $project->type               = 0;
            $project->situation_id       = 1;
            $project->porcentaje_alianza = $porcentaje_alianza;
            $project->save();
            
            $project_id = $project->id;
                 
            //ingreso de hitos anclados al proyecto

            $milestones[]  = array();
            $milestones[0] = Input::get('milestone');
            
            //Ingreso de primer hito
            $bill = new Bill;
            
            $bill->project_id = $project_id;
            $bill->porcentaje = $milestones[0];
            $bill->save();
            
            for ($x = 1; $x <= 100; $x++) {
                
                if (Input::has($x)) {

                    $milestones[$x] = Input::get($x);
                    
                    //Ingreso de hitos añadidos en formulario
                    $bill = new Bill;
                    
                    $bill->project_id = $project_id;
                    $bill->porcentaje = $milestones[$x];
                    
                    $bill->save();
      
                }
            }

            if ($project_id) {

                return Redirect::route('ver-proyectos-alianza')
                                ->with('global', 'Proyecto Alianza creado');
            }
        }
    }
    
    public function postEditarhitoalianza(){
         
            $suma_porcentaje = Bill::where('project_id', Input::get('project_id'))->sum('porcentaje');
        
            Bill::where('porcentaje', '=', 0)->where('project_id', '=', Input::get('project_id'))->delete();
        
            $suma_porcentaje = $suma_porcentaje + Input::get('hito');
            
            for ($r = 0; $r <= 100; $r++) {
               
                if (Input::has($r)) {
                    
                    $suma_porcentaje =  $suma_porcentaje + Input::get($r);                   
                }
            }
            
            if($suma_porcentaje > 100){
                
                return Redirect::route('ver-proyectos-alianza')
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
            
                    return Redirect::route('ver-proyectos-alianza');
                
            }
        
    }
    
    public function getHistoricos(){
         $projects = Project::with('customers', 'bills')
                 ->where('type','=','0')
                 ->where('situation_id', '=', '2')->orWhere('situation_id', '=', '4')
                 ->paginate(10);
                    
         return View::make('content.ProyectosAlianza.ver-historicos')
                        ->with('projects', $projects);
    }
    public function getEliminados(){
         $projects = Project::with('customers', 'bills')
                 ->where('type','=','0')
                 ->where('situation_id', '=', '3')
                 ->paginate(10);
                    
         return View::make('content.ProyectosAlianza.ver-eliminados')
                        ->with('projects', $projects);
    }

}

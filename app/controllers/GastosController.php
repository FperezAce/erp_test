<?php
class GastosController extends BaseController {
 
    public function getVer(){
        $gastos = Utility::with('utility_payments')->paginate(10);
  
        return View::make('content-pagos.Gastos.ver-gastos')
                        ->with('gastos', $gastos);
        
    }
    public function getAgregar(){
        
          return View::make('content-pagos.Gastos.agregar-gasto' );
    }
    
    public function postAgregar(){
        
         $validator = Validator::make(Input::all(), array(
                    'nombre'   => 'required',
                    
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('agregar-gasto')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $nombre    = Input::get('nombre');
            
       
            $gasto = new Utility();
            
            $gasto->nombre     = $nombre;
             
            if ($gasto->save()) {

                return Redirect::route('agregar-gasto')
                                ->with('global', 'Gasto fijo agregado con éxito');
            }
        }
        
          return View::make('content-pagos.Gastos.agregar-gasto' );
    }
    
    public function getpagar(){
         
        $gastos = Utility::all()->lists('nombre', 'id');
        $gastos_combo = array(0 => "Seleccione un gasto fijo a pagar ... ") + $gastos;
        $selected = array();
     
        
         return View::make('content-pagos.Gastos.pagar-gasto', compact('gastos_combo', 'selected' ));
        
    }
    
    public function postPagar(){
        
        $validator = Validator::make(Input::all(), array(
                    'gasto'   => 'required',
                    'monto'   => 'required',
                    'fecha'   => 'required',
                    
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('pagar-gasto')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $gasto      = Input::get('gasto');
            $monto      = Input::get('monto');
            $fecha      = Input::get('fecha');
            
            $pago_gasto = new UtilityPayment();
            
            $pago_gasto->utility_id  = $gasto;
            $pago_gasto->monto       = $monto;
            $pago_gasto->fecha       = $fecha;
             
            if ($pago_gasto->save()) {

                return Redirect::route('pagar-gasto')
                                ->with('global', 'Gasto fijo pagado con éxito');
            }
        }
        
          return View::make('content-pagos.Gastos.pagar-gasto' );
        
    }
    
    public function getBuscar() {
             
         $pagos = UtilityPayment::with('utilities')->get();
        // $funcionarios = Employee::with('jobs.job_types', 'payments', 'contract_types')->get();
        
        return View::make('content-pagos.Gastos.buscador');
    }
    
    public function postBuscar(){
        
        
        if(Input::has('ano')){
             $validator = Validator::make(Input::all(), array(
                    'ano'   => 'required'
                        ), array(
                    'required'      => 'Debe ingresar un año para buscar',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('buscar-gasto')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $ano_actual    = Input::get('ano');
            
            $pagos = UtilityPayment::with('utilities')->get();
            
            $pagos_anual = Utility::with(array('utility_payments' => function($query){
                        $query->where('fecha', '>=', Input::get('ano').'-01-01')->where('fecha', '<=', Input::get('ano').'-12-31');
                    }))->paginate(10);
 
            return View::make('content-pagos.Gastos.ver-pagos')->with('pagos',$pagos )->with('ano_actual',$ano_actual )->with('pagos_anual', $pagos_anual);
    
            
        }  
        }else{
             
            $ano_actual    = date('Y');
            
            $pagos = UtilityPayment::with('utilities')->get();
            
            $pagos_anual = Utility::with(array('utility_payments' => function($query){
                        $query->where('fecha', '>=', Input::get('ano').'-01-01')->where('fecha', '<=', Input::get('ano').'-12-31');
                    }))->paginate(10);
 
            return View::make('content-pagos.Gastos.ver-pagos')->with('pagos',$pagos )->with('ano_actual',$ano_actual )->with('pagos_anual', $pagos_anual);
    
        }
        
    }
   public function getEditar($id) {
        $gastos = Utility::with('utility_payments')->paginate(10);
        $gasto = Utility::find($id);  
        
        return View::make('content-pagos.Gastos.editar-gasto')
                ->with('gasto', $gasto)
                ->with('gastos', $gastos);
    }
      public function postEditar() {

        $gasto = Utility::find(Input::get('id'));  

        $gasto->nombre = Input::get('nombre');

        $gasto->save();
    

        return Redirect::route('ver-gasto')
                        ->with('global', 'Gasto fijo editado correctamente!');
    }
    public function eliminar($id){
         $pago = UtilityPayment::find($id);

        $pago->delete();
        return Redirect::route('buscar-gasto')
                        ->with('global', 'Pago eliminado correctamente!');
        
    }
}
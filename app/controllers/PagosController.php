<?php
class PagosController extends BaseController {
    
      
    public function getVer(){
        
        $pagos = Payment::with('employee')->get();
        // $funcionarios = Employee::with('jobs.job_types', 'payments', 'contract_types')->get();
        
        return View::make('content-pagos.Pagos.buscador');
        
    }
    public function PostVer(){
        
        if(Input::has('ano')){
             $validator = Validator::make(Input::all(), array(
                    'ano'   => 'required'
                        ), array(
                    'required'      => 'Debe ingresar un año para buscar',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('buscar-remuneracion')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $ano_actual    = Input::get('ano');
            
            $pagos = Payment::with('employee.jobs.job_types')->get();
            
            $funcionarios = Employee::with(array('jobs.job_types', 'payments' => function($query){
                        $query->where('fecha', '>=', Input::get('ano').'-01-01')->where('fecha', '<=', Input::get('ano').'-12-31');
                    }, 'contract_types'))->paginate(10);
            
          
            return View::make('content-pagos.Pagos.ver-remuneracion')->with('pagos',$pagos )->with('ano_actual',$ano_actual )->with('funcionarios', $funcionarios);
    
            
        }  
            
        }else{
            $ano_actual    = date('Y');
            
             $pagos = Payment::with('employee.jobs.job_types')->get();
            
            $funcionarios = Employee::with(array('jobs.job_types', 'payments' => function($query){
                        $query->where('fecha', '>=', Input::get('ano').'-01-01')->where('fecha', '<=', Input::get('ano').'-12-31');
                    }, 'contract_types'))->paginate(10);
            
          
            return View::make('content-pagos.Pagos.ver-remuneracion')->with('pagos',$pagos )->with('ano_actual',$ano_actual )->with('funcionarios', $funcionarios);
    
            
        }
        
        
        
        
    }
    public function getAgregar(){
        
        //Busco funcionarios
        
        $funcionarios = Employee::select(DB::raw('concat (nombre," ",apellido) as nombre,id'))->lists('nombre', 'id');
        $funcionarios_combo = array(0 => "Seleccione un funcionario ... ") + $funcionarios;
        $selected = array();
     
        
         return View::make('content-pagos.Pagos.agregar-remuneracion', compact('funcionarios_combo', 'selected' ));
    }
    
    public function postAgregar() {
        
        $validator = Validator::make(Input::all(), array(
                    'funcionario'   => 'required',
                    'bruto'         => 'required',
                    'liquido'       => 'required',
                    'fecha'         => 'required'
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('agregar-remuneracion')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $funcionario    = Input::get('funcionario');
            $bruto          = Input::get('bruto');
            $liquido        = Input::get('liquido');
            $fecha          = Input::get('fecha');
            
            if(Input::file('boleta')){
                
                $boleta = Input::File('boleta')
                            ->move('archivos/pagos/boletas', $funcionario.$fecha . '_' . Input::File('boleta')->getClientOriginalName());
                $boleta = $funcionario.$fecha . '_' . Input::File('boleta')->getClientOriginalName();
            }
            else{
                
                $boleta = NULL;
            }
            
            if(Input::File('comprobante')){
                
                $comprobante = Input::File('comprobante')
                            ->move('archivos/pagos/comprobantes', $funcionario . '_' . Input::File('comprobante')->getClientOriginalName());
                $comprobante = $funcionario . '_' . Input::File('comprobante')->getClientOriginalName();
            }
            else{
                
                $comprobante = NULL;
            }
      
    
            $pago = new Payment();
            
            $pago->employee_id     = $funcionario;
            $pago->fecha           = $fecha;
            $pago->url_boleta      = $boleta;
            $pago->url_comprobante = $comprobante;
            $pago->monto_bruto     = $bruto;
            $pago->monto_liquido   = $liquido;
             

            if ($pago->save()) {

                return Redirect::route('agregar-remuneracion')
                                ->with('global', 'Pago efectuado con éxito');
            }
        }
    }
    
    public function eliminar($id){
         $pago = Payment::find($id);

        $pago->delete();
        return Redirect::route('buscar-remuneracion')
                        ->with('global', 'Pago eliminado correctamente!');
        
    }
}
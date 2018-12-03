<?php

class ContratosController extends BaseController {
    
    
    public function getAgregar(){
        
        return View::make('content-pagos.Contratos.crear-contrato');
    }
    
    public function postAgregar(){
        
         $validator = Validator::make(Input::all(), array(
                    'nombre'        => 'required'
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('agregar-contrato')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $nombre           = Input::get('nombre');
            
            $contrato = new ContractType();
            
            $contrato->nombre = $nombre;
            
            if ($contrato->save()) {

                return Redirect::route('agregar-contrato')
                                ->with('global', 'Contrato agregado con éxito');
            }
        }
    }
    
    public function getVer() {
        
        $contratos = ContractType::with('employee')->paginate(10);
  
        return View::make('content-pagos.Contratos.ver-contratos')
                        ->with('contratos', $contratos);
    }

    public function getEditar($id) {
        $contratos = ContractType::with('employee')->paginate(10);
        $contrato = ContractType::with('employee')->where('id', '=', $id)->get();  
        
        return View::make('content-pagos.Contratos.editar-contrato')
                ->with('contrato', $contrato)
                ->with('contratos', $contratos);
    }
   
    public function postEditar() {

        $contrato = ContractType::find(Input::get('id'));

        $contrato->nombre = Input::get('nombre');

        $contrato->save();
     

        return Redirect::route('ver-contratos')
                        ->with('global', 'Contrato editado correctamente!');
    }
       
    

}

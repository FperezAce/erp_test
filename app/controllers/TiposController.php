<?php

class TiposController extends BaseController {
    
    
    public function getAgregar(){
        
        return View::make('content-pagos.Tipos.crear-tipo-cargo');
    }
    
    public function postAgregar(){
        
       
         $validator = Validator::make(Input::all(), array(
                    'nombre'        => 'required',
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('agregar-tipo-cargo')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $nombre           = Input::get('nombre');
            $color             = Input::get('car_color');
            
            $tipos = new JobType();
            
            $tipos->nombre = $nombre;
            $tipos->color  = $color;
            
            if ($tipos->save()) {

                return Redirect::route('agregar-tipo-cargo')
                                ->with('global', 'Tipo de cargo agregado con éxito');
            }
        }
    }
    
    public function getVer() {
        
        $tipos = JobType::with('jobs')->paginate(10);
  
        return View::make('content-pagos.Tipos.ver-tipos-cargo')
                        ->with('tipos', $tipos);
    }

    public function getEditar($id) {
        $tipos = JobType::with('jobs')->paginate(10);
        $tipo = JobType::with('jobs')->where('id', '=', $id)->get();  
        
        return View::make('content-pagos.Tipos.editar-tipo-cargo')
                ->with('tipo', $tipo)
                ->with('tipos', $tipos);
    }
   
    public function postEditar() {

        $tipo = JobType::find(Input::get('id'));

        $tipo->nombre = Input::get('nombre');
        $tipo->color = Input::get('car_color');

        $tipo->save();
     

        return Redirect::route('ver-tipos-cargo')
                        ->with('global', 'Tipo de cargo editado correctamente!');
    }
       
    

}

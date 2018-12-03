<?php

class CargosController extends BaseController {
    
    
    public function getAgregar(){
        
        $tipos = JobType::where('id', '!=', 0)->get()->lists('nombre', 'id');
        $tipos_combo = array(0 => "Seleccione un tipo de cargo ... ") + $tipos;
        $selected = array();
        
        return View::make('content-pagos.Cargos.crear-cargo', compact('tipos_combo', 'selected' ));
    }
    
    public function postAgregar(){
        
         $validator = Validator::make(Input::all(), array(
                    'nombre'        => 'required',
                    'tipo'         => 'required'
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('agregar-cargo')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $nombre           = Input::get('nombre');
            $descripcion        = Input::get('descripcion');
            $tipo              = Input::get('tipo');
      
            $cargo = new Job();
            
            $cargo->nombre           = $nombre;
            $cargo->descripcion      = $descripcion;
            $cargo->job_type_id      = $tipo;
            
            if ($cargo->save()) {

                return Redirect::route('agregar-cargo')
                                ->with('global', 'Cargo agregado con éxito');
            }
        }
    }
    
    public function getVer() {
        
        $cargos = Job::with('job_types', 'employees')->paginate(10);
  
        return View::make('content-pagos.Cargos.ver-cargos')
                        ->with('cargos', $cargos);
    }

    public function getEditar($id) {
        $cargos = Job::with('job_types', 'employees')->paginate(10);
        $cargo = Job::with('job_types', 'employees')->where('id', '=', $id)->get();  
        
        
        $tipos = JobType::where('id', '!=', 0)->get()->lists('nombre', 'id');
        $tipos_combo = array(0 => "Seleccione un tipo de cargo ... ") + $tipos;
        $selected = array();
        
        return View::make('content-pagos.Cargos.editar-cargo', compact('tipos_combo'))
                ->with('cargo', $cargo)
                ->with('cargos', $cargos);
    }
   

    public function postEditar() {

        $cargo = Job::find(Input::get('id'));

        $cargo->nombre = Input::get('nombre');
        $cargo->descripcion = Input::get('descripcion');
        $cargo->job_type_id = Input::get('tipo');

        $cargo->save();
     

        return Redirect::route('ver-cargos')
                        ->with('global', 'Cargo editado correctamente!');
    }
       
    

}

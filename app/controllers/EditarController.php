<?php

class EditarController extends BaseController{
    
    public function getProyectosVer(){
       $clientes = Project::all()->lists('nombre', 'id');
       $combobox =  $clientes;
       return View::make("content.EditarProyecto.editar-proyecto", compact('combobox'));       
    }
    
    public function getTiposVer(){
       $clientes = Proposal::all()->lists('tipo', 'id');
       $combobox =  $clientes;
       return View::make("content.EditarTipo.editar-tipo", compact('combobox'));       
    }
    
    public function postProyectosVer(){
       $proyectos = Project::all()->lists('nombre', 'id');
       $combobox =  $proyectos;
                
       $proyecto = Project::find(Input::get('proyectos'));
       
       $facturas = $proyecto->bills;
             
       return View::make("content.EditarProyecto.proyecto-encontrado",compact('combobox'))
              ->with('detalle_proyecto', $proyecto)
              ->with('facturas', $facturas);       
    }
    
    public function postTiposVer(){
        
       $tipos = Proposal::all()->lists('tipo', 'id');
       $combobox =  $tipos;
                
       $tipo = Proposal::find(Input::get('tipos'));
       
      
             
       return View::make("content.EditarTipo.tipo-encontrado",compact('combobox'))
              ->with('detalle_tipo', $tipo);
                   
    }
    
    public function postEditar(){
                       
       
        $validator = Validator::make(Input::all(), array(
                    'orden_compra'    => 'unique:projects,orden_compra,'.Input::get('id'),
                     ), array(
                    'unique'          => 'La orden de compra debe ser única',
        
        ));

        if ($validator->fails()) {

             return View::route('editar-proyecto')
                            ->withErrors($validator)
                            ->withInput();
        }else{
            
             $proyecto = Project::find(Input::get('id'));
        
             $proyecto->nombre             = Input::get('name');
             $proyecto->orden_compra       = Input::get('orden_compra');
             $proyecto->fecha_orden_compra = Input::get('fecha_orden_compra');
             $proyecto->item_comprado      = Input::get('item');
             $proyecto->valor              = Input::get('valor');
             $proyecto->valor_uf           = Input::get('valor_uf');
              if(Input::File('archivo')){
                
                $archivo = Input::File('archivo')
                            ->move('archivos/pdf', Input::get('orden_compra'). '_' . Input::File('archivo')->getClientOriginalName());
                $archivo = Input::get('orden_compra'). '_' . Input::File('archivo')->getClientOriginalName();
                $proyecto->pdf                = $archivo;
                
              }
             $proyecto->nombre_alianza     = Input::get('nombre_alianza');
             $proyecto->porcentaje_alianza = Input::get('porcentaje_alianza');

             $proyecto->save();
             
             $milestones[] = array();
              for ($x = 1; $x <= 10000; $x++) {
                
                if (Input::has($x)) {
              
                    $milestones[$x] = Input::get($x);
                   
                    $bill = Bill::find($x);
                    
                    $bill->porcentaje = $milestones[$x];
                    
                    $bill->save();
                }
            }
             
             return Redirect::route('editar-proyecto');
            
        }
     
    }
    
    public function postEditart(){
        $validator = Validator::make(Input::all(), array(
                    'codigo'    => 'unique:proposals,codigo,'.Input::get('id'),
                     ), array(
                    'unique'          => 'El código debe ser único.',
        
        ));

        if ($validator->fails()) {

             return View::route('editar-tipo')
                            ->withErrors($validator)
                            ->withInput();
        }else{
            
             $proposal = Proposal::find(Input::get('id'));
        
             $proposal->tipo               = Input::get('type');
             $proposal->codigo             = Input::get('code');
             $proposal->valor              = Input::get('value');
             
             $proposal->save();
             
             return Redirect::route('editar-tipo');
            
        }
     
    }
}
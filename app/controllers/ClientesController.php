<?php

class ClientesController extends BaseController{
    
public function getCreate()
    {   
     return View::make('content.Clientes.crear-cliente');
    }
              

    
    public function postCreate(){
        
        $validator = Validator::make(Input::all(), 
                array(
                    'name'            => 'required',
                    'rut'             => 'required',
                    'fono'            => 'required',
                    'tipo'            => 'required'
                    ),
                array(
                     'required'   => 'Este campo no puede quedar vacio',                     
                     ));
        
        if($validator->fails())
            {
                return Redirect::route('crear-cliente')
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {
                $customer = new Customer();
                
                $customer->nombre = Input::get('name');
                $customer->rut  = Input::get('rut');
                $customer->fono = Input::get('fono');
                $customer->mail = Input::get('mail');
                $customer->tipo = Input::get('tipo');
              
                if($customer->save()){
                                   
                        return Redirect::route('crear-proyecto')
                       ->with('global', 'Cliente agregado' );              
                }
            }
    }
    
    public function getClientesver() {
        $clientes = Customer::all();
           
        return View::make('content.Clientes.ver-clientes')
                ->with('clientes', $clientes);
    }
    
    public function getClienteseditar($id) {
        $clientes = Customer::all();
        $cliente = Customer::find($id);   
        return View::make('content.Clientes.editar-cliente')
                ->with('cliente', $cliente)
                ->with('clientes', $clientes);
    }
   

    public function postClienteeditar() {
               
             $cliente = Customer::find(Input::get('id'));
        
             $cliente->nombre              = Input::get('nombre');
             $cliente->rut                 = Input::get('rut');
             $cliente->mail                = Input::get('mail');
             $cliente->fono                = Input::get('fono');
             
             $cliente->save();
             
             return Redirect::route('ver-clientes')
                     ->with('global', 'Clientes editado correctamente!');
            
        }
            

}
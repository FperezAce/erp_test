<?php

class ConfiguracionesController extends BaseController {

    public function getVer() {

        return View::make('content.Configuraciones.inicio');
    }
    
    public function getVerpagos() {

        return View::make('content.Configuraciones.inicio-pagos');
    }
    public function getUsuariosver() {
        $usuarios = User::all();
           
        return View::make('content.Usuarios.ver')
                ->with('usuarios', $usuarios);
    }
    
    public function getUsuarioseditar($id) {
        $usuarios = User::all();
        $usuario = User::find($id);   
        return View::make('content.Usuarios.editar')
                ->with('usuario', $usuario)
                ->with('usuarios', $usuarios);
    }
   

    public function postUsuarioseditar() {
               
             $user = User::find(Input::get('id'));
        
             $user->name                   = Input::get('name');
             $user->last_name              = Input::get('last_name');
             $user->address                = Input::get('address');
             $user->email                  = Input::get('email');
             $user->phone                  = Input::get('phone');
             if(Input::get('pass') != ''){
                 $user->password               = Hash::make(Input::get('pass'));
             }
             
             $user->save();
             
             return Redirect::route('ver-usuarios')
                     ->with('global', 'Usuario editado correctamente!');
            
        }
        
        public function eliminar($id) {
        $user = User::find($id);

        $user->delete();
        return Redirect::route('ver-usuarios')
                        ->with('global', 'Usuario eliminado correctamente!');
    }

}

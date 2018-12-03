<?php

class FuncionariosController extends BaseController {
    
    
    public function getAgregarFuncionario(){
        
        $cargos = Job::where('id', '!=', 0)->get()->lists('nombre', 'id');
        $cargos_combo = array(0 => "Seleccione un cargo ... ") + $cargos;
        $selected = array();
        
        $contratos = ContractType::where('id', '!=', 0)->get()->lists('nombre', 'id');
        $contratos_combo = array(0 => "Seleccione un tipo de contrato ... ") + $contratos;
        
        return View::make('content-pagos.Funcionarios.crear-funcionario', compact('cargos_combo', 'contratos_combo', 'selected' ));
    }
    
    public function postAgregarFuncionario(){
        
         $validator = Validator::make(Input::all(), array(
                    'nombre'        => 'required',
                    'apellido'      => 'required',
                    'cargo'         => 'required',
                    'bruto'         => 'required',
                    'liquido'       => 'required',
                    'contrato'      => 'required'
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',     
        ));

        if ($validator->fails()) {
            
            return Redirect::route('agregar-funcionario')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $nombres        = Input::get('nombre');
            $apellidos      = Input::get('apellido');
            $cargo          = Input::get('cargo');
            $bruto          = Input::get('bruto');
            $liquido        = Input::get('liquido');
            $contrato       = Input::get('contrato');
      
            $funcionario = new Employee();
            
            $funcionario->nombre           = $nombres;
            $funcionario->apellido         = $apellidos;
            $funcionario->job_id           = $cargo;
            $funcionario->contract_type_id = $contrato;
            $funcionario->salario_bruto    = $bruto;
            $funcionario->salario_liquido  = $liquido;
            
            if ($funcionario->save()) {
                
                //Agrego al historial de cargos asignados
                
                $historial_cargo = new JobRecord();
                
                $historial_cargo->job_id      = $cargo;
                $historial_cargo->employee_id = $funcionario->id;
                
                $historial_cargo->save();

                return Redirect::route('agregar-funcionario')
                                ->with('global', 'Funcionario agregado con éxito');
            }
        }
    }
    
    
    public function getFuncionariosver() {
        
        $funcionarios = Employee::with('jobs.job_types', 'payments', 'contract_types')->paginate(10);
  
        return View::make('content-pagos.Funcionarios.ver-funcionarios')
                        ->with('funcionarios', $funcionarios);
    }

    public function getFuncionarioseditar($id) {
        $funcionarios = Employee::with('jobs.job_types', 'payments', 'contract_types')->paginate(10);
        $funcionario = Employee::with('jobs.job_types', 'payments', 'contract_types')->where('id', '=', $id)->get();  
        
        
        $cargos = Job::where('id', '!=', 0)->get()->lists('nombre', 'id');
        $cargos_combo = array(0 => "Seleccione ... ") + $cargos;
        
        $contratos = ContractType::where('id', '!=', 0)->get()->lists('nombre', 'id');
        $contratos_combo = array(0 => "Seleccione ... ") + $contratos;
        
        return View::make('content-pagos.Funcionarios.editar-funcionario', compact('cargos_combo', 'contratos_combo'))
                ->with('funcionario', $funcionario)
                ->with('funcionarios', $funcionarios);
    }
   

    public function postFuncionarioeditar() {

        $funcionario = Employee::find(Input::get('id'));

        $funcionario->nombre = Input::get('nombre');
        $funcionario->apellido = Input::get('apellido');
        $funcionario->salario_bruto = Input::get('salario_bruto');
        $funcionario->salario_liquido = Input::get('salario_liquido');
        $funcionario->job_id = Input::get('cargo');
        $funcionario->contract_type_id = Input::get('contrato');

        $funcionario->save();
        //Busco el cargo inmediatamente anterior

        $cargo_anterior = DB::table('job_records')->select('job_id', 'employee_id', 'created_at')
                        ->where('employee_id', '=', $funcionario->id)
                        ->orderBy('created_at', 'desc')->first();

       
        if($cargo_anterior){
            if (Input::get('cargo') != $cargo_anterior->job_id) {

            $historial_cargo = new JobRecord();

            $historial_cargo->job_id = Input::get('cargo');
            $historial_cargo->employee_id = $funcionario->id;

            $historial_cargo->save();
        }
        }else{
            
            $historial_cargo = new JobRecord();

            $historial_cargo->job_id = Input::get('cargo');
            $historial_cargo->employee_id = $funcionario->id;

            $historial_cargo->save();
        }
        
        
        



        return Redirect::route('ver-funcionarios')
                        ->with('global', 'Funcionario editado correctamente!');
    }

    public function getVerHistorial($id){
       $funcionarios = Employee::with('jobs.job_types', 'payments', 'contract_types')->paginate(10);
       $funcionario = Employee::with('jobs.job_types', 'payments', 'contract_types', 'job_records.jobs')->where('id', '=', $id)->get();  
       return View::make('content-pagos.Funcionarios.historial-funcionario')
                ->with('funcionario', $funcionario)
                ->with('funcionarios', $funcionarios);
    }
       
    

}

<?php

Class EmployeeTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('employees')->insert(array(
            'nombre'           => 'Esteban',
            'apellido'         => 'Lillo',
            'salario_liquido'  => 750000,
            'salario_bruto'    => 600000,
            'job_id'           => 1,
            'contract_type_id'  => 1
                        
        ));
        
        DB::table('employees')->insert(array(
            'nombre'           => 'Nathaly',
            'apellido'         => 'Nuñez',
            'salario_liquido'  => 1000000,
            'salario_bruto'    => 1000000,
            'job_id'           => 2,
            'contract_type_id'  => 2
                        
        ));
        
     
    }
}
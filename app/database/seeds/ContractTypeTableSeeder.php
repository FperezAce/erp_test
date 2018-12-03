<?php

Class ContractTypeTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('contract_types')->insert(array(
            'nombre'        => 'Contrato Indefinido',
        ));
        DB::table('contract_types')->insert(array(
            'nombre'        => 'Boleta Honorarios',
        ));
        DB::table('contract_types')->insert(array(
            'nombre'        => 'Contrato Plazo Fijo',
        ));
    }
}
<?php

Class JobTypeTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('job_types')->insert(array(
            'nombre'        => 'Interno',
        ));
        DB::table('job_types')->insert(array(
            'nombre'        => 'Externo',
        ));
    }
}
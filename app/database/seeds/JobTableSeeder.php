<?php

Class JobTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('jobs')->insert(array(
            'nombre'        => 'Analista Programador',
            'job_type_id'   => 1,
        ));
        DB::table('jobs')->insert(array(
            'nombre'        => 'Diseñador Gráfico',
            'job_type_id'   => 2,
        ));
        DB::table('jobs')->insert(array(
            'nombre'        => 'Jefe de Programación',
            'job_type_id'   => 1,
        ));
    }
}
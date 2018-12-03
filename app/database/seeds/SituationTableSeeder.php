<?php

Class SituationTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('situations')->insert(array(
            'nombre'        => 'Activo',
        ));
        DB::table('situations')->insert(array(
            'nombre'        => 'Historico',
        ));
        DB::table('situations')->insert(array(
            'nombre'        => 'Eliminado',
        ));
        DB::table('situations')->insert(array(
            'nombre'        => 'Terminado',
        ));
     
    }
}
<?php

Class CustomerTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('customers')->insert(array(
            'nombre'        => 'MDS',
            'rut'         => '88231237-6',
            'mail'        => 'mds@mail.com',
            'fono'        => '88212811',
            'tipo'        => 1
        ));
        
        DB::table('customers')->insert(array(
            'nombre'        => 'SUBDERE',
            'rut'         => '88231237-6',
            'mail'        => 'subdere@mail.com',
            'fono'        => '88212811',
            'tipo'        => 1
        ));
        
        DB::table('customers')->insert(array(
            'nombre'      => 'MINISTERIO DE ENERGÌA',
            'rut'         => '8823237-6',
            'mail'        => 'menergia@mail.com',
            'fono'        => '88212811',
            'tipo'        => 1
        ));
        
        DB::table('customers')->insert(array(
            'nombre'      => 'CLIENTE ALIANZA',
            'rut'         => '8823237-6',
            'mail'        => 'alianza@mail.com',
            'fono'        => '88212811',
            'tipo'        => 2
        ));
     
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

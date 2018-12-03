<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProposalTableSeeder
 *
 * @author pc1wm
 */
class ProposalTableSeeder extends Seeder{
     public function run(){
        
       
        DB::table('proposals')->insert(array(
            'tipo'        => 'Programador',
            'valor'       => '0.2',       
        ));
        
        DB::table('proposals')->insert(array(
            'tipo'        => 'Analista',
            'valor'       => '0.2',       
        ));
        
        DB::table('proposals')->insert(array(
            'tipo'        => 'Ingeniero',
            'valor'       => '0.5',       
        ));
        
        DB::table('proposals')->insert(array(
            'tipo'        => 'Diseñador',
            'valor'       => '0.2',       
        ));
        
        DB::table('proposals')->insert(array(
            'tipo'        => 'Tester',
            'valor'       => '0.3',       
        ));
 
    }
}

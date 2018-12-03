<?php

Class UserTableSeeder extends Seeder{
    
    public function run(){
        
       
        DB::table('users')->insert(array(
            'name'        => 'admin',
            'last_name'   => 'admin',
            'email'       => 'admin@mail.com',
            'address'     => 'test',
            'phone'       =>  0,
            'username'    => 'admin',
            'password'    => Hash::make('admin'),
            'active'      => 1
        ));
     
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


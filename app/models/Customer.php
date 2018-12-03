<?php


class Customer extends Eloquent{

    protected  $table = 'customers';
    
    public function projects(){
        return $this->hasMany('Project', 'customer_id');
        
    }
    public function projectsa(){
        return $this->hasMany('Project')->where('projects.situation_id','=', 1);
        
    }
    public static function getAll()
    {
        return DB::table('customers')->get();
    }
    
    public static function insert($name, $rut, $fono, $mail)
    {
        return DB::table('customers')->insert(array(
            'nombre' => $name, 'rut' => $rut, 'mail' => $mail, 'fono' => $fono));
    }
}
<?php


class Utility extends Eloquent{

    protected  $table = 'utilities';
    
    public function utility_payments(){
        return $this->hasMany('UtilityPayment', 'utility_id');
        
    }
}
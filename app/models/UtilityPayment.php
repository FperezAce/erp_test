<?php


class UtilityPayment extends Eloquent{

    protected  $table = 'utility_payments';
    
    public function utilities(){
        return $this->belongsTo('Utility', 'utility_id');
        
    }
}
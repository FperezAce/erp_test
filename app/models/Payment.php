<?php


class Payment extends Eloquent{

    protected  $table = 'payments';
    
    public function employee(){
        return $this->belongsTo('Employee', 'employee_id');
        
    }
}
<?php


class ContractType extends Eloquent{

    protected  $table = 'contract_types';
    
    public function employee(){
        return $this->hasMany('Employee', 'contract_type_id');
        
    }
}
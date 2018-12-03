<?php

class Situation extends Eloquent{
    
    protected $table = 'situations';
    
    public function projects(){
        return $this->hasMany('Project', 'situation_id');       
    }
}
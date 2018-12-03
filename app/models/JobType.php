<?php


class JobType extends Eloquent{

    protected  $table = 'job_types';
    
    public function jobs(){
        return $this->hasMany('Job', 'job_type_id');
        
    }
}
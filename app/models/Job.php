<?php


class Job extends Eloquent{

    protected  $table = 'jobs';
    
    public function employees(){
        return $this->hasMany('Employee', 'job_id');
        
    }
    
     public function job_types(){
        return $this->belongsTo('JobType', 'job_type_id');
        
    }
    
    public function job_records(){
        return $this->hasMany('JobRecord', 'job_id');
        
    }
}
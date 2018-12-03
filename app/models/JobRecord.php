<?php


class JobRecord extends Eloquent{

    protected  $table = 'job_records';
    
    public function employee(){
        return $this->belongsTo('Employee', 'employee_id');
        
    }
    
    public function jobs(){
        return $this->belongsTo('Job', 'job_id');
        
    }
}
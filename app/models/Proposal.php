<?php

class Proposal extends Eloquent{
    
    protected $table = 'proposals';
    
    public function proposal_details()
    {
        return $this->belongsTo('Proposal_detail');
    }
    
    
}
    
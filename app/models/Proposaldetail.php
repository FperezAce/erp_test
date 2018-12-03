<?php

class Proposaldetail extends Eloquent{
    
    protected $table = 'proposal_details';
    
    public function proposal()
    {
        return $this->hasOne('Proposal');
    }
    
    public static function buscar($id){
       return DB::table('proposal_details')
               ->join('proposals', 'proposal_details.proposal_id', '=', 'proposals.id')
               ->where('proposal_details.id', '=', $id)
               ->select('proposal_details.id AS proposal_detail_id',
                        'proposals.tipo',
                        'proposals.codigo',
                        'proposal_details.cantidad',
                        'proposal_details.fecha',
                        'proposal_details.valor_uf',
                        'proposal_details.horas_diarias',
                        'proposal_details.numero_dias',
                        'proposal_details.horas_totales',
                        'proposal_details.total',
                        'proposal_details.ppm',
                        'proposal_details.gastos_asociados',
                        'proposal_details.utilidad',
                        'proposal_details.nombre',
                        'proposals.valor'
                       )
               ->first(); 
    }
    public static function todos(){
        
        return DB::table('proposal_details')
               ->join('proposals', 'proposal_details.proposal_id', '=', 'proposals.id')
               ->select(
                       'proposal_details.id AS proposal_detail_id',
                       'proposals.tipo',
                       'proposals.codigo',
                       'proposal_details.cantidad',
                       'proposal_details.fecha',
                       'proposal_details.valor_uf',
                       'proposal_details.horas_diarias',
                       'proposal_details.numero_dias',
                       'proposal_details.horas_totales',
                       'proposal_details.total',
                       'proposal_details.ppm',
                       'proposal_details.gastos_asociados',
                       'proposal_details.utilidad',
                       'proposal_details.nombre',
                       'proposals.valor'
                       )
               ->get();      
    }
    
}
    
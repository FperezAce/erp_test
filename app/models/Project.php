<?php

class Project extends Eloquent{
    
    protected $table = 'projects';
    
    
    public function bills(){
          return  $this->hasMany('Bill', 'project_id');
        
    }
    
    public function situations(){
          return  $this->BelongsTo('Situation', 'situation_id');
        
    }
    
    public function customers(){
        return $this->BelongsTo('Customer', 'customer_id');
       
    }
    
    
    
    //---------------QUERY BUILDER------------QUERY BUILDER--------------QUERY BUILDER------------------------------------------------------------------------------------------------------------
    
    public static function total_propio(){
        return DB::table('projects')
                        ->select(DB::raw('SUM(valor*valor_uf) AS total'))
                        ->where('type', '=', 1)
                        ->where('situation_id', '!=', 3)
                        ->first();
    }
    public static function total_alianza(){
        return DB::table('projects')
                        ->select(DB::raw('SUM(valor*valor_uf) AS total'))
                        ->where('type', '=', 0)
                        ->where('situation_id', '!=', 3)
                        ->first();
    }
    
    public static function cancelado_propios(){
        return DB::table('bills')
                        ->select(DB::raw('SUM(bills.monto) AS cancelado_propio'))
                        ->join('projects', function($join)
                                {
                                    $join->on('projects.id', '=', 'bills.project_id')
                                            ->where('projects.type', '=', 1)
                                            ->where('projects.situation_id', '!=', 3);
                                })
                        ->where('bills.fecha_cancelado', '!=', 'NULL')
                        ->first();
    }
    
    public static function cancelado_alianza(){
        return DB::table('bills')
                        ->select(DB::raw('SUM(bills.monto) AS cancelado_alianza'))
                        ->join('projects', function($join)
                                {
                                    $join->on('projects.id', '=', 'bills.project_id')
                                            ->where('projects.type', '=', 0)
                                            ->where('situation_id', '!=', 3);
                                })
                        ->where('bills.fecha_cancelado', '!=', 'NULL')
                        ->first();
    }
    
    public static function emitido_propios(){
        return DB::table('bills')
                        ->select(DB::raw('SUM(bills.monto) AS emitido_propio'))
                        ->join('projects', function($join)
                                {
                                    $join->on('projects.id', '=', 'bills.project_id')
                                            ->where('situation_id', '!=', 3)
                                            ->where('projects.type', '=', 1);
                                })
                        ->where('bills.fecha_emision', '!=', 'NULL')
                        ->first();
    }
    
    public static function emitido_alianza(){
        return DB::table('bills')
                        ->select(DB::raw('SUM(bills.monto) AS emitido_alianza'))
                        ->join('projects', function($join)
                                {
                                    $join->on('projects.id', '=', 'bills.project_id')
                                            ->where('situation_id', '!=', 3)
                                            ->where('projects.type', '=', 0);
                                })
                        ->where('bills.fecha_emision', '!=', 'NULL')
                        ->first();
    }
    
    public static function total_emitidos(){
        return DB::table('bills')
                        ->select(DB::raw('case when SUM(bills.monto) is null then 0 else SUM(monto) END  AS total_emitido, ((SELECT SUM(valor*valor_uf) FROM projects where projects.situation_id != 3) - case when SUM(bills.monto) is null then 0 else SUM(monto) END) as total_por_emitir'))
                ->join('projects', function($join)
                                {
                                    $join->on('projects.id', '=', 'bills.project_id')
                                            ->where('situation_id', '!=', 3);
                                })        
                ->where('bills.fecha_emision', '!=', 'null')
                        ->get();
    }
    
    public static function total_cancelados(){
        return DB::table('projects')
                        ->select(DB::raw('SUM(projects.valor*projects.valor_uf) - (SELECT case when SUM(monto) is null then 0 else SUM(monto) END as monto  FROM bills inner join projects p on (bills.project_id = p.id and p.situation_id != 3 ) WHERE fecha_cancelado is not null) as total_por_cancelar,
                                         (SELECT case when SUM(monto) is null then 0 else SUM(monto) END as monto  FROM bills inner join projects p on (bills.project_id = p.id and p.situation_id != 3) WHERE fecha_cancelado is not null) as total_cancelado' ))                    
                ->where('situation_id', '!=', 3)        
                ->get();
    }
    

    
    public static function totales_alianza(){
        return DB::table('bills')
                        ->select(DB::raw('projects.type as tipo, SUM(bills.monto) AS total_emitido, SUM(projects.valor * projects.valor_uf) AS total_proyectos, (SUM(projects.valor * projects.valor_uf) - SUM(bills.monto)) AS por_emitir'))
                        ->join('projects', function($join)
                                {
                                    $join->on('projects.id', '=', 'bills.project_id')
                                            ->where('situation_id', '!=', 3);
                                })
                        ->where('bills.fecha_emision', '!=', 'NULL')
                    
                        ->get();
    }
    
    
    
    
    public static function get($customerID)
    {
        return DB::table('projects')->wherecustomer_id($customerID)->wheretype(1)->get();
    }
    
    public static function getAlianza($customerID)
    {
        return DB::table('projects')->wherecustomer_id($customerID)->wheretype(0)->get();
    }
    
    public static function getHitos($project_id)
    {
        return DB::table('milestones')->whereproject_id($project_id)->get();
    }
    
    /*public static function getHitoss()
    {
        return DB::table('projects')
            ->join('bills', 'trips.lid', '=', 'locations.id')
            ->get(array('trips.number', 'trips.title', 'trips.cost', 'locations.name', 'locations.day'));
    }*/
    
    public static function insert($customer, $name, $purchase_order, $purchase_date, $item, $value, $value_uf, $archivo)
    {
                $project = new Project;

                $project->customer_id = $customer;
                $project->nombre = $name;
                $project->orden_compra = $purchase_order;
                $project->fecha_orden_compra = $purchase_date;
                $project->item_comprado = $item;
                $project->valor = $value;
                $project->valor_uf = $value_uf;
                $project->pdf = $archivo;
                $project->type = 1;
                $project->save();                
                return $project->id;
    }
    
    public static function insertAlianza($customer, $name, $name_alianza, $purchase_order, $purchase_date, $item, $value, $value_uf, $archivo, $porcentaje_alianza)
    {
                $project = new Project;

                $project->customer_id = $customer;
                $project->nombre = $name;
                $project->nombre_alianza = $name_alianza;
                $project->orden_compra = $purchase_order;
                $project->fecha_orden_compra = $purchase_date;
                $project->item_comprado = $item;
                $project->valor = $value;
                $project->valor_uf = $value_uf;
                $project->pdf = $archivo;
                $project->type = 0;
                $project->porcentaje_alianza = $porcentaje_alianza;
                $project->save();                
                return $project->id;
    }
    
    public static function insertHitos($project_id, $porcentaje){
        
        return DB::table('bills')->insert(array(
            'project_id' => $project_id, 'porcentaje' => $porcentaje ));
    }
    
    public static function insertHitosAlianza($project_id, $porcentaje_alianza, $porcentaje){
        
        return DB::table('bills')->insert(array(
            'project_id' => $project_id, 'porcentaje' => $porcentaje, 'porcentaje_alianza' => $porcentaje_alianza ));
    }
    
    /*public static function insertHitos2($project_id, $porcentaje){
        
        return DB::table('milestones')->insert(array(
            'project_id' => $project_id, 'porcentaje' => $porcentaje ));
    }*/
}
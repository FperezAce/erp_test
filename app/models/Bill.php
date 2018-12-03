<?php


class Bill extends Eloquent{
    protected  $table = 'bills';
    
    public function projects(){
        return $this->belongsTo('Project');       
    }
      
    public static function get($projectID)
    {
        return DB::table('bills')->whereproject_id($projectID)->get();
           
    }
    
    public static function count()
    {
        return DB::table('bills')->count();
    }
    
    public static function insert($bill_id, $numero, $fecha_emision, $monto, $hito, $fecha_cancelado, $ppm)
    {
        return DB::table('bills')->where('id', $bill_id)
            ->update(array('fecha_emision' => $fecha_emision, 'numero' => $numero, 'monto' => $monto, 'hito' => $hito, 'fecha_cancelado' => $fecha_cancelado, 'ppm' => $ppm));
    }
    
    public static function updateAlianza($bill_id, $numero, $fecha_emision, $monto, $hito, $fecha_cancelado, $ppm, $factura_recibida, $monto_alianza, $numero_alianza, $pagado)
    {
        return DB::table('bills')->where('id', $bill_id)
            ->update(array('fecha_emision' => $fecha_emision, 'numero' => $numero, 'monto' => $monto, 'hito' => $hito, 'fecha_cancelado' => $fecha_cancelado, 'ppm' => $ppm, 'factura_recibida' => $factura_recibida, 'monto_alianza' => $monto_alianza, 'numero_alianza' => $numero_alianza, 'pagado' => $pagado ));
    }
    
    public static function insertBills($project_id, $porcentaje){
        
        return DB::table('bills')->insert(array(
            'project_id' => $project_id, 'porcentaje' => $porcentaje ));
    }
    
    public static function insert2($project_id, $numero, $fecha_emision, $monto, $hito, $fecha_cancelado, $ppm)
    {
        return DB::table('bills')->insert(array(
            'project_id' => $project_id, 'numero' => $numero, 'fecha_emision' => $fecha_emision, 'monto' => $monto, 'hito' => $hito, 'fecha_cancelado' => $fecha_cancelado, 'ppm' => $ppm));
    }
}
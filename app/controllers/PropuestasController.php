<?php
class PropuestasController extends BaseController {
    
    public function getCreate(){
        
        return View::make('content.Propuestas.crear-tipo');
    }
    
    public function postCreate(){
        
        $validator = Validator::make(Input::all(), array(
                    'type'          => 'required',
                    'code'          => 'required',
                    'value'         => 'required',
                        ), array(
                    'required'      => 'Este campo no puede quedar vacio',   
        ));

        if ($validator->fails()) {
            
            return Redirect::route('crear-tipo')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            
            $type           = Input::get('type');
            $code           = Input::get('code');
            $value          = Input::get('value');

            $proposal = new Proposal;
            
            $proposal->tipo    = $type;
            $proposal->codigo    = $code;
            $proposal->valor   = $value;
            
            $proposal->save();

            return Redirect::route('crear-tipo')
                                ->with('global', 'Tipo creado');
         
        }
    }
    
    public function getVer(){
        
        $propuestas = Proposaldetail::todos();
           
        return View::make('content.Propuestas.ver-tipo')
                ->with('propuestas', $propuestas);
    }
    
    public function getCalcular(){
        $tipos = Proposal::all()->lists('tipo', 'id');
        $combobox = array(0 => "Seleccione ... ") + $tipos;
        return View::make('content.Propuestas.calcular-tipo', compact('combobox'))
                ->with('tipos', $tipos);

    }
    
    public function postDetalles(){
        $id = Input::get('data');
        
        $Tipo = Proposal::find($id);
        
        return Response::json(array(
                    'valor'              => $Tipo->valor,
                    'codigo'             => $Tipo->codigo,
                    ));
       
    }
    
    public function postTotales(){
        $horas_diarias = Input::get('horas_diarias');
        $numero_dias   = Input::get('numero_dias');
        
        $horas_totales = $horas_diarias*$numero_dias;
        
        return Response::json(array(
                    'valor'              => $horas_totales,               
                    ));       
    }
    
    public function postTotalvalor(){
        $valor         = Input::get('valor');
        $cantidad      = Input::get('cantidad');
        $valor_uf      = Input::get('valor_uf');
        $horas_totales = Input::get('horas_totales');
        
        $valor_total = $valor*$valor_uf*$cantidad*$horas_totales;
        $ppm = $valor_total*0.035;
        
        return Response::json(array(
                    'valor'              => $valor_total,
                    'ppm'                => $ppm,
                    ));       
    }
    
    public function postUtilidad(){
        $total         = Input::get('total');
        $gastos        = Input::get('gastos');
        
        $utilidad = ($total - $gastos);
        
        return Response::json(array(
                    'valor'              => $utilidad,
                    ));       
    }
    
    public function postUf(){
        $date = Input::get("date");
        
        $url = "http://www.sii.cl/pagina/valores/uf/uf".date('Y').".htm";
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $html = curl_exec($ch);
        curl_close($ch);

        $dom = new DOMDocument();

        @$dom->loadHTML($html);
          
        list($year, $month, $day) = explode("-",$date); 
          
        $uf = ( $day * 12 )-( 12 - $month );

        $array_td = array();
        $celdas = $dom->getElementsByTagName('td');
        $contador = 1;
            
        foreach ($celdas as $td) {
                
            foreach ($td->childNodes as $attr) {
                 $value_td = $attr->nodeValue;
                 $array_td[$contador] = $value_td;
                 $contador = $contador + 1;   
            }
        }
         
        $value_uf = $array_td[$uf];
           
        $simbolos = array("$", ".", ",");
        $blanco   = array("", "", ".");
        $value_uf = str_replace($simbolos, $blanco, $value_uf);
        
        return Response::json(array(
                    'valor'              => $value_uf,
                    )); 
        
    }
    
    public function postGuardar(){
        
       $validator = Validator::make(Input::all(), array(
                    'values'          => 'required',
                    'cantidad'        => 'required|numeric',
                    'values_uf'       => 'required',
                    'horas_diarias'   => 'required',
                    'numeros_dias'    => 'required',
                    'horas_totales'   => 'required',
                    'total2'          => 'required',
                    'ppm'             => 'required',
                    'gastos'          => 'required|numeric',
                    'utilidad'        => 'required',
                     ), array(
                    'required'        => 'Por favor, complete todos los campos!',
                    'numeric'         => 'Solo se deben ingresar números!',     
        ));

        if ($validator->fails()) {

            return Response::json(array(
                        'success' => false,
                        'mensaje' => $validator->errors()->toArray()
            ));
        } else {
           
              $proposal_detail = new Proposaldetail;
              
              $proposal_detail->proposal_id      = Input::get('tipos');
              $proposal_detail->cantidad         = Input::get('cantidad');
              $proposal_detail->fecha            = Input::get('datepicker');
              $proposal_detail->valor_uf         = Input::get('values_uf');
              $proposal_detail->horas_diarias    = Input::get('horas_diarias');
              $proposal_detail->numero_dias      = Input::get('numeros_dias');
              $proposal_detail->horas_totales    = Input::get('horas_totales');
              $proposal_detail->total            = Input::get('total2');
              $proposal_detail->ppm              = Input::get('ppm');
              $proposal_detail->gastos_asociados = Input::get('gastos');
              $proposal_detail->utilidad         = Input::get('utilidad');
              $proposal_detail->nombre           = Input::get('name');
      
            if ($proposal_detail->save()) {

                return Response::json(array(
                            'success' => true,
                            'mensaje' => 'Ingresado correctamente'
                ));
            } else {


                return Response::json(array(
                            'success' => false,
                            'mensaje' => 0,
                ));
            }
        }
         
    }
    
    public function getEditar($id){
        $propuesta = Proposaldetail::buscar($id);
        
        return View::make('content.Propuestas.editar-propuesta')
                ->with('propuesta', $propuesta);
    }
    
    public function postEditar(){
           
              $proposal_detail = Proposaldetail::find(Input::get('id'));
            
              $proposal_detail->cantidad         = Input::get('cantidad');
              $proposal_detail->fecha            = Input::get('datepicker');
              $proposal_detail->valor_uf         = Input::get('values_uf');
              $proposal_detail->horas_diarias    = Input::get('horas_diarias');
              $proposal_detail->numero_dias      = Input::get('numeros_dias');
              $proposal_detail->horas_totales    = Input::get('horas_totales');
              $proposal_detail->total            = Input::get('total2');
              $proposal_detail->ppm              = Input::get('ppm');
              $proposal_detail->gastos_asociados = Input::get('gastos');
              $proposal_detail->utilidad         = Input::get('utilidad');
      
            if ($proposal_detail->save()) {

                return Response::json(array(
                            'success' => true,
                            'mensaje' => 'Editado correctamente'
                ));
            } else {
                return Response::json(array(
                            'success' => false,
                            'mensaje' => 0,
                ));
            }
    }
}
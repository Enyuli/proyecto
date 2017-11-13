<?php class cconsultores extends CI_Controller {

	public function __construct() {
	   parent::__construct();
	   $this->load->model('mconsultores');
     
	}

	function index(){

        $data['titulo']="Agence";
	   
		$this->load->view('templates_base/header',$data);
 		$data['result']=$this->mostrar_consultores();
        $this->load->view('templates_base/footer');
       
	}
	
  	/*autor: eacevedo
     * 
     * Mostrar consultores
     * 
     * Se listan todos los consultores
     * 
     * @Date created: 9/11/17
   
     */

	function mostrar_consultores(){ 
		$result		=	$this->mconsultores->obtener_consultores();

		if($result)
		{
		  $data['result']	=	$result;
		}
		else
		{
			$data['result']	= "";
			$data['notfound']="No se encontró registros";
		}
		$this->load->view('templates_content/vconsultores',$data);

	}
	
    /*autor: eacevedo
     * 
     * Obtener los datos de los consultores
     * 
     * Se obtienen todos los datos  de los consultores amostrar posteriormente en una tabla

     * @Date created: 10/11/17

     * @return array
   
     */
	function mostrar_datos_consultores(){


        $mes_desde=$_POST["mes_desde"];
        $year_desde=$_POST["year_desde"];
		$mes_hasta=$_POST["mes_hasta"];
		$year_hasta=$_POST["year_hasta"];

        //agrego 0 adelante del mes si es diferente 10,11,12
        if(($mes_desde!='10')and ($mes_desde!='11' )and ($mes_desde!='12')){

           $mes_desde=str_pad($mes_desde, 2, "0", STR_PAD_LEFT);
        }
        if(($mes_hasta!='10')and ($mes_hasta!='11' )and ($mes_hasta!='12')){

           $mes_hasta=str_pad($mes_hasta, 2, "0", STR_PAD_LEFT);
        }
        
  		$cadena_selected=$_POST["arreglo_selected"];
   
        $fecha_desde=$mes_desde."-".$year_desde;
        $fecha_hasta=$mes_hasta."-".$year_hasta;
        $cadena=substr($cadena_selected, 1);//le quite una coma adelante
        $resultado=explode(",",$cadena);
        $arreglo = array();
        $cont=0;
    
        foreach ($resultado as $r){
        	
			$operador_desde=">=";
			$operador_hasta="<=";
			$arreglo[$cont][0]=$this->mconsultores->obtener_datos_consultores($fecha_desde,$operador_desde,$r);
			$arreglo[$cont][1]=$this->mconsultores->obtener_datos_consultores($fecha_hasta,$operador_hasta,$r);
			$cont++;
	    }

        echo json_encode($arreglo);
    
    }
   
}



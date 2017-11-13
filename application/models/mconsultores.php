<?php class mconsultores extends CI_Model {

	
	public function __construct() {
	  
		parent::__construct();
	  
	}


  	/*autor: eacevedo
     * 
     * Obtener  los consultores
     * 
     * Se obtienen todos los nombres de los consultores
     * 
     * @Date created: 9/11/17
     * @return array
     */

	function obtener_consultores(){

		$tipo_usuario = array(0,1,2);

		$this->db->select('cao_usuario.no_usuario, cao_usuario.co_usuario');
        $this->db->from('cao_usuario');
        $this->db->join('permissao_sistema', 'permissao_sistema.co_usuario=cao_usuario.co_usuario', 'INNER');
        $this->db->where('co_sistema',1);
        $this->db->where('in_ativo','s');
        $this->db->where_in('co_tipo_usuario', $tipo_usuario);
        $this->db->order_by('cao_usuario.no_usuario','asc');


        $resultado	=	$this->db->get('');

        if($resultado->num_rows >= 1)
        {
                return $resultado->result();
        }
        else
        {
                return false;
        }
	}

	/*autor: eacevedo
     * 
     * Obtenerlos datos de los consultores
     * 
     * Se obtienen todos los datos  de los consultores

     * @param $fecha,$operador,$id_consultor
     * @Date created: 9/11/17
     * @return array
     */
	function obtener_datos_consultores($fecha,$operador,$id_consultor){
  
		   
            $this->db->select('cao_usuario.no_usuario,
            sum(cao_fatura.valor)-(sum(cao_fatura.valor)*(sum(cao_fatura.total_imp_inc)/100)) as valor_neto,
            sum(cao_salario.brut_salario) as costo_fijo,
            sum(cao_fatura.valor)-(sum(cao_fatura.valor)*(sum(cao_fatura.total_imp_inc)/100))*cao_fatura.comissao_cn as comision,
            
            (sum(cao_fatura.valor)-(sum(cao_fatura.valor)*(sum(cao_fatura.total_imp_inc)/100))-sum(cao_salario.brut_salario)+sum(cao_fatura.valor)-(sum(cao_fatura.valor)*(sum(cao_fatura.total_imp_inc)/100))*cao_fatura.comissao_cn) as lucro');
            $this->db->from('cao_usuario');   
            $this->db->join('cao_salario', 'cao_salario.co_usuario=cao_usuario.co_usuario', 'INNER');
            $this->db->join('cao_os', 'cao_usuario.co_usuario=cao_os.co_usuario', 'INNER');
            $this->db->join('cao_fatura', 'cao_fatura.co_os=cao_os.co_os', 'INNER');
            $this->db->join('cao_sistema', 'cao_fatura.co_sistema=cao_sistema.co_sistema', 'INNER');
            $this->db->where("date_format(cao_fatura.data_emissao, '%m-%Y')".$operador, $fecha);
            $this->db->where('cao_usuario.co_usuario' ,$id_consultor);

	        $resultado   =  $this->db->get('');
  

		      if($resultado->num_rows >= 1)
	         {
	                 return $resultado->result();
	         }
	         else
	         {
	                 return false;
	         }

	}

}
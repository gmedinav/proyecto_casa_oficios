<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
    

    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');   
            $this->load->library('session');     

			if($this->sesion_activa()==false){

				//$this->load->view('vw_login');
				redirect(base_url()."Login/");
				die();			
			}  
                   

    }     

	public function index()
	{

		$data['vista_incluida']= "admin/cliente/vw_cliente_listar";
		$data['titulo']= "Clientes";

        $this->load->view('template_admin/header');   
        $this->load->view('template_admin/menu');   
        $this->load->view('template_admin/content',$data);     
        $this->load->view('template_admin/footer');                     

	}


	public function json_listar_clientes()
	{
        //$data['guardado']=FALSE;              
		$this->load->model('cliente/cliente_info');

		$params = $_REQUEST;
		//$params = $this->input->get_post();

		$array_campos[0]='COD_CLIENTE';
		$array_campos[1]='NOM_CLIENTE';
		$array_campos[2]='APE_PATERNO';
		$array_campos[3]='APE_MATERNO';
		$array_campos[4]='TIPO_DOCUMENTO';
		$array_campos[5]='NUM_DOCUMENTO';
		$array_campos[6]='GENERO';
		$array_campos[7]='DISTRITO';
		$array_campos[8]='DIRECCION';
		$array_campos[9]='CEL_1';
		$array_campos[10]='CEL_2';		
		$array_campos[11]='ESTADO';		
		$array_campos[12]='FEC_REGISTRO';
	

		$vw_tbl="VW_CLIENTE";
		$campo_id="COD_CLIENTE";

		$data['json']  = $this->cliente_info->json_listar_clientes($params, $array_campos, $vw_tbl, $campo_id);
		$this->load->view('json_servicio',$data);
               
	}	        


    public function sesion_activa(){

        if(!isset($_SESSION['sesion_usuario'])){
	        #$this->load->view('vw_login');
            return false;
        }else{
                #http_redirect($uri);
        	return true;
        }

    }	

}
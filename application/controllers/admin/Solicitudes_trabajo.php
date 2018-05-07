<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes_trabajo extends CI_Controller {
    

    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');   
            $this->load->library('session');     

			if($this->sesion_activa()==false){

				//$this->load->view('vw_login');
				redirect(base_url()."admin/Login/");
				die();			
			}  
    }     


	public function canceladas()
	{
		$data['vista_incluida']= "admin/solicitud_trabajo/vw_monitoreo_cancelado_listar";
		$data['titulo']= "Solicitudes Canceladas";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     
	}


	public function pendientes()
	{
		$data['vista_incluida']= "admin/solicitud_trabajo/vw_monitoreo_pendiente_listar";
		$data['titulo']= "Solicitudes Pendiente";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     
	}


	public function asignadas()
	{
		$data['vista_incluida']= "admin/solicitud_trabajo/vw_monitoreo_asignado_listar";
		$data['titulo']= "Solicitudes Asignadas";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     
	}		


	public function json_listar_solicitudes($tipo_filtro)
	{          
		$this->load->model('entidad_ajax/Solicitudes_trabajo_info_model');
		$params = $_REQUEST;
		//$params = $this->input->get_post();
	
		$data['json']  = $this->Solicitudes_trabajo_info_model->json_listar_solicitudes($params, $tipo_filtro);
		$this->load->view('admin/_template/json_servicio',$data);              
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
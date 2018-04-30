<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asignacion_solicitudes extends CI_Controller {
    

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


	public function solicitudes_x_asignar()
	{



		$this->load->model('tipo_averia_model');
		$data['tipo_averias']= $this->tipo_averia_model->listTipAveria();         

		$this->load->model('ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 		

		$this->load->model('tipo_estado_model');
		$data['tipo_estados']= $this->tipo_estado_model->listTipoEstadosPendientes();	
		

		$data['vista_incluida']= "admin/asignacion_solicitudes/vw_solicitudes_pendientes";
		$data['titulo']= "Solicitudes de Trabajo";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     

	}


	public function tmrh_x_asignar($codigo_solicitud)
	{

		$this->load->model('solicitudes_trabajo/solicitudes_trabajo_info_model');
		$data['detalle_solicitud']= $this->solicitudes_trabajo_info_model->obtener_solicitudes_trabajo_x_id($codigo_solicitud);  

		$this->load->model('tipo_sexo_model');
		$data['sexo']= $this->tipo_sexo_model->listTipoSexo();         

		$this->load->model('ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 		

		$data['vista_incluida']= "admin/asignacion_solicitudes/vw_tmrh_disponibles";
		$data['titulo']= "Trabajadores Disponibles para Asignar";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     

	}







	public function json_listar_solicitudes_x_asignar()
	{
        //$data['guardado']=FALSE;              
		$this->load->model('solicitudes_trabajo/Solicitudes_trabajo_info_model');

		$params = $_REQUEST;
		//$params = $this->input->get_post();
	
		$data['json']  = $this->Solicitudes_trabajo_info_model->json_listar_solicitudes_asignar($params);
		$this->load->view('json_servicio',$data);
               
	}	        

	public function json_listar_tmrh_disponible()
	{
        //$data['guardado']=FALSE;              
		$this->load->model('solicitudes_trabajo/Solicitudes_trabajo_asignacion_info_model');

		$params = $_REQUEST;
		//$params = $this->input->get_post();
	
		$data['json']  = $this->Solicitudes_trabajo_asignacion_info_model->json_listar_tmrh_disponible($params);
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
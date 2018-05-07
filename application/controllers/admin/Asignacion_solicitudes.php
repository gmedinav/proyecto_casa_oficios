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
				redirect(base_url()."admin/Login/");
				die();			
			}  
                   
    }     


	public function solicitudes_x_asignar()
	{

		$this->load->model('entidad_negocio/tipo_averia_model');
		$data['tipo_averias']= $this->tipo_averia_model->listTipAveria();         

		$this->load->model('entidad_negocio/ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 		

		$this->load->model('entidad_negocio/tipo_estado_model');
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

		$this->load->model('entidad_ajax/solicitudes_trabajo_info_model');
		$data['detalle_solicitud']= $this->solicitudes_trabajo_info_model->obtener_solicitudes_trabajo_x_id($codigo_solicitud);  

		$this->load->model('entidad_negocio/tipo_sexo_model');
		$data['sexo']= $this->tipo_sexo_model->listTipoSexo();         

		$this->load->model('entidad_negocio/ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 		

		$data['vista_incluida']= "admin/asignacion_solicitudes/vw_tmrh_disponibles";
		$data['titulo']= "Trabajadores Disponibles para Asignar";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     

	}










//Versión Optimizada para la reutilización para la reasignación
    public function asignacion($cod_solicitud_trabajo,$cod_tmrh)
    {

        $cod_user = $_SESSION['sesion_id_usuario'];
        $cod_tip_est_dispo = 3;

        $id_asig_tmrh = $this->cambiar_asignacion_tmrh($cod_solicitud_trabajo, $cod_tmrh, $cod_user);
        if(isset($id_asig_tmrh['codigo'])){

            $id_asig_estado = $this->cambiar_asignacion_estado($cod_solicitud_trabajo, $cod_tmrh, $cod_user);
            $id_dispo_tmrh = $this->cambiar_disponibilidad_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user);

            echo "Se asignó el trabajador correctamente." ;  

        }else{

            echo "No se pudo asignar el trabajador." ;  

        }

    }

///////

    public function cambiar_disponibilidad_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user){
        //Cambiar la tabla tmrh_disponibilidad
        $this->load->model('entidad_negocio/Tmrh_disponibilidad_model');
        
        $resultado = $this->Tmrh_disponibilidad_model->obtener_Tmrh_disponibilidad_x_cod_tmrh($cod_tmrh);


        if(isset($resultado)){
            $rpta['tipo']   = "Actualizado";
            $rpta['codigo'] = $this->Tmrh_disponibilidad_model->actualizar_Tmrh_disponibilidad_x_cod_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user);

        }else{

            $data = array(
                        'cod_tmrh' => $cod_tmrh,
                        'cod_tip_est_dispo' => $cod_tip_est_dispo,
                        'cod_user_registro' =>  $cod_user,                                       
                        );

            $rpta['tipo']   = "Insertado";
            $rpta['codigo'] = $this->Tmrh_disponibilidad_model->insertar_Tmrh_disponibilidad($data);
        }
        return $rpta;
    }

    public function cambiar_asignacion_estado($cod_solicitud_trabajo, $cod_tmrh, $cod_user){
        //Cambiar la tabla Asignacion de Estado
        $this->load->model('entidad_negocio/Asignacion_estado_model');        
        $resultado = $this->Asignacion_estado_model->obtener_asignacion_por_solicitud($cod_solicitud_trabajo);


        if(isset($resultado)){
            $rpta['tipo']   = "Actualizado";
            $rpta['codigo'] = $this->Asignacion_estado_model->cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo, $cod_user);

        }else{

            $data = array(
                                    'cod_estado' => 2,
                                    'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                    'cod_user_registro' =>  $cod_user,                                      
                        );
            $rpta['tipo']   = "Insertado";
            $rpta['codigo'] = $this->Asignacion_estado_model->insertar_Asignacion_solicitud_estado($data);
        }
        return $rpta;
    }

    public function cambiar_asignacion_tmrh($cod_solicitud_trabajo, $cod_tmrh, $cod_user){
        //Cambiar la tabla Asignacion de Estado
        $this->load->model('entidad_negocio/Asignacion_tmrh_model');        
        $resultado = $this->Asignacion_tmrh_model->obtener_asignacion_solicitud_tmrh($cod_tmrh);

        if(isset($resultado)){
            $rpta['tipo']   = "Actualizado";
            $rpta['codigo'] = $this->Asignacion_tmrh_model->actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo); 

        }else{

            $data = array(
                                    'cod_tmrh' => $cod_tmrh,
                                    'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                    'cod_user_registro' =>  $cod_user,                                   
                        );            
            $rpta['tipo']   = "Insertado";
            $rpta['codigo'] = $this->Asignacion_tmrh_model->insertar_Asignacion_solicitud_tmrh($data);
        }
        return $rpta;
    }






















	public function json_listar_solicitudes_x_asignar()
	{
        //$data['guardado']=FALSE;              
		$this->load->model('entidad_ajax/Solicitudes_trabajo_info_model');

		$params = $_REQUEST;
		//$params = $this->input->get_post();
	
		$data['json']  = $this->Solicitudes_trabajo_info_model->json_listar_solicitudes_asignar($params);
		$this->load->view('admin/_template/json_servicio',$data);
               
	}	        

	public function json_listar_tmrh_disponible()
	{
        //$data['guardado']=FALSE;              
		$this->load->model('entidad_ajax/Solicitudes_trabajo_asignacion_info_model');

		$params = $_REQUEST;
		//$params = $this->input->get_post();
	
		$data['json']  = $this->Solicitudes_trabajo_asignacion_info_model->json_listar_tmrh_disponible($params);
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
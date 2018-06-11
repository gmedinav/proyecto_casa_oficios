<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

				$this->load->helper('url');
				$this->load->helper(array('form', 'url'));                

		        $this->load->library('form_validation');                
                $this->load->library('session');	
        
                // Your own constructor code
        }


        public function index(){

            $this->cerrar_session();
            #$this->load->view('vw_login');
            return;


        }

        public function acceder(){


        	$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
			$this->form_validation->set_rules('clave', 'Contraseña', 'trim|required');

			$this->form_validation->set_message('required', 'El campo "%s" es obligatorio.');
			$this->form_validation->set_message('trim', 'El campo "%s" no debe poseer espacios en blanco los extremos.');			

            if ($this->form_validation->run() == FALSE)
            {

				$this->load->view('admin/login/vw_login');
				return;

            }else{

            	$this->load->model('entidad_negocio/login_model');	
                
            	$usuario 	= $this->input->post('usuario');
            	$clave 		= $this->input->post('clave');

            	$rpta		= $this->login_model->obtener_sesion($usuario, $clave);

            	if($rpta){

            		$_SESSION['sesion_usuario'] = $rpta->DES_USUARIO  ;
                    $_SESSION['sesion_id_usuario'] = $rpta->COD_USUARIO;

                    redirect(base_url()."admin/Entidades_negocio");

                    //redirect(base_url()."tmrh");
            		//$this->load->view('example');
            		return ;

            	}


				$rpta[0] = 0;
				$rpta[1] = "Usuario y/o clave incorrecta. por favor, vuelva a intentarlo.";

            	$data['resultado_proceso'] = $rpta;

            	$this->load->view('admin/login/vw_login',$data);
				return;
			}

        }

        public function cerrar_session(){

	        $this->session->sess_destroy();
	        $this->session->userdata('sesion_usuario');

            //redirect(base_url()."Administrar");
	        $this->load->view('admin/login/vw_login');
            //redirect(base_url()."login");

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


}?>
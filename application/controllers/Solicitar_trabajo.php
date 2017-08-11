<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitar_trabajo extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            //$this->load->helper('url');
            
        }    

	public function index()
	{
                $data['guardado']=FALSE;
		$this->load->model('ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 
		$this->load->model('oficio_model');
		$data['oficios']= $this->oficio_model->listOficios();                 
		$this->load->view('solicitar_trabajo',$data);

	}

        
        public function formulario()
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('descripcionUrgencia', '"Descripción de Urgencia"', 'required|min_length[30]|max_length[200]',
                                                array('min_length' => 'El campo "Descripción de Urgencia" debe escribir al menos 30 caracteres en su urgencia.',
                                                      'max_length' => 'El campo "Descripción de Urgencia" debe tener menos de 200 caracteres.' 
                                                        )
                                                );
            $this->form_validation->set_rules('contacto', '"Contacto"', 'required|trim|callback_alpha_dash_space');
            $this->form_validation->set_rules('telefono', '"Teléfono"', 'required|is_natural_no_zero');
            
            $this->form_validation->set_rules('cboDistrito', '"Distrito"', 'required|callback_distrito_no_elegido');
            $this->form_validation->set_rules('cboOficios', '"Oficio"', 'required|is_natural_no_zero', array('is_natural_no_zero' => 'Debe seleccionar un Oficio.'));

            $this->form_validation->set_rules('email', '"Email"', 'required|valid_email');
            $this->form_validation->set_rules('direccion', '"Dirección"', 'required');
            $this->form_validation->set_rules('foto', '"Subir Archivo"', 'callback_cargar_archivo');
            

            $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
            $this->form_validation->set_message('alpha','El campo %s debe estar compuesto solo por letras.');
            $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto.');     
            $this->form_validation->set_message('alpha_dash_space','El campo %s debe estar compuesto solo por letras.');  
            $this->form_validation->set_message('is_natural_no_zero','El campo %s es un valor numérico.');  

            $this->load->model('ubigeo_model');
            $data['distritos']= $this->ubigeo_model->listDistritosLima();   
            
            $this->load->model('oficio_model');
            $data['oficios']= $this->oficio_model->listOficios();               
            
            
            if ($this->form_validation->run() == FALSE) {
                $data['guardado']=FALSE;
		$this->load->view('solicitar_trabajo',$data);   
                
            } else {
                //$data['guardado']=TRUE;     
                $this->load->model('solicitud_trabajo_model');
                
                //$this->Solicitud_trabajo_model->insertar_Solicitud_Trabajo();  
                
                $cboOficios = $this->input->post('cboOficios');	                
                $nombre_apellidos = $this->input->post('contacto');	
                $email = $this->input->post('email');		
                $telefono = $this->input->post('telefono');							
                $direccion = $this->input->post('direccion');                
                $descripcionUrgencia = $this->input->post('descripcionUrgencia');		
                $cboDistrito = $this->input->post('cboDistrito');							
                $foto = base64_encode( addslashes(file_get_contents($_FILES['foto']['tmp_name'])));  //this->input->post('foto')                
                
                
                $data['guardado'] = $this->solicitud_trabajo_model->insertar_Solicitud_Trabajo(
                                    $cboOficios,
                                    $nombre_apellidos,
                                    $email,
                                    $telefono,
                                    $direccion,
                                    $descripcionUrgencia,
                                    $cboDistrito,
                                    $foto
                );
                //redirect(base_url("comentarios"), "refresh");                

                
                
                $this->load->view('solicitar_trabajo',$data);
                //echo "Datos cargador correctamente";
            }

        }        

        function alpha_dash_space($str)
        {
            return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;                     
        } 
        
        function distrito_no_elegido($str)
        {
            if($str != '000000000'){
                return TRUE;
             } else {
                 $this->form_validation->set_message('distrito_no_elegido', 'Debe elegir un distrito');
                 //Note: `set_message()` rule name (first argument) should not include the prefix "callback_"
                 return FALSE;        
             }
        }         
        
        function cargar_archivo() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '8000';
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        

        $this->load->library('upload', $config);
                        
        if ($this->upload->do_upload('foto')==FALSE) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            
            //echo "<br>".$config['upload_path'];
            //echo $this->upload->display_errors();
            
            $this->form_validation->set_message('foto', $data['uploadError'] );
            return FALSE;  
        }

        $data['uploadSuccess'] = $this->upload->data();
        return TRUE;            
                               
    }

}

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

		$this->load->model('entidad_negocio/ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 
		$this->load->model('entidad_negocio/tipo_averia_model');
		$data['tipaveria']= $this->tipo_averia_model->listTipAveria();                 
		$this->load->view('web_public/vw_solicitar_trabajo',$data);

	}

    public function atencion($id_insert)
    {

        if(isset($id_insert))
        {
            $data['guardado']=$id_insert;            
        }else{
            $data['guardado']=FALSE;
        }

        $this->load->model('entidad_negocio/ubigeo_model');
        $data['distritos']= $this->ubigeo_model->listDistritosLima(); 
        $this->load->model('entidad_negocio/tipo_averia_model');
        $data['tipaveria']= $this->tipo_averia_model->listTipAveria();                 
        $this->load->view('web_public/vw_solicitar_trabajo',$data);

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
            $this->form_validation->set_rules('cboTipAveria', '"Averia"', 'required|is_natural_no_zero', array('is_natural_no_zero' => 'Debe seleccionar su tipo de Averia.'));
         
            $this->form_validation->set_rules('email', '"Email"', 'required|valid_email');
            $this->form_validation->set_rules('direccion', '"Dirección"', 'required');
            $this->form_validation->set_rules('foto', '"Subir Archivo"', 'callback_cargar_archivo');

            /*$this->form_validation->set_rules('titulo', '"Título"', 'required|min_length[5]|max_length[20]',
                                                array('min_length' => 'El campo "Título" debe escribir al menos 5 caracteres en su descripción',
                                                      'max_length' => 'El campo "Título" debe tener menos de 20 caracteres en su descripción.' 
                                                        )
                );*/
            
            $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
            $this->form_validation->set_message('alpha','El campo %s debe estar compuesto solo por letras.');
            $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto.');     
            $this->form_validation->set_message('alpha_dash_space','El campo %s debe estar compuesto solo por letras.');  
            $this->form_validation->set_message('is_natural_no_zero','El campo %s es un valor numérico.');  



            $this->load->model('entidad_negocio/ubigeo_model');
            $data['distritos']= $this->ubigeo_model->listDistritosLima();   
            
            $this->load->model('entidad_negocio/tipo_averia_model');
            $data['tipaveria']= $this->tipo_averia_model->listTipAveria();               
            
            
            
            if ($this->form_validation->run() == FALSE) {
                $data['guardado']=FALSE;
		        $this->load->view('web_public/vw_solicitar_trabajo',$data);
                
                //echo('INGRESO EN EL ELSE que valida el form validation');
                
            } else {
                //$data['guardado']=TRUE;     
                $this->load->model('entidad_negocio/solicitud_trabajo_model');                
                //$this->Solicitud_trabajo_model->insertar_Solicitud_Trabajo();  
                
                $cboTipAveria = $this->input->post('cboTipAveria');	                
                $nombre_apellidos = $this->input->post('contacto');	
                $email = $this->input->post('email');		
                $telefono = $this->input->post('telefono');							
                $direccion = $this->input->post('direccion');                
                $descripcionUrgencia = $this->input->post('descripcionUrgencia');		
                $cboDistrito = $this->input->post('cboDistrito');							
                $foto = base64_encode( addslashes(file_get_contents($_FILES['foto']['tmp_name'])));  //this->input->post('foto')                
                
                /*
                $data['guardado'] = $this->solicitud_trabajo_model->insertar_Solicitud_Trabajo(
                                    $cboOficios,
                                    $nombre_apellidos,
                                    $email,
                                    $telefono,
                                    $direccion,
                                    $descripcionUrgencia,
                                    $cboDistrito,
                                    $foto
                );*/

                //$data_insert['COD_OFICIO']=1;    
                $data_insert['COD_TIPO_AVERIA']=$this->input->post('cboTipAveria');  
                $data_insert['NOMBRE'] = $this->input->post('contacto');	
                $data_insert['EMAIL'] = $this->input->post('email');		
                $data_insert['TELEFONO'] = $this->input->post('telefono');							
                $data_insert['DIRECCION'] = $this->input->post('direccion');                
                $data_insert['DESCRIPCION']= $this->input->post('descripcionUrgencia');		
                $data_insert['COD_UBIGEO'] = $this->input->post('cboDistrito');		
                //$data_insert['TITULO'] = $this->input->post('titulo'); 
                $data_insert['TITULO'] = ''; 					
                //$data_insert['FOTO'] = base64_encode( addslashes(file_get_contents($_FILES['foto']['tmp_name'])));                 
                $data_insert['FOTO'] = null;
                $data_insert['ESTADO'] = 1;
                $data_insert['COD_TIPO_REGISTRO'] = 1;
                
                $data['file'] = file_get_contents($_FILES['foto']['tmp_name']);                
                $data['guardado']=$this->solicitud_trabajo_model->insertar_Solicitud_Trabajo($data_insert);



                $data2['cod_estado'] = 1;
                $data2['cod_solicitud_trabajo'] = $this->solicitud_trabajo_model->obtener_id_insertado();
                $data2['cod_user_registro'] = 1 ;  

                $this->load->model('entidad_negocio/asignacion_estado_model');
                $this->asignacion_estado_model->insertar_Asignacion_solicitud_estado($data2);   



                redirect(base_url()."web_public/Solicitar_trabajo/atencion/".$data['guardado']);
            }

        }        

        function alpha_dash_space($str)
        {
            return ( ! preg_match("/^([A-Z a-zñáéíóúü])+$/i", $str)) ? FALSE : TRUE;                     
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

            $this->form_validation->set_message('cargar_archivo', $data['uploadError'] );
            return FALSE;  
        }

        $data['uploadSuccess'] = $this->upload->data();
        return TRUE;            
                               
    }

}

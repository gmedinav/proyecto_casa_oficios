<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Gestionar_tmrh extends CI_Controller
{
     
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }
     
    public function index()
    {
        $this->load->view('trabaja_con_nosotros');
    }
     
    public function procesar()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('descripcionUrgencia', '"Descripción de Urgencia"', 'required|min_length[20]|max_length[200]');
        $this->form_validation->set_rules('contacto', '"Contacto"', 'required|alpha');
        $this->form_validation->set_rules('telefono', '"Teléfono"', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('cboDistrito', '"Distrito"', 'required|alpha');
        $this->form_validation->set_rules('cboOficios', '"Oficio"', 'required|is_natural_no_zero');
        
        $this->form_validation->set_rules('email', '"Email"', 'required|valid_email');
        $this->form_validation->set_rules('direccion', '"Dirección"', 'required');
        $this->form_validation->set_rules('FileUpload', '"Subir Archivo"', 'required');
        
        $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
        $this->form_validation->set_message('alpha','El campo %s debe estar compuesto solo por letras');
        $this->form_validation->set_message('min_length[20]','El campo %s debe tener más de 20 caracteres');
        $this->form_validation->set_message('max_length[200]','El campo %s debe tener menos de 200 caracteres');
        $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto');        
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Solicitar_trabajo');
        } else {
            $this->load->view('welcome_message');
            //echo "Datos cargador correctamente";
        }
         
    }
}
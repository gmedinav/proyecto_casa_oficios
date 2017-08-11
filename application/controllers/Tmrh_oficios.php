<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tmrh_oficios extends CI_Controller {
    
        Public $lista_oficios;
        Public $lista_periodo_oficio;

        function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');

            
        }    

	public function index()
	{
                $data['guardado']=FALSE;
                
		$this->load->model('ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 
                
		$this->load->model('oficio_model');
		$data['oficios']= $this->oficio_model->listOficios();  
                
		$this->load->model('tipo_sexo_model');
		$data['sexos']= $this->tipo_sexo_model->listTipoSexo();        
                
		$this->load->model('tipo_operadora_model');
		$data['operadoras']= $this->tipo_operadora_model->listTipoOperadora();     
                
		$this->load->model('tipo_documento_model');
		$data['documentos']= $this->tipo_documento_model->listTipoDocumentos();        
                
 		$this->load->model('tipo_experiencia_model');
		$data['experiencias']= $this->tipo_experiencia_model->listPeriodoExperiencia();  
                
                
                if(empty($this->input->post('cboOficios'))==FALSE)                    
                {
                    
                    array_push($data['oficio_item'],$this->input->post('cboOficios'));
                    
                    
                }else{
                
                    //
                }
            
                
                
                
                
                
		$this->load->view('tmrh_oficios',$data);
                

	}
        
}
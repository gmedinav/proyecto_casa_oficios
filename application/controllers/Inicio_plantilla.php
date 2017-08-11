<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_plantilla extends CI_Controller {
    
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
 
		$this->load->view('inicio');
                

	}
        
}
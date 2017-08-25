<?php
        $ojbresponse = new stdClass();
        $ojbresponse->response = "ERROR";


defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
//
//Invocar como : http://localhost:8081/proyecto_casa_oficios/wsgenero/generos/




class Wsgenero extends REST_Controller{
    
    
      
    
        public function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('wsgenero_model');
        
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['generos_get']['limit'] = 500; // 500 requests per hour per user/key
//     $this->load->model('wsvalidarlogin');
        
     
        }
        
        public function generos_get(){
           
           
          $data = $this->wsgenero_model->getGeneros();
//
         $this->response(array('response' => $data), 200);
           
            
        }
    
    
    

    
    
}

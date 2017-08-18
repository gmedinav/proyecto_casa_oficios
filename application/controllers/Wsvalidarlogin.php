<?php
        $ojbresponse = new stdClass();
        $ojbresponse->response = "ERROR";


defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';
//
//Invocar como : http://localhost:8081/proyecto_casa_oficios/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin




class Wsvalidarlogin extends REST_Controller{
    
    
      
    
        public function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('wsvalidarlogin_model');
        
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['validar_get']['limit'] = 500; // 500 requests per hour per user/key
//     $this->load->model('wsvalidarlogin');
        
     
        }
        
        public function validar_get(){

            
           $usu = $this->get('usuario');
           
           $mail = str_replace("%40","@",$usu);
           
           $pass = $this->get('pass');
           
           
           
           
           
          $login = $this->wsvalidarlogin_model->validarlogin($mail,$pass);
//
         $this->response(array('response' => $login), 200);
           
            
        }
    
    
    

    
    
}

<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Oficio_albanil extends CI_Controller {
    

        //Public $lista_telefonos= array();        
    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');            

    }   


    public function index()
    {

        $this->load->view('albanil');


    }

}
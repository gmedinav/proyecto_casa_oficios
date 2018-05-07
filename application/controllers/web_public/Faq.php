<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq extends CI_Controller {
    

        //Public $lista_telefonos= array();        
    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');            

    }   


    public function index()
    {

        //$this->load->view('web_public/_template/header');
        //$this->load->view('web_public/_template/feature');
        $this->load->view('web_public/vw_faq');   

        
        //$this->load->view('web_public/_template/conteiner');
        //$this->load->view('web_public/_template/bottom');
        //$this->load->view('web_public/_template/footer');

        //$this->load->view('web_public/vw_faq');        

    }

}
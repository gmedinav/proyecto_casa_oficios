<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*

 * http://localhost:8081/proyecto_casa_oficios/index.php/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin
 *  */


class Wsvalidarlogin_model extends CI_Model{
    
    
        public function __construct()
    {
        parent::__construct();
    }
    
    public function  validarlogin($usuario,$login){
             
          $this->load->database();
          
          $sql = "select * from tb_usuario where log_usuario = '".$usuario."'
                                       and pass_usuario  = '".$login."'";
          
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
        
    }


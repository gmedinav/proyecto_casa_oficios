<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*

 * http://localhost:8081/proyecto_casa_oficios/index.php/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin
 *  */


class Wsoficios_model extends CI_Model{
    
    
        public function __construct()
    {
        parent::__construct();
    }
    
    public function  getOficios(){
             
          $this->load->database();
          
          $sql = "select * from tb_oficio";
          
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
        
    }


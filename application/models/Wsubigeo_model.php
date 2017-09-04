<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*

 * http://localhost:8081/proyecto_casa_oficios/index.php/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin
 *  */


class Wsubigeo_model extends CI_Model{
    
    
        public function __construct()
    {
        parent::__construct();
    }
    
    public function  get_ubigeo($codigo){
             
          $this->load->database();
          

          
               $sql = "select * from tb_ubigeo where cod_ubigeo = ".$codigo."";
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
                }
        
    
    
        
    public function  getdistritos(){
             
          $this->load->database();
          
          $sql = "select * from tb_ubigeo where cod_pais = '001' and cod_departamento = '15' and cod_provincia = '01' order by des_ubigeo";
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
                }
        
    }
    
    
    


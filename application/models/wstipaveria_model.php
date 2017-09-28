<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wstipaveria_model extends CI_Model{
    
    
    
    public function __construct()
    {
        parent::__construct();
    }
    

     
     
         public function  getAveriaxofiID($codigo){
             
          $this->load->database();
          
          $sql = "select * from tb_usuario where cod_usuario = ".$codigo.'';
          
          
          
          $sql2 = "select t.cod_tipaveria, t.des_tipo_averia  from tb_tipo_averia  as t
inner join tb_oficio_averia as o
on t.cod_tipaveria = o.cod_tipaveria
where o.cod_oficio = ".$codigo.
" order by t.des_tipo_averia asc";
          
          $query = $this->db->query($sql2);
          
      
               return $query->result_array();
        
          
                }
                
                
         public function  getAverias(){
             
          $this->load->database();
          
          $sql = "select * from tb_tipo_averia";
          
          $query = $this->db->query($sql);
          

               return $query->result_array();
        
          
                }
    
     
    
}
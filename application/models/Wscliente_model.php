<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*

 * http://localhost:8081/proyecto_casa_oficios/index.php/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin
 *  */


class Wscliente_model extends CI_Model{
    
    
        public function __construct()
    {
        parent::__construct();
    }
    
    public function  getCliente($codigo){
             
          $this->load->database();
          
          $sql = "select * from tb_cliente where cod_cliente = ".$codigo.'';
          

          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
         
                
                    public function  clientexID_get($codigo){
             
          $this->load->database();
          
          
          $sql = "select c.* from tb_cliente c
                inner join tb_usuario as o
                on o.cod_usuario = c.cod_usuario
                where c.cod_usuario = ".$codigo;
          
   
          
         // $sql = "select * from tb_cliente where cod_cliente = ".$codigo.'';
          

          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
                
                
        /*        select * from tb_cliente c
inner join tb_usuario as o
on o.cod_usuario = c.cod_usuario
where c.cod_usuario = 63 */
                
        
    }


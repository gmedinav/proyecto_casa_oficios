<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*

 * http://localhost:8081/proyecto_casa_oficios/index.php/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin
 *  */


class Wsolicitudestrab_model extends CI_Model{
    
    
        public function __construct()
    {
        parent::__construct();
    }
    
    public function  getSolicitudes($codigo){
             
          $this->load->database();
          
           $sql = "select  c.cod_solicitud as cod_solicitud, c.descripcion as descripcion , c.fec_registro as fec_registro ,
                        f.descripcion as desestado
                         from tb_solicitud_trabajo c inner join tb_estado_solicitud_trabajo f
                        on c.estado = f.cod_estado
                        where cod_usuario_registro=".$codigo.'';
          
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
        
    }


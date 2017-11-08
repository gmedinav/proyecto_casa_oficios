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
          
           $sql = "SELECT  C.COD_SOLICITUD AS COD_SOLICITUD, C.DESCRIPCION AS DESCRIPCION , C.FEC_REGISTRO AS FEC_REGISTRO ,
                        F.DESCRIPCION AS DESESTADO
                         FROM TB_SOLICITUD_TRABAJO C INNER JOIN TB_ESTADO_SOLICITUD_TRABAJO F
                        ON C.ESTADO = F.COD_ESTADO
                        WHERE COD_USUARIO_REGISTRO=".$codigo.'';
          
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
        
    }


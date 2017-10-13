<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wsusuario_model extends CI_Model{
    
    
    
    public function __construct()
    {
        parent::__construct();
    }
    
     public function  insertar_usuario($DES_USUARIO,
             $LOG_USUARIO,$PASS_USUARIO,$ESTADO,$COD_TIP_USUARIO,$FEC_REGISTRO,$FEC_MODIFICACION,$COD_USUARIO_REGISTRO){
                   $this->load->database();

          $sql = "INSERT INTO TB_USUARIO "
                  . '(DES_USUARIO,LOG_USUARIO,PASS_USUARIO,ESTADO,COD_TIPO_USUARIO,FEC_REGISTRO,FEC_MODIFICACION,COD_USUARIO_REGISTRO)'
                       . ' values'
                  . "($DES_USUARIO,'$LOG_USUARIO','$PASS_USUARIO','$ESTADO','$COD_TIPO_USUARIO','$FEC_REGISTRO','$FEC_MODIFICACION','$COD_USUARIO_REGISTRO);";
          
                  $query = $this->db->query($setencia);
                  
       if( $query === false ) {
                    $rpta = "NOOK";
                 }else{
                    $rpta = "OK";
                 }

        return $rpta;
         
     }
     
     
     
         public function  getUsuario($codigo){
             
          $this->load->database();
          
          $sql = "select * from tb_usuario where cod_usuario = ".$codigo.'';
          
          $query = $this->db->query($sql);
          
//          echo $sql;
               return $query->result_array();
        
          
                }
                
                
          public function  getValidaMail($correo){
             
          $this->load->database();
          
          $sql = "select * from tb_usuario where log_usuario = '".$correo."'";
          
          $query = $this->db->query($sql);
          
     //  echo $sql;
               return $query->result_array();
        
          
                }
    
     
    
}
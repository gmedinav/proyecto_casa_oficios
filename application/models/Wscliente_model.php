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
    
    
    private $contactxx = 'contact';
    
    
    function add_contact($contact_name, $contact_address, $contact_phone) {
        echo $contact_name;
        $data = array('contact_name' => $contact_name, 'contact_address' => $contact_address, 'contact_phone' => $contact_phone);
        $this->db->insert($this->contactxx, $data);
    }
    
    
     public   function add_cliusu($p_log_usuario ,
                        $p_pass_usuario ,
                        $p_estado ,
                        $p_cod_tipo_usuario ,
                        $p_fec_registro ,
                        $p_fec_modificacion,
                        $p_cod_usuario_registro,
                        $p_nom_cliente ,
                        $p_ape_paterno ,
                        $p_ape_materno ,
                        $p_cod_tipo_documento ,
                        $p_num_documento ,
                        $p_cod_tipo_genero,
                        $p_cod_ubigeo ,
                        $p_direccion ,
                        $p_cel_1 ,
                        $p_cel_2 ,
                        $p_cuenta_facebook ,
                        $p_cuenta_gmail ,
                        $p_fecha_nacimiento,
                        $p_cod_tipo_canal_contacto ,
                        $p_fec_modificacion_cli ,
                        $p_fec_registro_cli ,
                        $p_cod_usuario_registro_cli ,
                        $p_estado_cli ){
//        echo $contact_name;
//        $data = array('contact_name' => $contact_name, 'contact_address' => $contact_address, 'contact_phone' => $contact_phone);
//        $this->db->insert($this->contact, $data);
//        return $data;
//         $this->load->database();
//          $sql = "call sp_cli";
//           $query = $this->db->query($sql);
//          return $query->result_array();
          
         
         $out_id = 0;
          
            $call_procedure = "CALL sp_insert_cli_usu('"
                    .$p_log_usuario."'".
                    ",'".$p_pass_usuario."'".
                    "," .$p_estado.
                    "," .$p_cod_tipo_usuario.
                    ",'" .$p_fec_registro."'".
                    ",'" .$p_fec_modificacion."'".
                    "," .$p_cod_usuario_registro.
                    ",'" .$p_nom_cliente."'".
                    ",'" .$p_ape_paterno."'".
                    ",'" .$p_ape_materno."'".
                    "," .$p_cod_tipo_documento.
                    ",'" .$p_num_documento."'".
                    "," .$p_cod_tipo_genero.
                    ",'" .$p_cod_ubigeo."'".
                    ",'" .$p_direccion."'".
                    ",'" .$p_cel_1."'".
                    ",'" .$p_cel_2."'".
                    ",'" .$p_cuenta_facebook."'".
                    ",'" .$p_cuenta_gmail."'".
                    ",'" .$p_fecha_nacimiento."'".
                    "," .$p_cod_tipo_canal_contacto.
                    ",'" .$p_fec_modificacion_cli."'".
                    ",'" .$p_fec_registro_cli."'".
                    "," .$p_cod_usuario_registro_cli.
                    "," .$p_estado_cli.");";
//                    ",@out_id);";
             
            
            
            
            //echo $call_procedure;
            
            
         $query =   $this->db->query($call_procedure);
            
   //         $call_total = 'SELECT @out_id as codigo';
//            
       //    $query = $this->db->query($call_total);
           // return $query->result();
          return $query->result();
         
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


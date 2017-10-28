<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*

 * http://localhost:8081/proyecto_casa_oficios/index.php/wsvalidarlogin/validar/usuario/desco%40gmail.com/pass/admin
 *  */


class Wssolicitud_model extends CI_Model{
    
    
        public function __construct()
    {
        parent::__construct();
    }
    
    
    private $contactxx = 'contact';
    
    
    
    
     public   function add_soltrab( $p_cod_cliente,
                        $p_cordenadas_registro,
                        $p_cordenadas_ubicacion,
                        $p_cod_tipo_averia,
                        $p_cod_tipo_prioridad,
                        $p_nombre,
                        $p_email,
                        $p_telefono,
                        $p_descripcion,
                        $p_estado,
                        $p_precio_presupuesto,
                        $p_precio_final,
                        $p_cod_tipo_registro,
                        $p_fec_registro,
                        $p_fec_modificacion,
                        $p_cod_usuario_registro,
                        $p_cod_ubigeo,
                        $p_direccion,$p_cod_oficio ){
//        echo $contact_name;
//        $data = array('contact_name' => $contact_name, 'contact_address' => $contact_address, 'contact_phone' => $contact_phone);
//        $this->db->insert($this->contact, $data);
//        return $data;
//         $this->load->database();
//          $sql = "call sp_cli";
//           $query = $this->db->query($sql);
//          return $query->result_array();
          
         
         $out_id = 0;
          
            $call_procedure = "CALL sp_insert_solicitud("
                    .$p_cod_cliente.
                        ",'".$p_cordenadas_registro."'".
                        ",'".$p_cordenadas_ubicacion."'".
                        ",".$p_cod_tipo_averia.
                        ",".$p_cod_tipo_prioridad.
                        ",'".$p_nombre."'".
                        ",'".$p_email."'".
                        ",'".$p_telefono."'".
                        ",'".$p_descripcion."'".
                        ",'".$p_estado."'".
                        ",'".$p_precio_presupuesto."'".
                        ",'".$p_precio_final."'".
                        ",".$p_cod_tipo_registro.
                        ",'".$p_fec_registro."'".
                        ",'".$p_fec_modificacion."'".
                        ",".$p_cod_usuario_registro.
                        ",'".$p_cod_ubigeo."'".
                        ",'".$p_direccion."'".
                        "," .$p_cod_oficio.");";
//                    ",@out_id);";
             
            
            
            
            //echo $call_procedure;
            
            
         $query =   $this->db->query($call_procedure);
            
   //         $call_total = 'SELECT @out_id as codigo';
//            
       //    $query = $this->db->query($call_total);
           // return $query->result();
          return $query->result();
         
    }
    
    
   
        
    }


<?php

class Solicitud_trabajo_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function insertar_Solicitud_Trabajo($data_array)
        {
               $this->load->database();                              
               #$setencia="INSERT INTO tb_solicitud_trabajo"
               #        . '(COD_OFICIO, NOMBRE, EMAIL, TELEFONO, DIRECCION, DESCRIPCION, COD_UBIGEO, FOTO)'
               #        . ' values'
               #        . "($cboOficios,'$nombre_apellidos','$email','$telefono','$direccion','$descripcionUrgencia', '$cboDistrito','$foto');";
               //echo $setencia;
               //$query = $this->db->query($setencia);
               

               
               $query = $this->db->insert('tb_solicitud_trabajo', $data_array); 
               //echo "CODIGOOO " .  $this->db->insert_id();
               
               $codigo = 0;
               if ($query == true){
               
                  $codigo = $this->db->insert_id();
                  return $codigo;//->result_array();

               }else{
                              
                  return $codigo;//->result_array();
               }
               
        }


}


?>
<?php

class Solicitud_trabajo_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function insertar_Solicitud_Trabajo($cboOficios,$nombre_apellidos,$email,$telefono,$direccion,$descripcionUrgencia, $cboDistrito,$foto)
        {

               $this->load->database();
               $setencia="INSERT INTO tb_solicitud_trabajo"
                       . '(id_oficio,nombres_apellidos,email,telefono,direccion,descripcion, id_ubigeo,foto)'
                       . ' values'
                       . "($cboOficios,'$nombre_apellidos','$email','$telefono','$direccion','$descripcionUrgencia', '$cboDistrito','$foto');";
               //echo $setencia;
               $query = $this->db->query($setencia);
               return $query;//->result_array();
        }


}


?>
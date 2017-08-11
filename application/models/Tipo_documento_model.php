<?php

class Tipo_documento_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listTipoDocumentos()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tip_documento where COD_TIPO_MAESTRO <>3;');
               return $query->result_array();
        }


}


?>
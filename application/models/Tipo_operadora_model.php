<?php

class Tipo_operadora_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listTipoOperadora()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tip_operadora;');
               return $query->result_array();
        }


}


?>
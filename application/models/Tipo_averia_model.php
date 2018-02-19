<?php

class Tipo_averia_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listTipAveria()
        {
               $this->load->database();
               $query = $this->db->query('select * from tb_tipo_averia order by des_tipo_averia desc;');
               return $query->result_array();
        }

   
        
        
}


?>
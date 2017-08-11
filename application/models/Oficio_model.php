<?php

class Oficio_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listOficios()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_oficio;');
               return $query->result_array();
        }


}


?>
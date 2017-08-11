<?php

class Tipo_experiencia_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listPeriodoExperiencia()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tip_experiencia;');
               return $query->result_array();
        }


}


?>
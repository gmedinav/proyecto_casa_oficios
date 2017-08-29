<?php

class Tipo_experiencia_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listPeriodoExperiencia()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tip_experiencia;');
               return $query->result_array();
        }


       public function instanciaPeriodoExperiencia($id)
        {
               $this->load->database();
               $query = $this->db->query("SELECT * from tb_tip_experiencia where COD_TIPO_MAESTRO='$id';");
               return $query->result_array();
        }        
        
}


?>
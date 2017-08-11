<?php

class Tmrh_documento_adjunto_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listar_Tmrh_documento_adjunto()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_oficio;');
               return $query->result_array();
        }


}


?>
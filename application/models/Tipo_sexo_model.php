<?php

class Tipo_sexo_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listTipoSexo()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tip_sexo;');
               return $query->result_array();
        }


}


?>
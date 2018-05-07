<?php

class Oficio_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listOficios()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_oficio;');
               return $query->result_array();
        }

       public function instanciaOficios($id)
        {
               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "  COD_OFICIO,
                            DES_OFICIO,
                            FEC_REGISTRO,
                            FEC_MODIFICACION,
                            COD_USUARIO_REGISTRO"
                       . " from tb_oficio where COD_OFICIO='$id';");
               
               return $query->row_array();
        }
        
        
}


?>
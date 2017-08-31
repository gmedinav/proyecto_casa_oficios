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
               $sql="SELECT "
                       . "  COD_TIPO_MAESTRO,
                            DES_TIPO_MAESTRO,
                            FEC_REGISTRO,
                            FEC_MODIFICACION,
                            COD_USUARIO_REGISTRO"
  
                       . " from tb_tip_experiencia where COD_TIPO_MAESTRO='$id';";
               $query = $this->db->query($sql);
               return $query->row_array();
        }        
        
}


?>
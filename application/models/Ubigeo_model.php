<?php

class Ubigeo_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listDistritosLima()
        {
               $this->load->database();
               $query = $this->db->query("SELECT cod_ubigeo,des_ubigeo from tb_ubigeo WHERE  (COD_PAIS = '001' AND
                                        COD_DEPARTAMENTO = '15' AND 
                                        COD_PROVINCIA = '01' AND
                                            COD_DISTRITO <> '00') ;");
               return $query->result_array();
        }


}


?>
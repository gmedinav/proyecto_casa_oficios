<?php

class Tmrh_oficios_extra_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listar_Tmrh_oficios_extra()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * FROM tb_tmrh_oficios_extra;');
               return $query->result_array();
        }

        
        public function guardar_Instancia($data)
        {
                //$instancia->$cod_Tmrh = $id;
                
//               $this->$cod_Tmrh_Contacto;
//               $this->$cod_Tmrh;
//               $this->$cod_Tipo_Operadora;
//               $this->$telefono;
                
               $this->load->database();                  
               $rpta= $this->db->insert('tb_tmrh_oficios_extra', $data);
               return $rpta;

        }        
        

}


?>
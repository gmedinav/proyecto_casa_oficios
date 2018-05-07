<?php

class Tmrh_documento_adjunto_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listar_Tmrh_documento_adjunto()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tmrh_documentos_adjuntos;');
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
               $rpta= $this->db->insert('tb_tmrh_documentos_adjuntos', $data);
               return $rpta;

        }        
        

}


?>
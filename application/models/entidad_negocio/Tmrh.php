<?php

class Tmrh extends CI_Model {

         public function __construct()
        {
            parent::__construct();
        }      
        
        //public function guardar_Instancia($id,$instancia)
        public function guardar_Instancia($data_array)
        {

               $this->load->database();                  
               $rpta= $this->db->insert('tb_tmrh', $data_array);
               
               $codigo = 0;
               
                if ($rpta == true){
                        $codigo = $this->db->insert_id();
               return $codigo;//->result_array();
                }ELSE{
                    
               return $codigo;//->result_array();
                }

        }
        
        
       public function listar_tmrh()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tmrh;');
               return $query->result_array();
        }

        public function obtener_tmrh($id)
        {
               $this->load->database();
               $query = $this->db->query("SELECT * from tb_tmrh where COD_TMRH='$id';");
               return $query->result_array();
        }

        public function buscar_documento_identidad($nro_documento)
        {
               $this->load->database();
               $query = $this->db->query("SELECT * from tb_tmrh where NUM_DOCUMENTO='$nro_documento';");
               return $query->result_array();
        }
        
        public function buscar_email($email)
        {
               $this->load->database();
               $query = $this->db->query("SELECT * from tb_tmrh where EMAIL='$email';");
               return $query->result_array();
        }        


}


?>
<?php

class Tipo_estado_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function listTipoEstados()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_estado_solicitud_trabajo;');
               return $query->result_array();
        }


       public function listTipoEstadosPendientes()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_estado_solicitud_trabajo where cod_estado in(1,5);');
               return $query->result_array();
        }

}


?>
<?php

class Tmrh_info_model extends CI_Model {

         public function __construct()
        {
            parent::__construct();
        }      
        
        public function listar_todos_perfil()
        {
               $this->load->database();
               $query = $this->db->query('SELECT COD_TMRH, NOM_TMRH, APE_PATERNO, APE_MATERNO, EMAIL
                                          from VW_TMRH_PERFIL;');
               return $query->result_array();
        }
               
       public function listar_contactos_x_tmrh($id)
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from VW_TMRH_CONTACTOS where COD_TMRH='.$id.';');
               return $query->result_array();
        }

       public function listar_oficios_experiencia_x_tmrh($id)
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from VW_TMRH_OFICIO_EXPERIENCIA where COD_TMRH='.$id.';');
               return $query->result_array();
        }


        //Orientada a AJAX
        //SIDE SERVER
       public function json_listar_tmrh_perfil($params, $array_campos, $vw_tbl, $campo_id) 
       {
          
          $this->load->database();

          $rp = isset($params['rowCount']) ? $params['rowCount'] : 10;          
          if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
              $start_from = ($page-1) * $rp;
     

          $this->load->library('json_bootgrid_gmv');
          $where_extension=" 1=1 ";
          $resultado = $this->json_bootgrid_gmv->get_query_bootgrid($params, $array_campos, $vw_tbl, $campo_id, $where_extension);

          $sqlTot = $resultado["query_total"];
          $sqlRec = $resultado["query_registros"];

          $this->db->query($sqlRec);
          $qtot = $this->db->query($sqlTot)->num_rows();
          $queryRecords = $this->db->query($sqlRec);

          foreach($queryRecords->result_array() as $row){
              $data[] = $row;
          }

          $json_data = array(

            "current"             => intval($page),             
            "rowCount"            => 10,      
            "total"               => intval($qtot),
            "rows"                => $data,  // total data array
            /*"query_record"        => $sqlRec,
            "query_total"        => $sqlTot,*/
            );
          
          return $json_data;
        }




}


?>
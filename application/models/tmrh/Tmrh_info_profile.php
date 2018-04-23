<?php

class Tmrh_info_profile extends CI_Model {

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

/*          
          //Código Optimizado: esta sección se va reutilizar con la clase::json_bootgrid_gmv

          $sql = $sqlRec = $sqlTot = $where = '';
          
          if( !empty($params['searchPhrase']) ) {   

              $where .=" WHERE ";
              $where .=" ( COD_TMRH LIKE '".$params['searchPhrase']."%' ";    
              $where .=" OR NOM_TMRH LIKE '".$params['searchPhrase']."%' ";
              $where .=" OR APE_MATERNO LIKE '".$params['searchPhrase']."%' ";                   
              $where .=" OR EMAIL LIKE '".$params['searchPhrase']."%' )";
           }


          $sql = "SELECT COD_TMRH, NOM_TMRH, APE_PATERNO, APE_MATERNO, EMAIL FROM VW_TMRH_PERFIL  ";
          $sqlTot .= $sql;
          $sqlRec .= $sql;
          
          //concatenate search sql if value exist
          if(isset($where) && $where != '') {       
            $sqlTot .= $where;
            $sqlRec .= $where;
          }


          $order_by = '';

          if(isset($params['sort']) && is_array($params['sort']) )
          {
            foreach($params['sort'] as $key => $value){
                $order_by .= ' '.$key." ".$value.', ';
            }
            $order_by = " order by ".substr($order_by, 0, -2);

          }else{     
            $order_by = " order by COD_TMRH desc  ";
          }

          if ($rp!=-1){}
          $sqlRec .= $order_by." LIMIT ". $start_from .",".$rp;
*/
          

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
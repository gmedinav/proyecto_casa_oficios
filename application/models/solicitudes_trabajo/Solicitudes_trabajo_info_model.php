<?php

class Solicitudes_trabajo_info_model extends CI_Model {

        //public $array_campos_json;
 
        public $vw_tbl_json    = 'VW_SOLICITUD_STATUS';
        public $campo_id_json  = 'COD_SOLICITUD';

         public function __construct()
        {
            parent::__construct();

        }      
        
        public function listar_todos_solicitudes_trabajo()
        {
               $this->load->database();
               $query = $this->db->query('SELECT 
                                            COD_SOLICITUD,
                                            COD_TIPO_AVERIA,
                                            DES_TIPO_AVERIA,
                                            COD_TMRH_ASIG,
                                            NOM_TMRH_ASIG,
                                            COD_ESTADO_ASIGNACION,
                                            ESTADO_ASIGNACION,
                                            NOMBRE_CLIENTE,
                                            COD_UBI_CLI,
                                            DISTRITO_CLI,
                                            DIR_CLI,
                                            FONO_CLI,
                                            DESCRIP_CASO,
                                            FEC_REGISTRO,
                                            DURACION

                                          from VW_SOLICITUD_STATUS;');
               return $query->result_array();
        }
               
       public function obtener_solicitudes_trabajo_x_id($id)
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from VW_SOLICITUD_STATUS where COD_SOLICITUD='.$id.';');
               return $query->result_array();
        }

       public function listar_solicitudes_trabajo_pendientes()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * FROM VW_SOLICITUD_STATUS where COD_ESTADO_ASIGNACION=1');
               return $query->result_array();
        }

       public function listar_solicitudes_trabajo_asignados()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * FROM VW_SOLICITUD_STATUS where COD_ESTADO_ASIGNACION=2');
               return $query->result_array();
        }

       public function listar_solicitudes_trabajo_cancelado_x_tmrh()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * FROM VW_SOLICITUD_STATUS where COD_ESTADO_ASIGNACION=5');
               return $query->result_array();
        }


/*..............................................*/



       public function json_listar_solicitudes($params, $tipo_filtro) 
       {
          
          $this->load->database();

          $array_campos[0] ='COD_SOLICITUD';
          $array_campos[1] ='COD_TIPO_AVERIA';
          $array_campos[2] ='DES_TIPO_AVERIA';
          $array_campos[3] ='COD_TMRH_ASIG';
          $array_campos[4] ='NOM_TMRH_ASIG';
          $array_campos[5] ='COD_ESTADO_ASIGNACION';
          $array_campos[6] ='ESTADO_ASIGNACION';
          $array_campos[7] ='NOMBRE_CLIENTE';
          $array_campos[8] ='COD_UBI_CLI';
          $array_campos[9] ='DISTRITO_CLI';
          $array_campos[10]='DIR_CLI';
          $array_campos[11]='FONO_CLI';
          $array_campos[12]='DESCRIP_CASO';
          $array_campos[13]='FEC_REGISTRO';
          $array_campos[14]='DURACION'; 

          $vw_tbl         = $this->vw_tbl_json;
          $campo_id       = $this->campo_id_json;
          //$where_extension  = ' 1=1 ';
          $where_extension = " COD_ESTADO_ASIGNACION = $tipo_filtro ";


          $rp = isset($params['rowCount']) ? $params['rowCount'] : 10;          
          if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
              $start_from = ($page-1) * $rp;


          $this->load->library('json_bootgrid_gmv');
          //$where_extension=' 1=1 ';

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
            "query_record"        => $sqlRec,
            "query_total"        => $sqlTot,
            );
          
          return $json_data;
        }

       public function json_listar_solicitudes_asignar($params) 
       {
          
          $this->load->database();

          $array_campos[0] ='COD_SOLICITUD';
          $array_campos[1] ='COD_TIPO_AVERIA';
          $array_campos[2] ='DES_TIPO_AVERIA';
          $array_campos[3] ='COD_TMRH_ASIG';
          $array_campos[4] ='NOM_TMRH_ASIG';
          $array_campos[5] ='COD_ESTADO_ASIGNACION';
          $array_campos[6] ='ESTADO_ASIGNACION';
          $array_campos[7] ='NOMBRE_CLIENTE';
          $array_campos[8] ='COD_UBI_CLI';
          $array_campos[9] ='DISTRITO_CLI';
          $array_campos[10]='DIR_CLI';
          $array_campos[11]='FONO_CLI';
          $array_campos[12]='DESCRIP_CASO';
          $array_campos[13]='FEC_REGISTRO';
          $array_campos[14]='DURACION'; 

          $vw_tbl         = $this->vw_tbl_json;
          $campo_id       = $this->campo_id_json;
          //$where_extension  = ' 1=1 ';
          //$where_extension = " COD_ESTADO_ASIGNACION in(1,5) ";

          if(isset($params['tipo_estado']) && $params['tipo_estado'] != "0"){
            $t_estado = " COD_ESTADO_ASIGNACION='".$params['tipo_estado']."'  ";
          }else{
            $t_estado = " COD_ESTADO_ASIGNACION in(1,5)  ";
          }

          if(isset($params['tipo_averia']) && $params['tipo_averia'] != "0"){
            $t_averia = " AND  COD_TIPO_AVERIA='".$params['tipo_averia']."'  ";
          }else{
            $t_averia = "  ";
          }

          if(isset($params['distrito']) && $params['distrito'] != "0"){
            $distrito = " AND ( COD_UBI_CLI='".$params['distrito']."' ) ";
          }else{
            $distrito = "  ";
          }
                
          $where_extension = $t_estado . $t_averia . $distrito ;

          $rp = isset($params['rowCount']) ? $params['rowCount'] : 10;          
          if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
              $start_from = ($page-1) * $rp;


          $this->load->library('json_bootgrid_gmv');
          //$where_extension=' 1=1 ';

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
            "rows"                => $data/*,  // total data array
            "query_record"        => $sqlRec,
            "query_total"        => $sqlTot,*/
            );
          
          return $json_data;
        }



       public function json_listar_tmrh_disponible($params) 
       {
          
          $this->load->database();

          $array_campos[0] = 'COD_TMRH_DISPO';
          $array_campos[1] = 'COD_TMRH_ASIG';
          $array_campos[2] = 'COD_TMRH';
          $array_campos[3] = 'NOM_TMRH';
          $array_campos[4] = 'APE_PATERNO';
          $array_campos[5] = 'APE_MATERNO';
          $array_campos[6] = 'EMAIL';
          $array_campos[7] = 'NUM_DOCUMENTO';
          $array_campos[8] = 'COD_UBIGEO';
          $array_campos[9] = 'COD_DEPARTAMENTO';
          $array_campos[10] = 'cod_provincia';
          $array_campos[11] = 'COD_DISTRITO';
          $array_campos[12] = 'DISTRITO';
          $array_campos[13] = 'DIRECCION';
          $array_campos[14] = 'COD_TIPO_DOCUMENTO';
          $array_campos[15] = 'DESCRIP_DOCUMENTO';
          $array_campos[16] = 'COD_TIPO_GENERO';
          $array_campos[17] = 'SEXO';
          $array_campos[18] = 'FEC_NACIMIENTO';
          $array_campos[19] = 'EDAD';
          $array_campos[20] = 'FEC_REGISTRO';
          $array_campos[21] = 'FEC_MODIFICACION';
          $array_campos[22] = 'COD_USUARIO_REGISTRO';
          $array_campos[23] = 'COD_ESTADO_DISPO';

          $vw_tbl         = $this->vw_tbl_json;
          $campo_id       = $this->campo_id_json;
          //$where_extension  = ' 1=1 ';
          //$where_extension = " COD_ESTADO_ASIGNACION in(1,5) ";

          if(isset($params['tipo_estado']) && $params['tipo_estado'] != "0"){
            $t_estado = " COD_ESTADO_ASIGNACION='".$params['tipo_estado']."'  ";
          }else{
            $t_estado = " COD_ESTADO_ASIGNACION in(1,5)  ";
          }

          if(isset($params['tipo_averia']) && $params['tipo_averia'] != "0"){
            $t_averia = " AND  COD_TIPO_AVERIA='".$params['tipo_averia']."'  ";
          }else{
            $t_averia = "  ";
          }

          if(isset($params['distrito']) && $params['distrito'] != "0"){
            $distrito = " AND ( COD_UBI_CLI='".$params['distrito']."' ) ";
          }else{
            $distrito = "  ";
          }
                
          $where_extension = $t_estado . $t_averia . $distrito ;

          $rp = isset($params['rowCount']) ? $params['rowCount'] : 10;          
          if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
              $start_from = ($page-1) * $rp;


          $this->load->library('json_bootgrid_gmv');
          //$where_extension=' 1=1 ';

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
            "rows"                => $data/*,  // total data array
            "query_record"        => $sqlRec,
            "query_total"        => $sqlTot,*/
            );
          
          return $json_data;
        }




}


?>
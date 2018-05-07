<?php

class Solicitudes_trabajo_asignacion_info_model extends CI_Model {

        //public $array_campos_json;
 
        public $vw_tbl_json    = ' VW_TMRH_OCUPACION vw_ocup
                                   INNER JOIN VW_TMRH_OFICIOS_CENTRALIZADO vw_of_cen
                                  ON (vw_of_cen.COD_TMRH=vw_ocup.COD_TMRH ) ';

        public $campo_id_json  = 'vw_ocup.COD_TMRH';

         public function __construct()
        {
            parent::__construct();

        }      
        

/*..............................................*/

       public function json_listar_tmrh_disponible($params) 
       {
          
          $this->load->database();

          $array_campos[0]='vw_ocup.COD_TMRH_DISPO';
          $array_campos[1]='vw_ocup.COD_TMRH_ASIG';
          $array_campos[2]='vw_ocup.COD_TMRH';
          $array_campos[3]='vw_ocup.NOM_TMRH';
          $array_campos[4]='vw_ocup.APE_PATERNO';
          $array_campos[5]='vw_ocup.APE_MATERNO';
          $array_campos[6]='vw_ocup.COD_UBIGEO';
          $array_campos[7]='vw_ocup.DISTRITO';
          $array_campos[8]='vw_ocup.COD_TIPO_DOCUMENTO';
          $array_campos[9]='vw_ocup.DESCRIP_DOCUMENTO';
          $array_campos[10]='vw_ocup.COD_TIPO_GENERO';
          $array_campos[11]='vw_ocup.SEXO';
          $array_campos[12]='vw_ocup.EDAD';
          //$array_campos[13]='vw_of_cen.COD_TMRH';
          $array_campos[14]='vw_of_cen.COD_OFICIO';
          $array_campos[15]='vw_of_cen.DES_OFICIO';
          $array_campos[16]='vw_of_cen.COD_TIEMPO_EXPERIENCIA';
          $array_campos[17]='vw_of_cen.DESCRIP_TIEMPO_EXPERIENCIA';
          $array_campos[18]='vw_of_cen.OFICIO_PRIORIDAD';
          $array_campos[19]='vw_of_cen.FEC_REGISTRO';

          $array_campos[20]='vw_ocup.COD_ESTADO_DISPO';
          $array_campos[21]='vw_ocup.ESTADO_DISPO';
          $array_campos[22]='vw_ocup.NOM_APE_TMRH';

          $vw_tbl         = $this->vw_tbl_json;
          $campo_id       = $this->campo_id_json;

          $t_filtro = " 1=1 ";

          if(isset($params['id_oficio']) && $params['id_oficio'] != "0"){
            $t_oficio = "  AND vw_of_cen.COD_OFICIO='".$params['id_oficio']."'  ";
          }else{
            $t_oficio = "  ";
          }


          if(isset($params['rango_edad']) ){

            $edad = $params['rango_edad'];

            switch ($edad) {
                case 1:
                    $t_edad = "  AND vw_ocup.EDAD <= 25 "; 
                    break;
                case 2:
                    $t_edad = "  AND vw_ocup.EDAD BETWEEN 26 and 35 ";
                    break;
                case 3:
                    $t_edad = "  AND vw_ocup.EDAD BETWEEN 36 and 45 ";
                    break;
                case 4:
                    $t_edad = "  AND vw_ocup.EDAD BETWEEN 46 and 55 ";
                    break;
                case 5:
                    $t_edad = "  AND vw_ocup.EDAD >= 56 ";
                    break;
                default:
                   $t_edad = "   ";
            }

          }else{
            $t_edad = "  ";
          }


          if(isset($params['sexo']) && $params['sexo'] != "0"){
            $t_sexo = " AND  vw_ocup.COD_TIPO_GENERO = '".$params['sexo']."'  ";
          }else{
            $t_sexo = "  ";
          }


          if(isset($params['distrito']) && $params['distrito'] != "0"){
            $t_distrito = "  AND ( COD_UBIGEO ='".$params['distrito']."')  ";
          }else{
            $t_distrito = "  ";
          }
               

          $where_extension = $t_filtro . $t_oficio . $t_edad . $t_sexo . $t_distrito ;


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
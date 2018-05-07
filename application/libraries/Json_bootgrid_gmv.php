<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Json_bootgrid_gmv {
   //funciones que queremos implementar en Miclase.

        public function __construct()
        {
                // Do something with $params
        }


       public function get_query_bootgrid($params, $array_campos, $vw_tbl, $campo_id, $where_extension) 
       {
          		
          $rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
          
          if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
              $start_from = ($page-1) * $rp;

          
          $sql = $sqlRec = $sqlTot = $where = '';
          
          if( !empty($params['searchPhrase']) ) {   
              $where_campos ="";
              foreach ($array_campos as $key => $value) {
              	$where_campos .=" OR $value LIKE '".$params['searchPhrase']."%' ";
              }
              $where =" WHERE ( $campo_id='".$params['searchPhrase']."%' ".$where_campos.") ";
           }

           if(isset($array_campos)){
           	  $campos ="";
              foreach ($array_campos as $key => $value) {
              		$campos .= " $value,";
              }
              //substr("abcdef", 0, -1);  // devuelve "abcde"
              $campos = substr($campos , 0, -1);              
          	  $sql = "SELECT  DISTINCT  $campos FROM $vw_tbl  ";
           }

          $sqlTot .= $sql;
          $sqlRec .= $sql;
          

          if(isset($where) && trim($where) != '') {  

            $sqlTot .= $where." AND (". $where_extension .") ";
            $sqlRec .= $where." AND (". $where_extension .") ";

          }else{

              $where = "WHERE (".$where_extension.") ";
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
            $order_by = " order by $campo_id desc  ";
          }


          if ($rp!=-1){}
          $sqlRec .= $order_by." LIMIT ". $start_from .",".$rp;


  		  //echo "data[query_registros]: $sqlRec.<br>";
		  //echo "data[query_total]: $sqlTot.<br>";    

		  $data["query_registros"]=$sqlRec;
		  $data["query_total"]=$sqlTot;

          return $data;

      }




}


?>
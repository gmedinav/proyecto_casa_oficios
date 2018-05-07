<?php
//Asignacion_solicitud_tmrh_model
class Asignacion_tmrh_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function insertar_Asignacion_solicitud_tmrh($data_array)
        {
               $this->load->database();                              

               $query = $this->db->insert('tb_asignacion_tmrh', $data_array); 
               //echo "CODIGOOO " .  $this->db->insert_id();
               
               $codigo = 0;
               if ($query == true){
               
                  $codigo = $this->db->insert_id();
                  return $codigo;//->result_array();

               }else{
                              
                  return $codigo;//->result_array();
               }
               
        }


        public function obtener_asignacion_solicitud_tmrh($cod_asignacion_tmrh){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_asignacion_tmrh`,
                              `cod_tmrh`,
                              `cod_solicitud_trabajo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_asignacion_tmrh "

                       ." WHERE cod_asignacion_tmrh='$cod_asignacion_tmrh';");
               
               return $query->row_array();

        }

        public function obtener_asignacion_por_solicitud($cod_solicitud_trabajo){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_asignacion_tmrh`,
                              `cod_tmrh`,
                              `cod_solicitud_trabajo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_asignacion_tmrh "

                       ." WHERE cod_solicitud_trabajo='$cod_solicitud_trabajo';");
               
               return $query->row_array();

        }




        public function listar_asignacion_solicitud_tmrh(){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_asignacion_tmrh`,
                              `cod_tmrh`,
                              `cod_solicitud_trabajo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_asignacion_tmrh ");
               
               return $query->row_array();

        }


        public function actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo){

               $this->load->database();

                $data = array(
                        'cod_tmrh' => $cod_tmrh,
                        'cod_user_registro' => $_SESSION['sesion_id_usuario']
                );

                return $this->db->update('tb_asignacion_tmrh',
                                    $data, 
                                    array('cod_solicitud_trabajo'=>$cod_solicitud_trabajo));

        }



}


?>
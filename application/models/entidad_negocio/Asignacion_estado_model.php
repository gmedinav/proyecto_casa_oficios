<?php
//Asignacion_solicitud_estado
//asignacion_estado
class Asignacion_estado_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function insertar_Asignacion_solicitud_estado($data_array)
        {
               $this->load->database();                              

               $query = $this->db->insert('tb_asignacion_estado', $data_array); 
               //echo "CODIGOOO " .  $this->db->insert_id();
               
               $codigo = 0;
               if ($query == true){
               
                  $codigo = $this->db->insert_id();
                  return $codigo;//->result_array();

               }else{
                              
                  return $codigo;//->result_array();
               }
               
        }


        public function obtener_asignacion_solicitud_estado($cod_asignacion_estado){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_asignacion_estado`,
                              `cod_estado`,
                              `cod_solicitud_trabajo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_asignacion_estado "

                       ." WHERE cod_asignacion_estado='$cod_asignacion_estado';");
               
               return $query->row_array();

        }

        public function obtener_asignacion_por_solicitud($cod_solicitud_trabajo){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_asignacion_estado`,
                              `cod_estado`,
                              `cod_solicitud_trabajo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_asignacion_estado "

                       ." WHERE cod_solicitud_trabajo='$cod_solicitud_trabajo';");
               
               return $query->row_array();

        }


        public function listar_asignacion_solicitud_estado(){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_asignacion_estado`,
                              `cod_estado`,
                              `cod_solicitud_trabajo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_asignacion_estado ");
               
               return $query->row_array();

        }


        public function actualizar_asignacion_solicitud_estado($cod_estado,$cod_solicitud_trabajo){

               $this->load->database();

                $data = array(
                        'cod_estado' => $cod_estado,
                        'cod_user_registro' => $_SESSION['sesion_id_usuario']
                );

                return $this->db->update('tb_asignacion_estado',
                                    $data, 
                                    array('cod_solicitud_trabajo'=>$cod_solicitud_trabajo));

        }


        public function cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo, $cod_user){

               $this->load->database();

                $data = array(
                        'cod_estado' => 2,
                        'cod_user_registro' => $cod_user
                );

                return $this->db->update('tb_asignacion_estado',
                                    $data, 
                                    array('cod_solicitud_trabajo'=> $cod_solicitud_trabajo));


        }

}


?>
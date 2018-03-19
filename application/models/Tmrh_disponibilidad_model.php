<?php

class Tmrh_disponibilidad_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function insertar_Tmrh_disponibilidad($data_array)
        {
               $this->load->database();                              
               $query = $this->db->insert('tb_tmrh_disponibilidad', $data_array); 
               
               $codigo = 0;
               if ($query == true){
               
                  $codigo = $this->db->insert_id();
                  return $codigo;

               }else{
                              
                  return $codigo;
               }
               
        }


        public function obtener_Tmrh_disponibilidad($id){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_tmrh_disponibilidad`,
                              `cod_tmrh`,
                              `cod_tip_est_dispo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_tmrh_disponibilidad "

                       ." WHERE cod_tmrh_disponibilidad='$id';");
               
               return $query->row_array();

        }

        public function obtener_Tmrh_disponibilidad_x_cod_tmrh($id){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_tmrh_disponibilidad`,
                              `cod_tmrh`,
                              `cod_tip_est_dispo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_tmrh_disponibilidad "

                       ." WHERE cod_tmrh='$id';");
               
               return $query->row_array();

        }        

        public function listar_Tmrh_disponibilidad(){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "    `cod_tmrh_disponibilidad`,
                              `cod_tmrh`,
                              `cod_tip_est_dispo`,
                              `cod_user_registro`,
                              `fec_registro`,
                              `fec_modificacion`"

                       . " from tb_tmrh_disponibilidad ");
               
               return $query->row_array();

        }


        public function actualizar_Tmrh_disponibilidad_x_cod_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user_registro){

               $this->load->database();

                $data = array(
                        'cod_tip_est_dispo' => $cod_tip_est_dispo,
                        'cod_user_registro' => $cod_user_registro
                );

                return $this->db->update('tb_tmrh_disponibilidad',
                                    $data, 
                                    array('cod_tmrh'=>$cod_tmrh));

        }


        public function actualizar_Tmrh_dispo_x_id($data, $id){

               $this->load->database();

                /*
                $data = array(
                        'cod_tip_est_dispo' => $cod_tip_est_dispo,
                        'cod_tmrh' => $cod_tmrh,
                        'cod_user_registro' => $cod_user
                );
                */
                return $this->db->update('tb_tmrh_disponibilidad',
                                    $data, 
                                    array('cod_tmrh_disponibilidad'=> $id));


        }

}


?>
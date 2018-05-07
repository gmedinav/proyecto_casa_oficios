<?php

class Solicitud_trabajo_model extends CI_Model {

       //public $cod_ubigeo;
        
       public function insertar_Solicitud_Trabajo($data_array)
        {
               $this->load->database();                              
               #$setencia="INSERT INTO tb_solicitud_trabajo"
               #        . '(COD_OFICIO, NOMBRE, EMAIL, TELEFONO, DIRECCION, DESCRIPCION, COD_UBIGEO, FOTO)'
               #        . ' values'
               #        . "($cboOficios,'$nombre_apellidos','$email','$telefono','$direccion','$descripcionUrgencia', '$cboDistrito','$foto');";
               //echo $setencia;
               //$query = $this->db->query($setencia);
               

               
               $query = $this->db->insert('tb_solicitud_trabajo', $data_array); 
               //echo "CODIGOOO " .  $this->db->insert_id();
               
               $codigo = 0;
               if ($query == true){
               
                  $codigo = $this->db->insert_id();
                  return $codigo;//->result_array();

               }else{
                              
                  return $codigo;//->result_array();
               }
               
        }

        public function obtener_id_insertado(){

              return $this->db->insert_id();

        }

        
        public function detalle_simple_solicitud($id_solicitud){

               $this->load->database();
               $query = $this->db->query("SELECT "
                       . "  t_st.COD_SOLICITUD,
                            t_st.DESCRIPCION,
                            t_st.DIRECCION,
                            t_st.COD_UBIGEO,
                            t_st.COD_TIPO_AVERIA,
                            t_st.NOMBRE,
                            t_u.DES_UBIGEO,

                            t_st.COD_TIPO_AVERIA,
                            t_ta.DES_TIPO_AVERIA"

                       . " from tb_solicitud_trabajo t_st
                          left join  tb_tipo_averia t_ta
                          on t_ta.COD_TIPAVERIA= t_st.COD_TIPO_AVERIA
                          inner join tb_ubigeo t_u
                          on t_u.COD_UBIGEO = t_st.COD_UBIGEO"

                       ." WHERE t_st.COD_SOLICITUD='$id_solicitud';");
               
               return $query->row_array();

        }

        public function cambiar_estado_solicitud_por_administrativo($id_solicitud){

               $this->load->database();

                $data = array(
                        'ESTADO' => 2
                );

                return $this->db->update('tb_solicitud_trabajo',
                                    $data, 
                                    array('COD_SOLICITUD'=>$id_solicitud));


        }

}


?>
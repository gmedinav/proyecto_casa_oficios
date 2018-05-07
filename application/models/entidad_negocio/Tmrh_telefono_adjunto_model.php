<?php

class Tmrh_telefono_adjunto_model extends CI_Model {

        public $cod_Tmrh_Contacto;//pk
        public $cod_Tmrh;
        public $cod_Tipo_Operadora;
        public $telefono;

  	public function crear_Telef_Contacto($cod_Tmrh,$cod_Tipo_Operadora,$telefono)
	{              
            // Crear el modelo de datos, sin llegar a ser persisntencia
            // esto con el fin para no genere problema con el FK
            
            //$this->Tmrh_telefono_adjunto_model->cod_Tmrh_Contacto;
            $instancia= new Tmrh_telefono_adjunto_model();
            $instancia->cod_Tmrh =$cod_Tmrh;
            $instancia->cod_Tipo_Operadora=$cod_Tipo_Operadora;
            $instancia->telefono=$telefono;            
            return $instancia;         
        }  
        
        
        //public function guardar_Instancia($id,$instancia)
        public function guardar_Instancia($data_array)
        {
                //$instancia->$cod_Tmrh = $id;
                
//               $this->$cod_Tmrh_Contacto;
//               $this->$cod_Tmrh;
//               $this->$cod_Tipo_Operadora;
//               $this->$telefono;

               $this->load->database();                  
               $rpta= $this->db->insert('tb_tmrh_contacto', $data_array);
               return $rpta;

        }
        
        
       public function listar_telefono_adjunto()
        {
               $this->load->database();
               $query = $this->db->query('SELECT * from tb_tmrh_contacto;');
               return $query->result_array();
        }

        public function obtener_telefono_adjunto($id)
        {
               $this->load->database();
               $query = $this->db->query("SELECT * from tb_tmrh_contacto where COD_TMRH='$id';");
               return $query->result_array();
        }


        public function buscar_telefono_registrado($telefono)
        {
               $this->load->database();
               $query = $this->db->query("SELECT * from tb_tmrh_contacto where TELEFONO=trim('$telefono');");
               return $query->result_array();
        }        

}

#https://www.linkedin.com/feed/update/urn:li:activity:6316750211158937601
?>
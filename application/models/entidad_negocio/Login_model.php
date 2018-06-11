<?php
class Login_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }


        public function listar_usuarios()
        {
			$importados = $this->db->query("SELECT  
											t.COD_USUARIO,
											t.DES_USUARIO,
											t.LOG_USUARIO,
											t.PASS_USUARIO,
											t.ESTADO,
											t.COD_TIPO_USUARIO
											FROM tb_usuario t"
										)->result_array();     
			
			$arreglo=array();
			 foreach($importados as $key => $val) {

			    $arreglo[] = $val;// myTables is the alias used in query.

			 }

		 	 return $arreglo;
        }



        public function obtener_sesion($usuario, $clave)
        {
			$usuario_sesion = $this->db->query("SELECT  
											t.COD_USUARIO,
											t.DES_USUARIO,
											t.LOG_USUARIO,
											t.PASS_USUARIO,
											t.ESTADO,
											t.COD_TIPO_USUARIO
											FROM tb_usuario t
											WHERE
											t.LOG_USUARIO='$usuario' and t.PASS_USUARIO='$clave' "

										)->row();     
		 	 return $usuario_sesion;
        }

        public function obtener_usuario($id)
        {
			$usuario_sesion = $this->db->query("SELECT  
											t.COD_USUARIO,
											t.DES_USUARIO,
											t.LOG_USUARIO,
											t.PASS_USUARIO,
											t.ESTADO,
											t.COD_TIPO_USUARIO
											FROM tb_usuario t
											WHERE
											t.COD_USUARIO='$id'"

										)->row();     
		 	 return $usuario_sesion;
        }    


        public function agregar($data)
        {
			$usuario_insertado = $this->db->insert("tb_usuario",$data);
		 	 return $usuario_insertado;
        }                 


}?>
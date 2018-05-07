<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tmrh extends CI_Controller {
    
    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');   
            $this->load->library('session');         
               
			if($this->sesion_activa()==false){

				redirect(base_url()."admin/Login/");
				die();			
			}  


    }     

	public function index()
	{
		$data['vista_incluida']= "admin/tmrh/vw_tmrh_listar";
		$data['titulo']= "Trabajadores (TMRH)";

        $this->load->view('admin/_template/header');   
        $this->load->view('admin/_template/menu');   
        $this->load->view('admin/_template/content',$data);     
        $this->load->view('admin/_template/footer');                     
	}


	public function json_nuevo_listar_tmrh()
	{          
		$this->load->model('entidad_ajax/tmrh_info_model');
		$params = $_REQUEST;
		//$params = $this->input->get_post();

		$array_campos[0]='COD_TMRH';
		$array_campos[1]='NOM_TMRH';
		$array_campos[2]='APE_PATERNO';
		$array_campos[3]='APE_MATERNO';
		$array_campos[4]='EMAIL';
		$array_campos[5]='NUM_DOCUMENTO';
		$array_campos[6]='DISTRITO';
		$array_campos[7]='DIRECCION';
		$array_campos[8]='DESCRIP_DOCUMENTO';
		$array_campos[9]='SEXO';
		$array_campos[10]='EDAD';

		$vw_tbl="VW_TMRH_PERFIL";
		$campo_id="COD_TMRH";

		$data['json']  = $this->tmrh_info_model->json_listar_tmrh_perfil($params, $array_campos, $vw_tbl, $campo_id);
		$this->load->view('admin/_template/json_servicio',$data);
               
	}	        

	public function ajax_vista_telefonos($id){

		$this->load->model('entidad_ajax/tmrh_info_model');
		$lista_contactos = $this->tmrh_info_model->listar_contactos_x_tmrh($id);
		$principal  ="";
		$secundario ="";

		if(isset($lista_contactos )){

			foreach ($lista_contactos  as $value) {

				if($principal==""){
					$principal= "<tr><td colspan='2'><strong>Télefono Principal</strong></td></tr>".	

								"<tr><td>".$value['OPERADORA_PRINCIPAL'].":</td>".
								"<td>".$value['CELULAR_PRINCIPAL']."</td></tr>".

								"<tr><td colspan='2'>&nbsp; <td></tr>".
								"<tr><td colspan='2'><strong>Télefono(s) Secundario(s)</strong><td></tr>";		
				}
				
				$secundario .= "<tr><td>".$value['OPERADORA_SECUNDARIA'].": </td>";
				$secundario .= "<td>".$value['CELULAR_SECUNDARIO']."</td></tr>";
			}
			echo "<table>".$principal.$secundario."</table>";

		}else{

			echo "<div>No se encontró ningún resultado.</div>";
		}

	}


	public function ajax_vista_oficios($id){

		$this->load->model('entidad_ajax/tmrh_info_model');
		$lista_contactos = $this->tmrh_info_model->listar_oficios_experiencia_x_tmrh($id);
		$principal  ="";
		$secundario ="";

		if(isset($lista_contactos )){

			foreach ($lista_contactos  as $value) {

				if($principal==""){
					$principal= "<tr><td colspan='2'><strong>Oficio Principal</strong></td></tr>".	

								"<tr><td>".$value['DES_OFICIO_PRINCIPAL'].":</td>".
								"<td>".$value['PERIODO_EXPERIENCIA_PRINCIPAL']."</td></tr>".

								"<tr><td colspan='2'>&nbsp; <td></tr>".
								"<tr><td colspan='2'><strong>Oficio(s) Secundario(s)</strong><td></tr>";		
				}				
				$secundario .= "<tr><td>".$value['DES_OFICIO_SECUNDARIO'].": </td>";
				$secundario .= "<td>".$value['PERIODO_EXPERIENCIA_SECUNDARIO']."</td></tr>";
			}

			echo "<table>".$principal.$secundario."</table>";

		}else{

			echo "<div>No se encontró ningún resultado.</div>";
		}

	}

    public function sesion_activa(){

        if(!isset($_SESSION['sesion_usuario'])){
	        #$this->load->view('vw_login');
            return false;
        }else{
                #http_redirect($uri);
        	return true;
        }

    }		

}
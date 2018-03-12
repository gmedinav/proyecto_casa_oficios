<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Asignacion_solicitud_trabajador extends CI_Controller {
    

        //Public $lista_telefonos= array();        
    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');   
            $this->load->library('session');        

            //$this->load->model('Asignacion_solicitud_tmrh_model');
            //$data['distritos']= $this->Asignacion_solicitud_tmrh_model->actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo);                   

    }   



    public function asignacion($cod_solicitud_trabajo,$cod_tmrh)
    {

        $this->load->model('Asignacion_solicitud_tmrh_model');
        $this->load->model('Asignacion_solicitud_estado_model');

        $cod_user = $_SESSION['sesion_id_usuario'];

        $rpta = $this->Asignacion_solicitud_tmrh_model->obtener_asignacion_por_solicitud($cod_solicitud_trabajo);

        if(isset($rpta)){

            $id = $this->Asignacion_solicitud_tmrh_model->actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo);                   
            
            if(isset($id)){

                $ok = $this->Asignacion_solicitud_estado_model->cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo,$cod_user);

                if(isset($ok)){
                   echo "Se reasignó a un trabajador correctamente con el número de transacción: #".$id;  
                }else{
                    echo "Se reasignó a un trabajador, pero no se cambio el estado de la solicitud: #".$id;                    
                }
                return;
          

            }else{
                echo "No se pudo reasignar al trabajador. Por favor, vuelva intentarlo.";                

            }
            return;

        }else{

            $data1 = array(
                                'cod_tmrh' => $cod_tmrh,
                                'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                'cod_user_registro' =>  $cod_user,
                                
                         );

            $data2 = array(
                                'cod_estado' => 2,
                                'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                'cod_user_registro' =>  $cod_user,
                                
                         );

            $id=$this->Asignacion_solicitud_tmrh_model->insertar_Asignacion_solicitud_tmrh($data1);

            if(isset($id)){

                $ok=$this->Asignacion_solicitud_estado_model->insertar_Asignacion_solicitud_estado($data2);

                if(isset($ok) ){
                   echo "N° de transacción <strong>#".$id."</strong>: Se asignó a un trabajador.";  
                }else{
                    echo "N° de transacción <strong>#".$id."</strong>: Se asignó a un trabajador, pero no se cambio el estado.";               
                }
                return;
                
            }else{

                echo "No se pudo asignar a un trabajador."; 
                return;
            }

        }

    }


    public function solicitud_trabajo()
    {
        redirect(base_url()."Administrar/solicitud_trabajo");
    }


    public function index()
    {

        $this->load->view('admin_panel');

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
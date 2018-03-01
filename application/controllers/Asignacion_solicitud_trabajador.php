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
        $this->load->model('Solicitud_trabajo_model');

        $rpta = $this->Asignacion_solicitud_tmrh_model->obtener_asignacion_por_solicitud($cod_solicitud_trabajo);

        if(isset($rpta)){

            $id = $this->Asignacion_solicitud_tmrh_model->actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo);                   
            
            if(isset($id)){

                $ok=$this->Solicitud_trabajo_model->cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo);

                if(isset($ok)){
                   echo "Se reasignó a un trabajador correctamente con el número de transacción. ".$id;  
                }else{
                    echo "Se reasignó a nuevo trabajador, pero no se cambio el estado de la solicitud. ".$id;                    
                }
                return;
                //echo "Se reasignó correctamente al trabajador con el número de transacción.".$id;                

            }else{
                echo "No se pudo reasignar al trabajador. Por favor, vuelva intentarlo.";                

            }
            return;

        }else{

            $data = array(
                                'cod_tmrh' => $cod_tmrh,
                                'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                'cod_user_registro' =>  $_SESSION['sesion_id_usuario'],
                                
                         );

            $id=$this->Asignacion_solicitud_tmrh_model->insertar_Asignacion_solicitud_tmrh($data);

            if(isset($id)){

                $ok = $this->Solicitud_trabajo_model->cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo);
                
                if(isset($ok) ){
                   echo "Se asignó a un trabajador correctamente con el número de transacción. ".$id;  
                }else{
                    echo "Se asignó a nuevo trabajador, pero no se cambio el estado de la solicitud. ".$id;                    
                }
                return;
                
            }else{

                echo "No se pudo asignar a un trabajador."; 
                return;
            }

            


        }

    }

    public function index()
    {

        $this->load->view('example');

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
<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Asignacion_solicitud_trabajador extends CI_Controller {
      
    function __construct()
    {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');   
            $this->load->library('session');   

            if($this->sesion_activa()==false){
                redirect(base_url()."Login/");
                die();          
            }                   

    }   

//Modelo SUBASTA en puja para enganchar una demanda del cliente... se me vino a la mente: entre los TMRH existentes

/*primera versión
    public function asignacion($cod_solicitud_trabajo,$cod_tmrh)
    {

        $this->load->model('Asignacion_solicitud_tmrh_model');
        $this->load->model('Asignacion_solicitud_estado_model');
       //$this->load->model('Tmrh_disponibilidad_model');

        $cod_user = $_SESSION['sesion_id_usuario'];

        $rpta = $this->Asignacion_solicitud_tmrh_model->obtener_asignacion_por_solicitud($cod_solicitud_trabajo);

        if(isset($rpta)){

            $id = $this->Asignacion_solicitud_tmrh_model->actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo);                   
            
            if(isset($id)){

                $encontrar=$this->Asignacion_solicitud_estado_model->obtener_asignacion_por_solicitud($cod_solicitud_trabajo);

                if(isset($encontrar)){

                   $ok = $this->Asignacion_solicitud_estado_model->cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo,$cod_user);
                   if(isset($ok)){
                        echo "Se reasignó al nuevo trabajador correctamente." ;  
                   }else{
                        echo "Se reasignó al nuevo trabajador, pero no se cambio el estado de la solicitud:".$ok ;
  
                   }
                   
                }else{

                    $data2 = array(
                                'cod_estado' => 2,
                                'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                'cod_user_registro' =>  $cod_user,
                                
                    );

                    $rpta2=$this->Asignacion_solicitud_estado_model->insertar_Asignacion_solicitud_estado($data2);

                    if(isset($rpta2) ){
                        echo "Se reasignó al nuevo trabajador correctamente (más estado).";  
                    }else{
                        echo "Se rasignó a un trabajador, pero no se cambió el estado.";               
                    }
               
                }


                #######
                $this->cambiar_disponibilidad_tmrh(3, $cod_tmrh, $cod_user);
               
                if(isset($cambio_disponilidad)){

                }else{

                }

               #######


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

            $id = $this->Asignacion_solicitud_tmrh_model->insertar_Asignacion_solicitud_tmrh($data1);

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

*/


//Versión Optimizada para la reutilización para la reasignación
    public function asignacion($cod_solicitud_trabajo,$cod_tmrh)
    {

        $cod_user = $_SESSION['sesion_id_usuario'];
        $cod_tip_est_dispo = 3;

        $id_asig_tmrh = $this->cambiar_asignacion_tmrh($cod_solicitud_trabajo, $cod_tmrh, $cod_user);
        if(isset($id_asig_tmrh['codigo'])){

            $id_asig_estado = $this->cambiar_asignacion_estado($cod_solicitud_trabajo, $cod_tmrh, $cod_user);
            $id_dispo_tmrh = $this->cambiar_disponibilidad_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user);

            echo "Se asignó el trabajador correctamente." ;  

        }else{

            echo "No se pudo asignar el trabajador." ;  

        }

    }

///////

    public function cambiar_disponibilidad_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user){
        //Cambiar la tabla tmrh_disponibilidad
        $this->load->model('Tmrh_disponibilidad_model');
        
        $resultado = $this->Tmrh_disponibilidad_model->obtener_Tmrh_disponibilidad_x_cod_tmrh($cod_tmrh);


        if(isset($resultado)){
            $rpta['tipo']   = "Actualizado";
            $rpta['codigo'] = $this->Tmrh_disponibilidad_model->actualizar_Tmrh_disponibilidad_x_cod_tmrh($cod_tip_est_dispo, $cod_tmrh, $cod_user);

        }else{

            $data = array(
                        'cod_tmrh' => $cod_tmrh,
                        'cod_tip_est_dispo' => $cod_tip_est_dispo,
                        'cod_user_registro' =>  $cod_user,                                       
                        );

            $rpta['tipo']   = "Insertado";
            $rpta['codigo'] = $this->Tmrh_disponibilidad_model->insertar_Tmrh_disponibilidad($data);
        }
        return $rpta;
    }

    public function cambiar_asignacion_estado($cod_solicitud_trabajo, $cod_tmrh, $cod_user){
        //Cambiar la tabla Asignacion de Estado
        $this->load->model('Asignacion_solicitud_estado_model');        
        $resultado = $this->Asignacion_solicitud_estado_model->obtener_asignacion_por_solicitud($cod_solicitud_trabajo);


        if(isset($resultado)){
            $rpta['tipo']   = "Actualizado";
            $rpta['codigo'] = $this->Asignacion_solicitud_estado_model->cambiar_estado_solicitud_por_administrativo($cod_solicitud_trabajo, $cod_user);

        }else{

            $data = array(
                                    'cod_estado' => 2,
                                    'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                    'cod_user_registro' =>  $cod_user,                                      
                        );
            $rpta['tipo']   = "Insertado";
            $rpta['codigo'] = $this->Asignacion_solicitud_estado_model->insertar_Asignacion_solicitud_estado($data);
        }
        return $rpta;
    }

    public function cambiar_asignacion_tmrh($cod_solicitud_trabajo, $cod_tmrh, $cod_user){
        //Cambiar la tabla Asignacion de Estado
        $this->load->model('Asignacion_solicitud_tmrh_model');        
        $resultado = $this->Asignacion_solicitud_tmrh_model->obtener_asignacion_solicitud_tmrh($cod_tmrh);

        if(isset($resultado)){
            $rpta['tipo']   = "Actualizado";
            $rpta['codigo'] = $this->Asignacion_solicitud_tmrh_model->actualizar_asignacion_solicitud_tmrh($cod_tmrh,$cod_solicitud_trabajo); 

        }else{

            $data = array(
                                    'cod_tmrh' => $cod_tmrh,
                                    'cod_solicitud_trabajo' => $cod_solicitud_trabajo,
                                    'cod_user_registro' =>  $cod_user,                                   
                        );            
            $rpta['tipo']   = "Insertado";
            $rpta['codigo'] = $this->Asignacion_solicitud_tmrh_model->insertar_Asignacion_solicitud_tmrh($data);
        }
        return $rpta;
    }

/////

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
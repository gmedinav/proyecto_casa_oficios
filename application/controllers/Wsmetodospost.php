<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

/**
 * Description of RestPostController
 *
 * @author http://roytuts.com
 */
class Wsmetodospost extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Wscliente_model', 'cm');
        
        $this->load->model('Wssolicitud_model', 'de');
    }

    function add_contact_post() {
        
        //http://localhost:8081/proyecto_casa_oficios/index.php/wsmetodospost/add_contact
        
        // Headers: Add Custom Header as name = Content-Type, value=application/json
        
        //Body: {“contact_name”:”S Roy”, “contact_address”:”http://roytuts.com”, “contact_phone”:”1234567890″}
        
        $contact_name = $this->post('contact_name');
        $contact_address = $this->post('contact_address');
        $contact_phone = $this->post('contact_phone');
        
        
        echo "HOLA MUNDO : ".$contact_phone;
        
        $result = $this->cm->add_contact($contact_name, $contact_address, $contact_phone);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    
     function add_cliusu_post() {
         
         //http://localhost:8081/proyecto_casa_oficios/index.php/wsmetodospost/add_cliusu
         

         
        // Headers: Add Custom Header as name = Content-Type, value=application/json
        
         
         // JSON :
         /*
                        {"p_log_usuario":"jaime.ac8866@gmail.com",
            "p_pass_usuario":"jaimejose",
            "p_estado":"0", 
            "p_cod_tipo_usuario":"2", 
             "p_fec_registro":"2017-10-10", 
             "p_fec_modificacion":"2017-10-10", 
             "p_cod_usuario_registro":"2", 
             "p_nom_cliente":"Jaime Jose", 
             "p_ape_paterno":"Aguilar", 
             "p_ape_materno":"Cabezas", 
             "p_cod_tipo_documento":"1", 
             "p_num_documento":"44953781", 
             "p_cod_tipo_genero":"1", 
             "p_cod_ubigeo":"001000000", 
             "p_direccion":"ab", 
             "p_cel_1":"0", 
             "p_cel_2":"0", 
             "p_cuenta_facebook":"0", 
             "p_cuenta_gmail":"0", 
             "p_fecha_nacimiento":"2017-10-10", 
             "p_cod_tipo_canal_contacto":"0", 
             "p_fec_modificacion_cli":"2017-10-10", 
             "p_fec_registro_cli":"2017-10-10", 
             "p_cod_usuario_registro_cli":"1", 
             "p_estado_cli":"1"}
         
        
        Parametros*/
        $p_log_usuario = $this->post('p_log_usuario');
        $p_pass_usuario = $this->post('p_pass_usuario'); // varchar(255),
        $p_estado = $this->post('p_estado'); // int,
        $p_cod_tipo_usuario = $this->post('p_cod_tipo_usuario'); // int,
        $p_fec_registro = $this->post('p_fec_registro'); // datetime,
        $p_fec_modificacion = $this->post('p_fec_modificacion'); // datetime,
        $p_cod_usuario_registro = $this->post('p_cod_usuario_registro'); // int,
        $p_nom_cliente = $this->post('p_nom_cliente'); // varchar(255),
        $p_ape_paterno = $this->post('p_ape_paterno'); // varchar(100),
        $p_ape_materno = $this->post('p_ape_materno'); // varchar(100),
        $p_cod_tipo_documento = $this->post('p_cod_tipo_documento'); // int,
        $p_num_documento = $this->post('p_num_documento'); // varchar(255),
        $p_cod_tipo_genero = $this->post('p_cod_tipo_genero'); // int,
        $p_cod_ubigeo = $this->post('p_cod_ubigeo'); // char(9),
        $p_direccion = $this->post('p_direccion'); // varchar(300),
        $p_cel_1 = $this->post('p_cel_1'); // varchar(50),
        $p_cel_2 = $this->post('p_cel_2'); // varchar(50),
        $p_cuenta_facebook = $this->post('p_cuenta_facebook'); // varchar(255),
        $p_cuenta_gmail = $this->post('p_cuenta_gmail'); // varchar(255),
        $p_fecha_nacimiento = $this->post('p_fecha_nacimiento'); // date,
        $p_cod_tipo_canal_contacto = $this->post('p_cod_tipo_canal_contacto'); // int,
        $p_fec_modificacion_cli = $this->post('p_fec_modificacion_cli'); // datetime,
        $p_fec_registro_cli = $this->post('p_fec_registro_cli'); // datetime,
        $p_cod_usuario_registro_cli = $this->post('p_cod_usuario_registro_cli');// int,
        $p_estado_cli = $this->post('p_estado_cli'); //int,
        
        
        
        $result = $this->cm->add_cliusu(
                        $p_log_usuario ,
                        $p_pass_usuario ,
                        $p_estado ,
                        $p_cod_tipo_usuario ,
                        $p_fec_registro ,
                        $p_fec_modificacion,
                        $p_cod_usuario_registro,
                        $p_nom_cliente ,
                        $p_ape_paterno ,
                        $p_ape_materno ,
                        $p_cod_tipo_documento ,
                        $p_num_documento ,
                        $p_cod_tipo_genero,
                        $p_cod_ubigeo ,
                        $p_direccion ,
                        $p_cel_1 ,
                        $p_cel_2 ,
                        $p_cuenta_facebook ,
                        $p_cuenta_gmail ,
                        $p_fecha_nacimiento,
                        $p_cod_tipo_canal_contacto ,
                        $p_fec_modificacion_cli ,
                        $p_fec_registro_cli ,
                        $p_cod_usuario_registro_cli ,
                        $p_estado_cli );
        
        
        if ($result === FALSE) {
            $this->response(array('status' => 'failed' , 'mensaje' => 'failed'));
        } else {
           // $this->response(array('status' => 'success'));
            
            
            $resultado = "";
            
            foreach($result as $obj){
                   $resultado = $obj->out_id;

                }
            
            
            $this->response(array('status' => 'success', 'mensaje' => $resultado ), 200);
        }
        
     }
    
    
     
      function add_soltrab_post() {
         
         //http://localhost:8081/proyecto_casa_oficios/index.php/wsmetodospost/add_soltrab
         

         
        // Headers: Add Custom Header as name = Content-Type, value=application/json
        
         
         // JSON :
         /*
                     {"p_log_usuario":"jaime.ac8866@gmail.com",
            "p_pass_usuario":"jaimejose",
            "p_estado":"0", 
            "p_cod_tipo_usuario":"2", 
             "p_fec_registro":"2017-10-10", 
             "p_fec_modificacion":"2017-10-10", 
             "p_cod_usuario_registro":"2", 
             "p_nom_cliente":"Jaime Jose", 
             "p_ape_paterno":"Aguilar", 
             "p_ape_materno":"Cabezas", 
             "p_cod_tipo_documento":"1", 
             "p_num_documento":"44953781", 
             "p_cod_tipo_genero":"1", 
             "p_cod_ubigeo":"001000000", 
             "p_direccion":"ab", 
             "p_cel_1":"0", 
             "p_cel_2":"0", 
             "p_cuenta_facebook":"0", 
             "p_cuenta_gmail":"0", 
             "p_fecha_nacimiento":"2017-10-10", 
             "p_cod_tipo_canal_contacto":"0", 
             "p_fec_modificacion_cli":"2017-10-10", 
             "p_fec_registro_cli":"2017-10-10", 
             "p_cod_usuario_registro_cli":"1", 
             "p_estado_cli":"1"}
         
        
        /*Parametros*/
        $p_cod_cliente = $this->post('p_cod_cliente');
        $p_cordenadas_registro = $this->post('p_cordenadas_registro'); 
        $p_cordenadas_ubicacion = $this->post('p_cordenadas_ubicacion'); 
        $p_cod_tipo_averia = $this->post('p_cod_tipo_averia'); 
        $p_cod_tipo_prioridad = $this->post('p_cod_tipo_prioridad'); 
        $p_nombre = $this->post('p_nombre'); 
        $p_email = $this->post('p_email'); 
        $p_telefono = $this->post('p_telefono'); 
        $p_descripcion = $this->post('p_descripcion'); 
        $p_estado = $this->post('p_estado'); 
        $p_precio_presupuesto = $this->post('p_precio_presupuesto'); 
        $p_precio_final = $this->post('p_precio_final'); 
        $p_cod_tipo_registro = $this->post('p_cod_tipo_registro'); 
        $p_fec_registro = $this->post('p_fec_registro'); 
        $p_fec_modificacion = $this->post('p_fec_modificacion'); 
        $p_cod_usuario_registro = $this->post('p_cod_usuario_registro'); 
        $p_cod_ubigeo = $this->post('p_cod_ubigeo'); 
        $p_direccion = $this->post('p_direccion'); 
        $p_cod_oficio = $this->post('p_cod_oficio'); 

        
        
        $result = $this->de->add_soltrab(
                        $p_cod_cliente,
                        $p_cordenadas_registro,
                        $p_cordenadas_ubicacion,
                        $p_cod_tipo_averia,
                        $p_cod_tipo_prioridad,
                        $p_nombre,
                        $p_email,
                        $p_telefono,
                        $p_descripcion,
                        $p_estado,
                        $p_precio_presupuesto,
                        $p_precio_final,
                        $p_cod_tipo_registro,
                        $p_fec_registro,
                        $p_fec_modificacion,
                        $p_cod_usuario_registro,
                        $p_cod_ubigeo,
                        $p_direccion,
                        $p_cod_oficio
);
        
        
        if ($result === FALSE) {
            $this->response(array('status' => 'failed' , 'mensaje' => 'failed'));
        } else {
           // $this->response(array('status' => 'success'));
            
            
            $resultado = "";
            
            foreach($result as $obj){
                   $resultado = $obj->out_id;

                }
            
            
            $this->response(array('status' => 'success', 'mensaje' => $resultado ), 200);
        }
        
     }
    
    
    
    
    

}

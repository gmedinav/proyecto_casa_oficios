<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabaja_con_nosotros extends CI_Controller {
    
        //Public $lista_telefonos= array();
        
        function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            
            $this->load->library('session');
            
        }    

	public function index()
	{
                
                $data['guardado']=FALSE;
                
                $this->resetListaTelefono();
                
		$this->load->model('ubigeo_model');
		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 
                
		$this->load->model('oficio_model');
		$data['oficios']= $this->oficio_model->listOficios();  
                
		$this->load->model('tipo_sexo_model');
		$data['sexos']= $this->tipo_sexo_model->listTipoSexo();        
                
		$this->load->model('tipo_operadora_model');
		$data['operadoras']= $this->tipo_operadora_model->listTipoOperadora();     
                
		$this->load->model('tipo_documento_model');
		$data['documentos']= $this->tipo_documento_model->listTipoDocumentos();        
                
 		$this->load->model('tipo_experiencia_model');
		$data['experiencias']= $this->tipo_experiencia_model->listPeriodoExperiencia();  
                

                //$data['array_telefonos'] = $this->listarTelefono();

                //print_r($data['array_telefonos']);
                
		$this->load->view('trabaja_con_nosotros',$data);

	}

        
    public function formulario()
    {
        $this->load->library('session');
        $data['guardado']=FALSE;

        $this->load->model('ubigeo_model');
        $data['distritos']= $this->ubigeo_model->listDistritosLima(); 

        $this->load->model('oficio_model');
        $data['oficios']= $this->oficio_model->listOficios();  

        $this->load->model('tipo_sexo_model');
        $data['sexos']= $this->tipo_sexo_model->listTipoSexo();        

        $this->load->model('tipo_operadora_model');
        $data['operadoras']= $this->tipo_operadora_model->listTipoOperadora();     

        $this->load->model('tipo_documento_model');
        $data['documentos']= $this->tipo_documento_model->listTipoDocumentos();        

        $this->load->model('tipo_experiencia_model');
        $data['experiencias']= $this->tipo_experiencia_model->listPeriodoExperiencia();              

        $data['array_telefonos']=array();
        
        echo "cargado de modelo y previo aray()<br>";
        if($this->input->post('btnAccionTelefono') == "Agregar")
        {
            $this->form_validation->set_rules('txtTelefono', '"Teléfono"', 'required|callback_validar_telefono_check');
            $this->form_validation->set_rules('cboProveedorTelf', '"Proveedor Telefónico"', 'required|is_natural_no_zero');
            
            $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
            $this->form_validation->set_message('is_natural_no_zero','Debe selecionar un proveedor.');  

            if ($this->form_validation->run() == FALSE) 
            {

                if(empty($this->listarTelefono())==false){                    
                    $data['array_telefonos'] = $this->listarTelefono();
                }
                                
                $this->load->view('trabaja_con_nosotros',$data);   
                return;
            }else{
                
                $telefono = $this->input->post('txtTelefono');
                $proveedor_fono = $this->input->post('cboProveedorTelf');
               
                $data['array_telefonos'] = $this->agregarItemTelefono($telefono,$proveedor_fono);

                if(empty($this->listarTelefono())==false){                    
                    $data['array_telefonos'] = $this->listarTelefono();
                }                
            }
            
        }else{
            
            if($this->input->post('btnAccionTelefono') == "Eliminar")
            {
                $this->form_validation->set_rules('lstTelefonoAgregados', '"Lista Teléfonos"', 'required');
                $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
                
                if ($this->form_validation->run() == FALSE) 
                {
                    if(empty($this->listarTelefono())==false){
                        $data['array_telefonos'] = $this->listarTelefono();  
                    }
                    
                    $this->load->view('trabaja_con_nosotros',$data);   
                    return;
                }else{
                    
                    $proveedor_fono = trim($this->input->post('lstTelefonoAgregados'));
                    $arreglo = explode("-", $proveedor_fono);                  
                    $telefono=$arreglo[1];
                    
                    if(empty($this->existeItemTelefono($telefono))==false)
                    {
                        $indice=$this->existeItemTelefono($telefono);                    
                        $this->borrarItemTelefono($indice);
                        if(empty($this->listarTelefono())==false){
                            $data['array_telefonos'] = $this->listarTelefono();  
                        }
                    }                  
                }                
                
            }

        }


        $this->load->library('form_validation');
        $this->form_validation->set_rules('TxtNombres', '"Nombres"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtApePa', '"Apellido Paterno"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtApeMa', '"Apellidos Materno"', 'required|trim|callback_alpha_dash_space');

        $this->form_validation->set_rules('txtNroDocumento', '"Número de Documento"', 'required|is_natural_no_zero');                        
        $this->form_validation->set_rules('txtFecNaci', '"Fecha Nacimiento"', 'required|callback_valid_date');

        $this->form_validation->set_rules('fileReciboResidencia', '"Recibo de Servicios"', 'required|callback_cargar_archivo');
        $this->form_validation->set_rules('fileAntecedentePenales', '"Antecedente Penales"', 'required|callback_cargar_archivo');
        $this->form_validation->set_rules('fileAntecendentesPoliciales', '"Antecedentes Policiales"', 'required|callback_cargar_archivo');
        $this->form_validation->set_rules('fileDocumentoIdentidad', '"Documento Identidad"', 'required|callback_cargar_archivo');


        $this->form_validation->set_rules('cboDistrito', '"Distrito"', 'required|callback_distrito_no_elegido');
        $this->form_validation->set_rules('CboTipoDocumento', '"Tipo documento"', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('cboTipoGenero', '"Tipo género"', 'required|is_natural_no_zero');


        $this->form_validation->set_rules('cboOficios', '"Oficio"', 'required|is_natural_no_zero', array('is_natural_no_zero' => 'Debe seleccionar un Oficio.'));

        $this->form_validation->set_rules('txtEmail', '"Email"', 'required|valid_email');
        $this->form_validation->set_rules('txtDireccion', '"Dirección"', 'required');
        $this->form_validation->set_rules('FotoCarnet', '"Subir Archivo"', 'callback_cargar_archivo');


        $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
        $this->form_validation->set_message('alpha','El campo %s debe estar compuesto solo por letras.');
        $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto.');     
        $this->form_validation->set_message('alpha_dash_space','El campo %s debe estar compuesto solo por letras.');  
        $this->form_validation->set_message('is_natural_no_zero','El campo %s es un valor numérico.');  

        $this->load->model('ubigeo_model');
        $data['distritos']= $this->ubigeo_model->listDistritosLima();   

        $this->load->model('oficio_model');
        $data['oficios']= $this->oficio_model->listOficios();               


        if ($this->form_validation->run() == FALSE) {

            $data['guardado']=FALSE;
            $this->load->view('trabaja_con_nosotros',$data);   

        } else {
            $data['guardado']=TRUE;     
            $this->load->model('solicitud_trabajo_model');

            //$this->Solicitud_trabajo_model->insertar_Solicitud_Trabajo();  


            $nombres = $this->input->post('TxtNombres');	                
            $ApePa = $this->input->post('txtApePa');	
            $ApeMa = $this->input->post('txtApeMa');

            $tipoGenero = $this->input->post('cboTipoGenero');
            $tipoDocumento = $this->input->post('cboTipoDocumento');
            $tipoDistrito = $this->input->post('cboDistrito');
            $tipoOficio = $this->input->post('cboOficios');	  

            $direccion = $this->input->post('txtDireccion'); 
            $email = $this->input->post('txtEmail');	

            $telefono = $this->input->post('telefono');							

            $archivo_ReciboResidencia =  base64_encode( addslashes(file_get_contents($_FILES["fileReciboResidencia"]['tmp_name'])));	
            $archivo_AntecedentePenales = base64_encode( addslashes(file_get_contents($_FILES["fileAntecedentePenales"]['tmp_name'])));
            $archivo_AntecendentesPoliciales = base64_encode( addslashes(file_get_contents($_FILES["fileAntecendentesPoliciales"]['tmp_name'])));
            $archivo_DocumentoIdentidad = base64_encode( addslashes(file_get_contents($_FILES["fileDocumentoIdentidad"]['tmp_name'])));



            $data['guardado'] = $this->solicitud_trabajo_model->insertar_Solicitud_Trabajo(
                                $cboOficios,
                                $nombre_apellidos,
                                $email,
                                $telefono,
                                $direccion,
                                $descripcionUrgencia,
                                $cboDistrito,
                                $foto
            );

            $this->load->view('trabaja_con_nosotros',$data);

        }

    }        

    function alpha_dash_space($str)
    {
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;                     
    } 
        
        
        ///validacion de Distrito
    function distrito_no_elegido($str)
    {
        if($str != '0'){
            return TRUE;
         } else {
             $this->form_validation->set_message('distrito_no_elegido', 'Debe elegir un distrito');
             //Note: `set_message()` rule name (first argument) should not include the prefix "callback_"
             return FALSE;        
         }
    }         

    public function valid_date($date)
    {
       $format = 'Y-m-d';
       $d = DateTime::createFromFormat($format, $date);
       //Check for valid date in given format
       if($d && $d->format($format) == $date) {
          return true;
       } else {
         $this->form_validation->set_message('validación de fecha', 'El %s fecha no es un valor  como formato permitido ('.$format.') ');
            return false;
       }
    }     
  
    
    public function validar_telefono_check($telefono)
    {
        
       if(is_numeric($telefono)== true)
       {

            if(strlen(trim($telefono)) == 9) 
            {                
                if(substr($telefono,0,1)=="9")
                {
                    //echo "es celular y empieza con 9 // Y esto detecto como primer caracter: ".substr($telefono,0,1);
                    //echo "validatExistenciaTelefono_check: ".$this->validatExistenciaTelefono_check($telefono) ;
                    if($this->validatExistenciaTelefono_check($telefono) == TRUE)
                    {
                        //echo "caso celular// validatExistenciaTelefono_check: ".$this->validatExistenciaTelefono_check($telefono)."<br>" ;
                        $this->form_validation->set_message('validación de Télefono', 'El teléfono %s ya está referido.');
                        return FALSE;                        
                    }else{                        
                        return TRUE;
                    }
                    
                }else{
                    //echo "No es celular porque no empieza con 9 // Y esto detecto como primer caracter: ".substr($telefono,0,1);
                    $this->form_validation->set_message('validación de Télefono', 'El %s teléfono no corresponde a un celular: empieza por el dígito 9 y tiene 9 caracteres.');
                    return FALSE;
                }
            } else {
                
                if(strlen(trim($telefono)) == 7)
                {
                    if(substr($telefono,0,1)<>"9")
                    {
                        //echo "Es telefono de 7 digitos.";   
                        //echo "caso casa// validatExistenciaTelefono_check: ".$this->validatExistenciaTelefono_check($telefono)."<br>" ;
                        
                        if($this->validatExistenciaTelefono_check($telefono) == TRUE)
                        {
                            $this->form_validation->set_message('validación de Télefono', 'El teléfono %s ya está referido.');
                            return FALSE;                        
                        }else{                        
                            return TRUE;
                        }
                    
                    }else{
                        $this->form_validation->set_message('validación de Télefono', 'El %s teléfono no corresponde a un domicilio: no empieza por el dígito 9 y tiene 7 caracteres');
                        return FALSE;
                    }
                }
                
                $this->form_validation->set_message('validación de Télefono', 'El %s teléfono no tiene cantidad de digitos correctos.');
                return FALSE;
            }           
                      
       }else{
           //echo "No es telefono porque no es numerico.";
           $this->form_validation->set_message('validación de Télefono', 'El %s teléfono debe ser numérico.');
           return FALSE;
       }        
        

    }     
        
     function cargar_archivo() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '8000';
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        

        $this->load->library('upload', $config);
                        
        if ($this->upload->do_upload('foto')==FALSE) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            
            //echo "<br>".$config['upload_path'];
            //echo $this->upload->display_errors();
            
            $this->form_validation->set_message('foto', $data['uploadError'] );
            return FALSE;  
        }

        $data['uploadSuccess'] = $this->upload->data();
        return TRUE;            
                               
    }
    
    function agregarItemTelefono($telefono,$proveedor_fono)
    {
               
      $_SESSION['lista_telefonos'][][0] = $telefono;
      $_SESSION['lista_telefonos'][][1] = $proveedor_fono;         
//      return $_SESSION['lista_telefonos'];    

//      $arreglo=array();
//      if(empty($this->session->userdata('lista_telefonos'))==false){
//               $arreglo=$this->session->userdata('lista_telefonos');                
//      }      
//      return $arreglo;   
      return true;//$this->listarTelefono();
    }
    
    function listarTelefono()
    {
        //print_r($_SESSION['lista_telefonos']);
        //return $_SESSION['lista_telefonos']; 
        $arreglo=array();
        if(empty($this->session->userdata('lista_telefonos'))==false){            
            $arreglo=$this->session->userdata('lista_telefonos');               
        }
        
        return $arreglo; 
    }
    
    //verificar si existe telefono a agregar: retornará el indice si encuentra
    function existeItemTelefono($telefono){
       
        
        //foreach($_SESSION['lista_telefonos'] as $item_telefono=>$value_telefono)
        $arreglo = array();
        
        if(empty($this->listarTelefono())==false){
            $arreglo = $this->listarTelefono();
            
            foreach($arreglo as $item_telefono=>$value_telefono)
            {        
                if(empty($value_telefono[0])==false){
                    
                    if($telefono == $value_telefono[0])
                    {
                        return $item_telefono;
                    }                        
                    
                }
                            
            }                        
        }
        return -1;  
                
    }
    
    
    function validatExistenciaTelefono_check($telefono){
  
        $arreglo=array();        
        if(empty($this->listarTelefono())==false){
            
            $arreglo=$this->listarTelefono();
            foreach($arreglo as $item_telefono=>$value_telefono)
           {        
               if(empty($value_telefono[0])==false){
                   
                    if($telefono == $value_telefono[0])
                    {
                        //echo "validatExistenciaTelefono_check  bucle/value_telefono[0]".$value_telefono[0]."<br>";
                        return TRUE;
                    }                      
                }
           
           }             
           
        }

        return FALSE;      
        
    }    
    
    //Borrar telefono del temporal
    function borrarItemTelefono($x){
     
        if(empty($_SESSION['lista_telefonos'][$x])==false){ 
            unset($_SESSION['lista_telefonos'][$x]);        
            //array_values($_SESSION['lista_telefonos'][$x]);
            return true;
            
        }    

        return false;

    }    

    function resetListaTelefono(){
        $this->session->sess_destroy();
        return $this->session->userdata('lista_telefonos');
    }    

}

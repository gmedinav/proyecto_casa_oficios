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
                $data['poscionador'] =0;
                $data['guardado']=FALSE;                
                $this->resetListaTelefono();      
                //$thi->res
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
                
                $data['array_telefonos']=$this->listarTelefono();

                $data['array_oficios'] = $this->listarOficios();
                $data['array_tiempo_experiencia'] = $this->listarExperiencia();
                $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip();  
                    
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
        $data['poscionador'] =0;
        //echo "cargado de modelo y previo aray()<br>";
        if($this->input->post('btnAccionTelefono') == "Agregar")
        {
            $data['poscionador']=1;    
            $this->form_validation->set_rules('txtTelefono', '"Teléfono"', 'required|callback_validar_telefono_check');
            $this->form_validation->set_rules('cboProveedorTelf', '"Proveedor Telefónico"', 'required|is_natural_no_zero');
            
            $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
            $this->form_validation->set_message('is_natural_no_zero','Debe selecionar ítem.');  

            if ($this->form_validation->run() == FALSE) 
            {

                if(empty($this->listarTelefono())==false){                    
                    $data['array_telefonos'] = $this->listarTelefono();
                }
                    
                //echo $data['poscionador'];
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
                $data['poscionador']=1;
                
                if ($this->form_validation->run() == FALSE) 
                {
                    if(empty($this->listarTelefono())==false){
                        $data['array_telefonos'] = $this->listarTelefono();  
                    }                                        
                    //echo $data['poscionador'];
                    $this->load->view('trabaja_con_nosotros',$data);   
                    return;
                }else{
                    
                    $proveedor_fono = trim($this->input->post('lstTelefonoAgregados'));
                    $arreglo = explode("-", $proveedor_fono);        
                    
                    $telefono=$arreglo[1];
                    $indice=$arreglo[0];
                    
                    //Parte del Testing:
                    //
                    //echo "parámetros previo a existeItemTelefono(telefono):<br>";
                    //echo "telefono:".$telefono."<br>";
                    //echo "indice:".$indice."<br>";
                    //echo "existeItemTelefono(telefono):".$this->existeItemTelefono($telefono)."<br>";
                    
                    if($this->existeItemTelefono($telefono)!= -1)
                    {
                        //$indice=$this->existeItemTelefono($telefono);                    
                        $this->borrarItemTelefono($indice);
                        
                        if(empty($this->listarTelefono())==false){
                            $data['array_telefonos'] = $this->listarTelefono();  
                        }
                    }                  
                }                
                
            }

        }

        if($this->input->post('btnAccionOficio') == "Agregar")
        {
            $data['poscionador']=1;    
            
            $this->form_validation->set_rules('cboOficiDomin', '"Oficio"', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('cboPerioDomin', '"Periodo"', 'required|is_natural_no_zero');          
            $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
            $this->form_validation->set_message('is_natural_no_zero','Debe selecionar un ítem.');  

            if ($this->form_validation->run() == FALSE) 
            {

                if(empty($this->listarOficios())==false){       
                    
                    $data['array_oficios'] = $this->listarOficios();
                    $data['array_tiempo_experiencia'] = $this->listarExperiencia();
                    
                    $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                    $data['array_descrip_tipo_experiencia'] = $this->listarOficioExperienciaDescrip();
                }
                    
                //echo $data['poscionador'];
                $this->load->view('trabaja_con_nosotros',$data);   
                return;
            }else{
                
                $id_Oficio = $this->input->post('cboOficiDomin');
                $id_periodo = $this->input->post('cboPerioDomin');
               
                //$data['array_oficios'] =$this->agregarItemOficioExperiencia($id_Oficio, $id_periodo) ; 

                if($this->agregarItemOficioExperiencia($id_Oficio, $id_periodo)==true){                    
                    $data['array_oficios'] = $this->listarOficios();
                    $data['array_tiempo_experiencia'] = $this->listarExperiencia();
                    
                    $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                    $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip();     
                }                
            }
                                              
        }else{
            
            if($this->input->post('btnAccionOficio') == "Eliminar")
            {
                $this->form_validation->set_rules('lstOficioExperienciAgregados', '"Lista Oficios y experiencias"', 'required');
                $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
                $data['poscionador']=1;
                
                if ($this->form_validation->run() == FALSE) 
                {
                    if(empty($this->listarOficios())==false){
                        $data['array_oficios'] = $this->listarOficios();  
                        $data['array_tiempo_experiencia'] = $this->listarExperiencia();
                        
                        $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                        $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip(); 
                    }                                        
                    //echo $data['poscionador'];
                    $this->load->view('trabaja_con_nosotros',$data);   
                    return;
                }else{
                    
                    $lista_oficios_temp = trim($this->input->post('lstOficioExperienciAgregados'));
                    $arreglo = explode("-", $lista_oficios_temp);        
                    
                    $id_indice=$arreglo[0];
                    
                    $id_Oficio=$arreglo[1];
                    $id_periodo=$arreglo[2];
                    
                    //Parte del Testing:
                    //
                     
                    if($this->existeItemOficio($id_Oficio)!= -1)
                    {
                        //$indice=$this->existeItemTelefono($telefono);                    
                        $this->borrarItemOficios($id_Oficio);
                        
                        if(empty($this->listarOficios())==false){
                            $data['array_oficios'] = $this->listarOficios();  
                            $data['array_tiempo_experiencia'] = $this->listarExperiencia();
                            
                            $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                            $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip();                             
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
                        $this->form_validation->set_message('validar_telefono_check', 'El %s ya está referido.');
                        return FALSE;                        
                    }else{                        
                        return TRUE;
                    }
                    
                }else{
                    //echo "No es celular porque no empieza con 9 // Y esto detecto como primer caracter: ".substr($telefono,0,1);
                    $this->form_validation->set_message('validar_telefono_check', 'El %s no corresponde a un celular: empieza por el dígito 9 y tiene 9 caracteres.');
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
                            $this->form_validation->set_message('validar_telefono_check', 'El  %s ya está referido.');
                            return FALSE;                        
                        }else{                        
                            return TRUE;
                        }
                    
                    }else{
                        $this->form_validation->set_message('validar_telefono_check', 'El %s no corresponde a un domicilio: no empieza por el dígito 9 y tiene 7 caracteres');
                        return FALSE;
                    }
                }
                
                $this->form_validation->set_message('validar_telefono_check', 'El %s  no tiene cantidad de digitos correctos.');
                return FALSE;
            }           
                      
       }else{
           //echo "No es telefono porque no es numerico.";
           $this->form_validation->set_message('validar_telefono_check', 'El %s debe ser numérico.');
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
               
      $_SESSION['lista_telefonos'][] = $telefono;
      $_SESSION['proveedor_telefonico'][] = $proveedor_fono;         
   
      return true;
    }
    
    function listarTelefono()
    {
        $arreglo=array();
        if(empty($this->session->userdata('lista_telefonos'))==false){            
            $arreglo = $this->session->userdata('lista_telefonos');               
        }        
        return $arreglo; 
    }
    
    function listarProveedorTelefonico()
    {
        $arreglo=array();
        if(empty($this->session->userdata('proveedor_telefonico'))==false){            
            $arreglo = $this->session->userdata('proveedor_telefonico');               
        }        
        return $arreglo; 
    }    
    
    //verificar si existe telefono a agregar: retornará el indice si encuentra
    function existeItemTelefono($telefono){               

        $arreglo = array();        
        if(empty($this->listarTelefono())==false){
            
            $arreglo = $this->listarTelefono();            
            foreach($arreglo as $item_telefono=>$value_telefono)
            {        
                if(empty($value_telefono)==false){
                    
                    if($telefono == $value_telefono)
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
                //echo $value_telefono
               if(empty($value_telefono)==false){
                   
                    if($telefono == $value_telefono)
                    {
                        return TRUE;
                    }                      
                }           
           }             
           
        }

        return FALSE;              
    }    
    
    //Borrar telefono del temporal
    function borrarItemTelefono($x){
     
        //echo "previo a borrar<br>";
        //echo "borrarItemTelefono: (".$x.")";
        if(empty($_SESSION['lista_telefonos'][$x])==false){ 
            
           //echo "es_array: ". is_array($_SESSION['lista_telefonos'][$x]);
            unset($_SESSION['lista_telefonos'][$x]);    
            unset($_SESSION['proveedor_telefonico'][$x]);      
            
            $_SESSION['lista_telefonos'] = array_values($_SESSION['lista_telefonos']);
            $_SESSION['proveedor_telefonico'] = array_values($_SESSION['proveedor_telefonico']);
            return true;
            
        }    
        return false;
    }    

    function resetListaTelefono(){
        $this->session->sess_destroy();
        return $this->session->userdata('lista_telefonos');
    }    

    
    
    function agregarItemOficioExperiencia($id_Oficio,$id_periodo)
    {

      $this->load->model('oficio_model');                    
      $this->load->model('tipo_experiencia_model');
                
      $_SESSION['oficio_experiencia'][] = $id_Oficio;
      $_SESSION['id_periodo_experiencia'][] = $id_periodo;
      
      $temp1= $this->tipo_experiencia_model->instanciaPeriodoExperiencia($id_periodo) ;
      $_SESSION['descrip_periodo_experiencia'][] = $temp1["DES_TIPO_MAESTRO"];

      $temp2= $this->oficio_model->instanciaOficios($id_Oficio);
      $_SESSION['descrip_oficio_experiencia'][] = $temp2["DES_OFICIO"];
      return true;
    }

    function borrarItemOficios($x){
     
        if(empty($_SESSION['oficio_experiencia'][$x])==false){ 
            
           //echo "es_array: ". is_array($_SESSION['lista_telefonos'][$x]);
            unset($_SESSION['oficio_experiencia'][$x]);    
            unset($_SESSION['id_periodo_experiencia'][$x]);      
            
            unset($_SESSION['descrip_periodo_experiencia'][$x]) ;
            unset($_SESSION['descrip_oficio_experiencia'][$x]);
      
            $_SESSION['oficio_experiencia'] = array_values($_SESSION['oficio_experiencia']);
            $_SESSION['id_periodo_experiencia'] = array_values($_SESSION['id_periodo_experiencia']);

            $_SESSION['descrip_periodo_experiencia'] = array_values($_SESSION['descrip_periodo_experiencia']);
            $_SESSION['descrip_oficio_experiencia'] = array_values($_SESSION['descrip_oficio_experiencia']);
            
            return true;
            
        }    
        return false;
    }     

    function resetListaOficiosExperimentados(){
        $this->session->sess_destroy();
        return $this->session->userdata('oficio_experiencia');
        
    }    
    
    function listarOficios()
    {
        $arreglo=array();
        if(empty($this->session->userdata('oficio_experiencia'))==false){            
            $arreglo = $this->session->userdata('oficio_experiencia');               
        }        
        return $arreglo; 
    }    
    
    function listarExperiencia()
    {
        $arreglo=array();
        if(empty($this->session->userdata('id_periodo_experiencia'))==false){            
            $arreglo = $this->session->userdata('id_periodo_experiencia');               
        }        
        return $arreglo; 
    }      

    function listarPeriodoExperienciaDescrip()
    {
        $arreglo=array();
        if(empty($this->session->userdata('descrip_periodo_experiencia'))==false){            
            $arreglo = $this->session->userdata('descrip_periodo_experiencia');               
        }        
        return $arreglo; 
    }      
    
    
    function listarOficioExperienciaDescrip()
    {
        $arreglo=array();
        if(empty($this->session->userdata('descrip_oficio_experiencia'))==false){            
            $arreglo = $this->session->userdata('descrip_oficio_experiencia');               
        }        
        return $arreglo; 
    } 
    
    
    function existeItemOficio($id_oficio){               

        $arreglo = array();        
        if(empty($this->listarOficios())==false){
            
            $arreglo = $this->listarOficios();            
            foreach($arreglo as $item=>$value)
            {        
                if(empty($value)==false){
                    
                    if($id_oficio == $value)
                    {
                        return $item;
                    }                        
                    
                }
                            
            }                        
        }
        return -1;  
                
    }    
    

    function validatExistenciaOficio_check($id_oficio){
  
        $arreglo=array();        
        if(empty($this->listarExperiencia())==false){
            
           $arreglo=$this->listarExperiencia();
           foreach($arreglo as $item=>$value_experiencia)
           {        
               if(empty($value_experiencia)==false){
                   
                    if($id_oficio == $value_experiencia)
                    {
                        return TRUE;
                    }                      
                }           
           }             
           
        }

        return FALSE;              
    }    
        
    
}

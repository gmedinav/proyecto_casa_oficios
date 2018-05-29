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
            $this->load->helper('file');
    }   


    public function index()
    {
        $data['poscionador'] =0;
        $data['guardado']=FALSE;                
        $this->resetListaTelefono();      
                //$thi->res
        $this->load->model('entidad_negocio/ubigeo_model');
        $data['distritos']= $this->ubigeo_model->listDistritosLima();                 
        $this->load->model('entidad_negocio/oficio_model');
        $data['oficios']= $this->oficio_model->listOficios();                  
        $this->load->model('entidad_negocio/tipo_sexo_model');
        $data['sexos']= $this->tipo_sexo_model->listTipoSexo();                        
        $this->load->model('entidad_negocio/tipo_operadora_model');
        $data['operadoras']= $this->tipo_operadora_model->listTipoOperadora();                     
        $this->load->model('entidad_negocio/tipo_documento_model');
        $data['documentos']= $this->tipo_documento_model->listTipoDocumentos();                        
        $this->load->model('entidad_negocio/tipo_experiencia_model');
        $data['experiencias']= $this->tipo_experiencia_model->listPeriodoExperiencia();                  
                
        $data['array_telefonos']=$this->listarTelefono();
        $data['array_oficios'] = $this->listarOficios();
        $data['array_tiempo_experiencia'] = $this->listarExperiencia();
        $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
        $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip();  

        $data['tab']=1;
                    
        $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
    }
        
    public function formulario()
    {
        $this->load->library('session');
        $data['guardado']=FALSE;
        $this->load->model('entidad_negocio/ubigeo_model');
        $data['distritos']= $this->ubigeo_model->listDistritosLima(); 
        $this->load->model('entidad_negocio/oficio_model');
        $data['oficios']= $this->oficio_model->listOficios();  
        $this->load->model('entidad_negocio/tipo_sexo_model');
        $data['sexos']= $this->tipo_sexo_model->listTipoSexo();        
        $this->load->model('entidad_negocio/tipo_operadora_model');
        $data['operadoras']= $this->tipo_operadora_model->listTipoOperadora();     
        $this->load->model('entidad_negocio/tipo_documento_model');
        $data['documentos']= $this->tipo_documento_model->listTipoDocumentos();        
        $this->load->model('entidad_negocio/tipo_experiencia_model');
        $data['experiencias']= $this->tipo_experiencia_model->listPeriodoExperiencia();              
        $data['array_telefonos'] = array();
        $data['array_oficios'] = array();
        $data['array_tiempo_experiencia'] = array();
        
        $data['array_descrip_tiempo_experiencia'] = array();
        $data['array_descrip_tipo_experiencia'] = array();        
        
        
        $data['array_oficios'] = $this->listarOficios();
        $data['array_tiempo_experiencia'] = $this->listarExperiencia();
        $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
        $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip();                             
        
        $data['poscionador'] =0;
        //echo "cargado de modelo y previo aray()<br>";    
        
        if(empty($this->listarTelefono())==false){                    
            $data['array_telefonos'] = $this->listarTelefono();                    
        }
        //echo $data['poscionador'];
        $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
        $data['array_descrip_tipo_experiencia'] = $this->listarOficioExperienciaDescrip();          

        $this->form_validation->set_rules('TxtNombres', '"Nombres"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtApePa', '"Apellido Paterno"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtApeMa', '"Apellidos Materno"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtNroDocumento', '"Número de Documento"', 'required|is_natural_no_zero|callback_validar_existencia_nro_documento');                        
        $this->form_validation->set_rules('txtFecNaci', '"Fecha Nacimiento"', 'required|callback_valid_date|callback_validar_mayor_edad');        
        $data['tab']=1;

        if($this->input->post('btnAccionTelefono') == "Agregar")
        {
            $data['poscionador']=1;    
            $this->form_validation->set_rules('txtTelefono', '"Teléfono"', 'trim|callback_validar_telefono_check|callback_validar_existencia_fono');
            $this->form_validation->set_rules('cboProveedorTelf', '"Proveedor Telefónico"', 'required|is_natural_no_zero');
            
            $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
            $this->form_validation->set_message('is_natural_no_zero','Debe selecionar ítem.');  

            if ($this->form_validation->run() == FALSE) 
            {
                if(empty($this->listarTelefono())==false){                    
                    $data['array_telefonos'] = $this->listarTelefono();                    
                }
                    
                $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                $data['array_descrip_tipo_experiencia'] = $this->listarOficioExperienciaDescrip();  

                $data['tab']=2;
                
                $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                return;

            }else{
                
                $telefono = $this->input->post('txtTelefono');
                $proveedor_fono = $this->input->post('cboProveedorTelf');
               
                $data['array_telefonos'] = $this->agregarItemTelefono($telefono,$proveedor_fono);
                if(empty($this->listarTelefono())==false){                    
                    $data['array_telefonos'] = $this->listarTelefono();
                }  

                $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                $data['array_descrip_tipo_experiencia'] = $this->listarOficioExperienciaDescrip();  
                $data['tab']=2;
                
                $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                return;

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
                    $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                    $data['array_descrip_tipo_experiencia'] = $this->listarOficioExperienciaDescrip();
                    $data['tab']=2;
                    
                    $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                    return;

                }else{
                    
                    $indice = trim($this->input->post('lstTelefonoAgregados'));
                    
                    $this->borrarItemTelefono($indice);
                        
                    if(empty($this->listarTelefono())==false){
                            $data['array_telefonos'] = $this->listarTelefono();  
                    }
                    $data['tab']=2;

                    $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                    $data['array_descrip_tipo_experiencia'] = $this->listarOficioExperienciaDescrip();  
                    
                    $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                    return;                    
                
                }                
                
            }
        }


        if($this->input->post('btnAccionOficio') == "Agregar")
        {
            $data['poscionador']=1;    
            
            $this->form_validation->set_rules('cboOficiDomin', '"Oficio"', 'required|is_natural_no_zero|callback_validar_id_Oficio_check');
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
                $data['array_telefonos'] = $this->listarTelefono();
                $data['tab']=3;
                $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
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

                $data['array_telefonos'] = $this->listarTelefono();
                $data['tab']=3;
                $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                return;


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
                    $data['tab']=3;
                    $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                    return;
                }else{
                    
                    $lista_oficios_temp = trim($this->input->post('lstOficioExperienciAgregados'));
                    $arreglo = explode("-", $lista_oficios_temp);        
                    
                    $id_indice=$arreglo[0];
                    
                    $id_Oficio=$arreglo[1];
                    $id_periodo=$arreglo[2];
                    

                    if($this->existeItemOficio($id_Oficio)!= -1)
                    {
                        //$indice=$this->existeItemTelefono($telefono);                    
                        $this->borrarItemOficios($id_indice);
                        
                        //if(empty($this->listarOficios())==false){
                            $data['array_oficios'] = $this->listarOficios();  
                            $data['array_tiempo_experiencia'] = $this->listarExperiencia();
                            
                            $data['array_descrip_tiempo_experiencia'] = $this->listarPeriodoExperienciaDescrip();
                            $data['array_descrip_oficio_experiencia'] = $this->listarOficioExperienciaDescrip();                             
                        //}
                    }        
                    $data['array_telefonos'] = $this->listarTelefono();
                    $data['tab']=3;
                    $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
                    return;
          
                }                
                
            }
        }
     
        #$this->load->library('form_validation');
        $data['tab']=1;
        $this->form_validation->reset_validation();

        
        $this->form_validation->set_rules('TxtNombres', '"Nombres"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtApePa', '"Apellido Paterno"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtApeMa', '"Apellidos Materno"', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('txtNroDocumento', '"Número de Documento"', 'required|is_natural_no_zero|callback_validar_existencia_nro_documento');                        
        $this->form_validation->set_rules('txtFecNaci', '"Fecha Nacimiento"', 'required|callback_valid_date|callback_validar_mayor_edad');

        $this->form_validation->set_rules('fileReciboResidencia', '"Recibo de Servicios"', 'callback_cargar_archivo_fileReciboResidencia');
        $this->form_validation->set_rules('fileAntecedentePenales', '"Antecedente Penales"', 'callback_cargar_archivo_fileAntecedentePenales');
        $this->form_validation->set_rules('fileAntecendentesPoliciales', '"Antecedentes Policiales"', 'callback_cargar_archivo_fileAntecendentesPoliciales');
        $this->form_validation->set_rules('fileDocumentoIdentidad', '"Documento Identidad"', 'callback_cargar_archivo_fileDocumentoIdentidad');
        $this->form_validation->set_rules('FotoCarnet', '"Foto Carnet"', "callback_cargar_archivo_FotoCarnet"); #cargar_archivo_FotoCarnet

        $this->form_validation->set_rules('cboDistrito', '"Distrito"', 'required|callback_distrito_no_elegido');

        
        $this->form_validation->set_rules('CboTipoDocumento', '"Tipo documento"', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('cboTipoGenero', '"Tipo género"', 'required|is_natural_no_zero');
        #$this->form_validation->set_rules('cboOficios', '"Oficio"', 'required|is_natural_no_zero', array('is_natural_no_zero' => 'Debe seleccionar un Oficio.'));
        $this->form_validation->set_rules('txtEmail', '"Email"', 'required|valid_email|callback_validar_existencia_email');
        $this->form_validation->set_rules('txtDireccion', '"Dirección"', 'required');

        $this->form_validation->set_rules('cboOficiosPreferencial', '"Oficios Preferencial"', 'required|is_natural');
        $this->form_validation->set_rules('cboCompaniaPrincipal', '"Teléfono Principal"', 'required|is_natural');


        $this->form_validation->set_message('required','El campo %s es obligatorio.'); 
        $this->form_validation->set_message('alpha','El campo %s debe estar compuesto solo por letras.');
        $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto.');     
        $this->form_validation->set_message('alpha_dash_space','El campo %s debe estar compuesto solo por letras.');  
        $this->form_validation->set_message('is_natural_no_zero','El campo %s es un valor numérico.');  
        $this->form_validation->set_message('is_natural','Debe seleccionar algún ítem en el campo %s.');  


        $this->load->model('entidad_negocio/ubigeo_model');
        $data['distritos']= $this->ubigeo_model->listDistritosLima();   
        $this->load->model('entidad_negocio/oficio_model');
        $data['oficios']= $this->oficio_model->listOficios();   


        if ($this->form_validation->run() == FALSE) {

            $data['guardado']=FALSE;
            //echo "no pasó por form_validation";
            $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   

        } else {

            #echo "sí pasó";
            $data['guardado']=TRUE;     
            $this->load->model('entidad_negocio/tmrh');

            $insertar_tmrh['NOM_TMRH']              = $this->input->post('TxtNombres'); 
            $insertar_tmrh['APE_PATERNO']           = $this->input->post('txtApePa');   
            $insertar_tmrh['APE_MATERNO']           = $this->input->post('txtApeMa');
            $insertar_tmrh['EMAIL']                 = $this->input->post('txtEmail');
            $insertar_tmrh['COD_TIPO_DOCUMENTO']    = $this->input->post('CboTipoDocumento');
            $insertar_tmrh['NUM_DOCUMENTO']         = $this->input->post('txtNroDocumento');
            $insertar_tmrh['COD_TIPO_GENERO']       = $this->input->post('cboTipoGenero');
            $insertar_tmrh['COD_UBIGEO']            = $this->input->post('cboDistrito');
            $insertar_tmrh['DIRECCION']             = $this->input->post('txtDireccion'); 
            $insertar_tmrh['FEC_NACIMIENTO']        = $this->input->post('txtFecNaci'); 
            
            $lst_oficio_principal                   = $this->listarOficios();

            $i_telefono                             = $this->retornarTelefono($this->input->post('cboCompaniaPrincipal'));
            $i_oficio                               = $this->retornarOficio($this->input->post('cboOficiosPreferencial'));
            
            //$insertar_tmrh['COD_OFICIO_PRINCIPAL']      = $lst_oficio_principal[$this->input->post('cboOficiosPreferencial')];
            
            $insertar_tmrh['COD_OFICIO_PRINCIPAL']      = $i_oficio['id_oficio_experiencia'];
            $insertar_tmrh['COD_TIEMPO_EXPERIENCIA']    = $i_oficio['id_periodo_experiencia'];

            $insertar_tmrh['NUM_CELU']                  = $i_telefono['telefono'];
            $insertar_tmrh['COD_TIPO_OPERADORA']        = $i_telefono['id_proveedor'];

            $this->db->trans_begin();
            
            $data['guardado'] = $this->tmrh->guardar_Instancia($insertar_tmrh);
            
            #echo "rpta insercion: ".$data['guardado'];
            
            if($data['guardado'] != 0){
                
                $ultimo_id = $this->db->insert_id();
                                
                //recorrer el bucle de de array session de fonos        
                $this->load->model('entidad_negocio/tmrh_telefono_adjunto_model');
                
                $array_fonos= $this->listarTelefono();
                #$array_proveedor= $this->listarProveedorTelefonico();                                
                
                foreach($array_fonos as $key=>$value){                    
                        
                    $instancia['COD_TMRH'] = $ultimo_id;
                    $instancia['COD_TIPO_OPERADORA'] = $value['id_proveedor'];#$array_proveedor[$key];
                    $instancia['TELEFONO'] = $value['telefono'];#$value;
                                                            
                    $this->tmrh_telefono_adjunto_model->guardar_Instancia($instancia);                     
                    unset($instancia);
                }
                
               #inicio Ya no se guardara archivos adjuntos
                /*$this->load->model('Tmrh_documento_adjunto_model');
                
                $array_files[1] = $_FILES["FotoCarnet"];                 
                $array_files[2] = $_FILES["fileDocumentoIdentidad"];
                $array_files[3] = $_FILES["fileReciboResidencia"];
                $array_files[5] = $_FILES["fileAntecedentePenales"];
                $array_files[6] = $_FILES["fileAntecendentesPoliciales"];
                        
                foreach($array_files as $key=>$value){                    
                        
                    $instancia['COD_TMRH']              = $ultimo_id;
                    $instancia['COD_TIPO_ADJUNTO_TMRH'] = $key;
                    $instancia['DESCRIPCION']           = $value['name'];
                    $instancia['IMAGEN']                = base64_encode( addslashes(file_get_contents($value['tmp_name'])));
                    $instancia['LENGHT_D']              = $value['size'];
                                                            
                    //$this->Tmrh_documento_adjunto_model->guardar_Instancia($instancia);                     
                    //unset($instancia);
                }    
                */
                   unset($instancia);
                
               #fin
                
             
                
                
                //recorrer el bucle de  array session de Oficios  
                $array_id_oficios = $this->listarOficios();
                $array_id_experiencia= $this->listarExperiencia();
                
                
                $this->load->model('entidad_negocio/tmrh_oficios_extra_model');
                foreach($array_id_oficios as $key=>$value){                    
                                                               
                    $instancia['COD_TMRH'] = $ultimo_id;
                    $instancia['COD_OFICIO']= $value;
                    #$instancia['COD_USUARIO_REGISTRO']                    
                    $instancia['COD_TIEMPO_EXPERIENCIA'] = $array_id_experiencia[$key];
                    
                    $this->tmrh_oficios_extra_model->guardar_Instancia($instancia);                     
                    unset($instancia);
                }                                                                
                
            }      
           if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

            $data['tab']=1;
            $this->load->view('web_public/vw_trabaja_con_nosotros',$data);   
        }
    }        




    public function agregar_imagenes_tmp($arreglo){

      $_SESSION['matriz_archivos'][]= $arreglo;
      return true;

    }

    public function borrar_imagenes_tmp($x){    

        if(empty($_SESSION['matriz_archivos'][$x])==false){             
            unset($_SESSION['matriz_archivos'][$x]);    
            return true;            
        }   
        return false;

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
         $this->form_validation->set_message('valid_date', 'El %s fecha no es un valor  como formato permitido ('.$format.') ');
            return false;
       }
    }     
  


    public function validar_mayor_edad($fec_nacimiento){

        $date1 = new DateTime($fec_nacimiento);
        $date2 = new DateTime();//new DateTime("2009-06-26");
        $interval = $date1->diff($date2);
        //echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";

        $periodo = $interval->y;
        #echo "periodo: $periodo";

        if($periodo >18){
            return true;
        }else{

            $this->form_validation->set_message('validar_mayor_edad', 'Ud. debe contar con más de 18 años.');
            return false;

        }

    }

    public function validar_existencia_fono($telefono){

        $this->load->model('entidad_negocio/tmrh_telefono_adjunto_model');
        $fonos = $this->tmrh_telefono_adjunto_model->buscar_telefono_registrado($telefono);

        foreach ($fonos as $key => $value) {            
            $this->form_validation->set_message('validar_existencia_fono', 'Este teléfono ya está registrado.');
            return false;
        }
        return true;

    }


    public function validar_existencia_nro_documento($nro_documento){

        $this->load->model('entidad_negocio/tmrh');
        $nro_docs = $this->tmrh->buscar_documento_identidad($nro_documento);

        foreach ($nro_docs as $key => $value) {            
            $this->form_validation->set_message('validar_existencia_nro_documento', 'Este número de documento ya está registrado.');
            return false;

        }
        return true;

    }    

    public function validar_existencia_email($email){

        $this->load->model('entidad_negocio/tmrh');
        $mails = $this->tmrh->buscar_email($email);

        foreach ($mails as $key => $value) {            
            $this->form_validation->set_message('validar_existencia_email', 'Este correo electrónico ya está registrado.');
            return false;
        }
        return true;
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
                    if($this->validatExistenciaTelefono_check($telefono) == 1)
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
                        
                        if($this->validatExistenciaTelefono_check($telefono) == 1)
                        {

                            $this->form_validation->set_message('validar_telefono_check', 'El %s ya está referido.');                            
                            return false;   

                        }else{           


                            return true;
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
        
    
    public function validar_id_Oficio_check($id_oficio)
    {  
        if($this->validatExistenciaOficio_check($id_oficio) == TRUE){            
           $this->form_validation->set_message('validar_id_Oficio_check', 'El %s ya está registrado el oficio.');
           return FALSE;           
        }        
        return TRUE;        
    }    
    
        public function upload_image($str,$nombre_input)
        {
            $config['upload_path'] = realpath(APPPATH ."\upload");    
            #$config['max_size'] = 1024 * 10;
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if(isset($_FILES[$nombre_input]) && !empty($_FILES[$nombre_input]['name']))
            {
                if($this->upload->do_upload($nombre_input))
                {
                    #$upload_data = $this->upload->data();
                    #$_POST[$nombre_input] = $upload_data['file_name'];
                    return TRUE;
                }
                else
                {
                    $this->form_validation->set_message('upload_image', $this->upload->display_errors());
                    return FALSE;
                }
            }
            else
            {
                $_POST[$nombre_input] = NULL;
                $this->form_validation->set_message('upload_image', $this->upload->display_errors());
                return FALSE;
            }
        }
    
#5137900- Oncosalud
    
    public function cargar_archivo_FotoCarnet() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '2097152';
        #$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        
       $this->load->library('upload', $config);     
         
       if(isset($_FILES['FotoCarnet']['name']) && $_FILES['FotoCarnet']['name']!=""){ 
            if ($_FILES['FotoCarnet']['size'] > $config['max_size'] ) {
                
                $this->form_validation->set_message('cargar_archivo_FotoCarnet', 'Verifique el peso del archivo.');
                return FALSE;  
            }else{
                $upload_project_thum = $_FILES['FotoCarnet']['name'];
                $upload_project_thum_ext = substr($upload_project_thum, strrpos($upload_project_thum, '.') + 1);                   
                $upload_permitted_types['mime']= array('image/jpeg','image/gif','image/png');
                $upload_permitted_types['ext']= array('jpeg','jpg','gif','png');
                if(!in_array($_FILES['FotoCarnet']['type'],$upload_permitted_types['mime']) || !in_array($upload_project_thum_ext,$upload_permitted_types['ext']))
                {
                    $this->form_validation->set_message('cargar_archivo_FotoCarnet', 'Verifique el peso del archivo.');
                    return FALSE;  
                }else{
                    return TRUE;
                }
            }     
            /*
            if ($this->upload->do_upload('FotoCarnet')==FALSE) {
               
                $this->form_validation->set_message('cargar_archivo_FotoCarnet', 'Verifique el formato del archivo.');
                return FALSE;  
            }else{
                return TRUE;                    
            }*/
                        
        }else{            
                $this->form_validation->set_message('cargar_archivo_FotoCarnet', 'No ha seleccionado ningún archivo.' );
                return FALSE;                          
        }
                                       
    }
     public function cargar_archivo_fileDocumentoIdentidad() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '2097152';
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        
        $this->load->library('upload', $config);    
             
         
       if(isset($_FILES['fileDocumentoIdentidad']['name']) && $_FILES['fileDocumentoIdentidad']['name']!=""){ 
            if ($_FILES['fileDocumentoIdentidad']['size'] > $config['max_size'] ) {
                    
                $this->form_validation->set_message('cargar_archivo_fileDocumentoIdentidad', 'Verifique el peso del archivo.');
                return FALSE;  
            
            } else{
                $upload_project_thum = $_FILES['fileDocumentoIdentidad']['name'];
                $upload_project_thum_ext = substr($upload_project_thum, strrpos($upload_project_thum, '.') + 1);     
                $upload_permitted_types['mime']= array('image/jpeg','image/gif','image/png');
                $upload_permitted_types['ext']= array('jpeg','jpg','gif','png');
                if(!in_array($_FILES['fileDocumentoIdentidad']['type'],$upload_permitted_types['mime']) || !in_array($upload_project_thum_ext,$upload_permitted_types['ext']))
                {
                    $this->form_validation->set_message('cargar_archivo_fileDocumentoIdentidad', 'Verifique el peso del archivo.');
                    return FALSE;  
                }else{
                    return TRUE;
                }
            }
   
        }else{       
            $this->form_validation->set_message('cargar_archivo_fileDocumentoIdentidad', 'No ha seleccionado ningún archivo.' );
            return FALSE;                          
        }      
                               
    }    
    
     public function cargar_archivo_fileReciboResidencia() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '2097152';
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        
        $this->load->library('upload', $config);     
         
       if(isset($_FILES['fileReciboResidencia']['name']) && $_FILES['fileReciboResidencia']['name']!=""){ 
            if ($_FILES['fileReciboResidencia']['size'] > $config['max_size'] ) {
                
                $this->form_validation->set_message('cargar_archivo_fileReciboResidencia', 'Verifique el peso del archivo.');
                return FALSE;  
            }else{
                $upload_project_thum = $_FILES['fileReciboResidencia']['name'];
                $upload_project_thum_ext = substr($upload_project_thum, strrpos($upload_project_thum, '.') + 1);   
                $upload_permitted_types['mime']= array('image/jpeg','image/gif','image/png');
                $upload_permitted_types['ext']= array('jpeg','jpg','gif','png');
                if(!in_array($_FILES['fileReciboResidencia']['type'],$upload_permitted_types['mime']) || !in_array($upload_project_thum_ext,$upload_permitted_types['ext']))
                {
                    $this->form_validation->set_message('cargar_archivo_fileReciboResidencia', 'Verifique el formato del archivo.');
                    return FALSE;  
                }else{
                    return TRUE;
                }
            }
                        
        }else{            
                $this->form_validation->set_message('cargar_archivo_fileReciboResidencia', 'No ha seleccionado ningún archivo.' );
                return FALSE;                          
        }             
                               
    }     
    
     public function cargar_archivo_fileAntecedentePenales() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '2097152';
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        
        $this->load->library('upload', $config);    
         
       if(isset($_FILES['fileAntecedentePenales']['name']) && $_FILES['fileAntecedentePenales']['name']!=""){ 
        
            if ($_FILES['fileAntecedentePenales']['size'] > $config['max_size'] ) {                
                $this->form_validation->set_message('cargar_archivo_fileAntecedentePenales', 'Verifique el peso del archivo.');
                return FALSE;              
            }else{
                $upload_project_thum = $_FILES['fileAntecedentePenales']['name'];
                $upload_project_thum_ext = substr($upload_project_thum, strrpos($upload_project_thum, '.') + 1);   
                $upload_permitted_types['mime']= array('image/jpeg','image/gif','image/png');
                $upload_permitted_types['ext']= array('jpeg','jpg','gif','png');
                if(!in_array($_FILES['fileAntecedentePenales']['type'],$upload_permitted_types['mime']) || !in_array($upload_project_thum_ext,$upload_permitted_types['ext']))
                {
                    $this->form_validation->set_message('cargar_archivo_fileAntecedentePenales', 'Verifique el formato del archivo.');
                    return FALSE;  
                }else{
                    return TRUE;
                }
            }
                        
        }else{            
                $this->form_validation->set_message('cargar_archivo_fileAntecedentePenales', 'No ha seleccionado ningún archivo.' );
                return FALSE;                          
        } 
        
    }      
    
     public function cargar_archivo_fileAntecendentesPoliciales() {
           
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '2097152';
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        
        $this->load->library('upload', $config);     
         
       if(isset($_FILES['fileAntecendentesPoliciales']['name']) && $_FILES['fileAntecendentesPoliciales']['name']!=""){ 
            if ($_FILES['fileAntecendentesPoliciales']['size'] > $config['max_size'] ) {                
                $this->form_validation->set_message('cargar_archivo_fileAntecendentesPoliciales', 'Verifique el peso del archivo.');
                return FALSE;              
            }else{
                $upload_project_thum = $_FILES['fileAntecendentesPoliciales']['name'];
                $upload_project_thum_ext = substr($upload_project_thum, strrpos($upload_project_thum, '.') + 1);   
                $upload_permitted_types['mime']= array('image/jpeg','image/gif','image/png');
                $upload_permitted_types['ext']= array('jpeg','jpg','gif','png');
                if(!in_array($_FILES['fileAntecendentesPoliciales']['type'],$upload_permitted_types['mime']) || !in_array($upload_project_thum_ext,$upload_permitted_types['ext']))
                {
                    $this->form_validation->set_message('cargar_archivo_fileAntecendentesPoliciales', 'Verifique el formato del archivo.');
                    return FALSE;  
                }else{
                    return TRUE;
                }
            }
                        
        }else{            
                $this->form_validation->set_message('cargar_archivo_fileAntecendentesPoliciales', 'No ha seleccionado ningún archivo.' );
                return FALSE;                          
        } 
    }        
    
    public function file_check($str, $input_file){
        
 
        $config['upload_path']          = realpath(APPPATH ."\upload");        
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '2097152';

        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        
        $this->load->library('upload', $config);     
         
       if(isset($_FILES[$input_file]) && $_FILES[$input_file]['name']!=""){ 

            if ($_FILES[$input_file]['size'] > $config['max_size'] ) {     

                $this->form_validation->set_message('file_check', 'Verifique el peso del archivo del campo %s.');
                return FALSE; 

            }else{

                $upload_project_thum = $_FILES[$input_file]['name'];
                $upload_project_thum_ext = substr($upload_project_thum, strrpos($upload_project_thum, '.') + 1);   
                $upload_permitted_types['mime']= array('image/jpeg','image/gif','image/png');
                $upload_permitted_types['ext']= array('jpeg','jpg','gif','png');

                if(!in_array($_FILES[$input_file]['type'],$upload_permitted_types['mime']) || !in_array($upload_project_thum_ext,$upload_permitted_types['ext']))
                {
                    $this->form_validation->set_message('file_check', 'Verifique el formato del archivo del campo %s.');
                    return FALSE;  
                }else{
                    return TRUE;
                }
            }
                        
        }else{    

                $this->form_validation->set_message('file_check', 'No ha seleccionado ningún archivo del campo %s.' );
                return FALSE;                          
        } 


    }    
    
    
    public function agregarItemTelefono($telefono,$proveedor_fono)
    {  

      $arreglo['telefono']=  $telefono;
      $arreglo['id_proveedor']=  $proveedor_fono;

      $_SESSION['matriz_telefonico'][]= $arreglo;

      return true;
    }
    
    public function listarTelefono()
    {
        if(empty($_SESSION['matriz_telefonico'])==false || isset($_SESSION['matriz_telefonico'])){
            return $_SESSION['matriz_telefonico'];
        }
        return false;

    }


    public function retornarTelefono($x)
    {

        if(empty($_SESSION['matriz_telefonico'])==false || isset($_SESSION['matriz_telefonico'])){
            return $_SESSION['matriz_telefonico'][$x];
        }
        return false;

    }


    #public function listarProveedorTelefonico()
    #{
    #    $arreglo=array();
    #    if(empty($this->session->userdata('matriz_telefonico'))==false){            
    #        $arreglo = $this->session->userdata('matriz_telefonico');               
    #    }        
    #    return $arreglo; 
    #}    
    
    //verificar si existe telefono a agregar: retornará el indice si encuentra
    public function existeItemTelefono($telefono){ 

        $arreglo = array();        
        if(empty($this->listarTelefono())==false){            
            $arreglo = $this->listarTelefono();            
            foreach($arreglo as $item_telefono=>$value_telefono)
            {        
                if(empty($value_telefono['telefono'])==false){                    
                    if($telefono == $value_telefono['telefono'])
                    {
                        return $item_telefono;
                    }                                            
                }                            
            }                        
        }
        return -1;
    }
    
    
   public function validatExistenciaTelefono_check($telefono){
  
        if(empty($this->listarTelefono())== false){            
           #$arreglo=$this->listarTelefono();
           foreach($this->listarTelefono() as $item_telefono=>$value_telefono)
           {                  
               if(empty($value_telefono['telefono'])== false){                   
                    if(trim($telefono) == $value_telefono['telefono'])
                    {
                        return 1;
                    }                      
                }           
           }                        
        }
        return 0;
    }    
    
    //Borrar telefono del temporal
    public function borrarItemTelefono($x){    

        if(empty($_SESSION['matriz_telefonico'][$x])==false){ 
            
            unset($_SESSION['matriz_telefonico'][$x]);    
            return true;
            
        }   
        return false;

    }    


    public function resetListaTelefono(){
        $this->session->sess_destroy();
        return $this->session->userdata('lista_telefonos');
    }    
    
    
    public function agregarItemOficioExperiencia($id_Oficio,$id_periodo)
    {
      $this->load->model('entidad_negocio/oficio_model');                    
      $this->load->model('entidad_negocio/tipo_experiencia_model');
                
      $_SESSION['oficio_experiencia'][] = $id_Oficio;
      $_SESSION['id_periodo_experiencia'][] = $id_periodo;
      
      $temp1= $this->tipo_experiencia_model->instanciaPeriodoExperiencia($id_periodo) ;
      $_SESSION['descrip_periodo_experiencia'][] = $temp1["DES_TIPO_MAESTRO"];

      $temp2= $this->oficio_model->instanciaOficios($id_Oficio);
      #echo "temp2:".$temp2["DES_OFICIO"];
      $_SESSION['descrip_oficio_experiencia'][] = $temp2["DES_OFICIO"];
      return true;
      
    }


    public function retornarOficio($x)
    {

        if( (empty($_SESSION['oficio_experiencia'])==false || isset($_SESSION['oficio_experiencia'])) ||
            (empty($_SESSION['id_periodo_experiencia'])==false || isset($_SESSION['id_periodo_experiencia'])) 
           ){

            $arreglo['id_oficio_experiencia'] = $_SESSION['oficio_experiencia'][$x] ;
            $arreglo['id_periodo_experiencia'] =$_SESSION['id_periodo_experiencia'][$x] ;

            return $arreglo;


        }
        return false;

    } 


    public function borrarItemOficios($x){
     
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

    public function resetListaOficiosExperimentados(){
        $this->session->sess_destroy();
        return $this->session->userdata('oficio_experiencia');    
    }    
    
    public function listarOficios()
    {
        $arreglo=array();
        if(empty($this->session->userdata('oficio_experiencia'))==false){            
            $arreglo = $this->session->userdata('oficio_experiencia');               
        }        
        return $arreglo; 
    }    
    
    public function listarExperiencia()
    {
        $arreglo=array();
        if(empty($this->session->userdata('id_periodo_experiencia'))==false){            
            $arreglo = $this->session->userdata('id_periodo_experiencia');               
        }        
        return $arreglo; 
    }      
    public function listarPeriodoExperienciaDescrip()
    {
        $arreglo=array();
        if(empty($this->session->userdata('descrip_periodo_experiencia'))==false){            
            $arreglo = $this->session->userdata('descrip_periodo_experiencia');               
        }        
        return $arreglo; 
    }      
    
    
    public function listarOficioExperienciaDescrip()
    {
        $arreglo=array();
        if(empty($this->session->userdata('descrip_oficio_experiencia'))==false){            
            $arreglo = $this->session->userdata('descrip_oficio_experiencia');               
        }        
        return $arreglo; 
    } 
    
    
    public function existeItemOficio($id_oficio){               
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
    
    public function validatExistenciaOficio_check($id_oficio){
  
        $arreglo=array();        
        if(empty($this->listarOficios())==false){            
           $arreglo = $this->listarOficios();
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
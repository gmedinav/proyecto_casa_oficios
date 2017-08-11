<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmrh_contactos extends CI_Controller {

        public $lista_Telefonos_Contactos ;
        
        function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');      
 
        }    

  	public function agregar_Lista_Contacto($cod_Tmrh,$cod_Tipo_Operadora,$telefono)
	{      
        
            // Crear el modelo de datos, sin llegar a ser persisntencia
            // esto con el fin para no genere problema con el FK
            
            $this->load->model('tmrh_telefono_adjunto_model');
            $arr = $this->lista_Telefonos_Contactos;
            
            //validar Existencia de ingreso del Telefono
            if(empty($arr)==FALSE)
            {
                foreach($arr as $instancia){
                    if($instancia->telefono == $telefono){                    
                    return FALSE;
                    }
                }
            }
            
            //Preparar el en agregar el lo solictado en memorio
            
            $item = $this->tmrh_telefono_adjunto_model->crear_Telef_Contacto($cod_Tmrh,$cod_Tipo_Operadora,$telefono);                    
            //array_push($this->lista_Telefonos_Contactos, $item);
            
            return $this->lista_Telefonos_Contactos;
            
            //$data["listaContactosTelefonico"] = $this->lista_Telefonos_Contactos;
            //$this->load->view('demo',$data);
            
        }   
        
  	public function eliminar_Lista_Contacto($telefono)
	{      
            //Eliminar de la lista
            
            $this->load->model('tmrh_telefono_adjunto_model');
            //$arr = $this->lista_Telefonos_Contactos;
            
            //validar Existencia de ingreso del Telefono
            foreach($this->lista_Telefonos_Contactos as $instancia){
                if($instancia->telefono == $telefono){          
                    unset($this->lista_Telefonos_Contactos);
                    return TRUE;
                }
              }
            
            return FALSE;  
            
        }         
        
        
  	public function guardar_Lista_Contacto($id_tmrh)
	{      
        
            $this->load->model('tmrh_telefono_adjunto_model');                       
            foreach($this->lista_Telefonos_Contactos as $instancia){                
              $this->tmrh_telefono_adjunto_model->guardar_Instancia($id_tmrh, $instancia); 
            }        

            
            
        }
        
        
	public function index()
	{
//	
//              $data['guardado']=FALSE;
//		$this->load->model('ubigeo_model');
//		$data['distritos']= $this->ubigeo_model->listDistritosLima(); 
//		$this->load->model('oficio_model');
//		$data['oficios']= $this->oficio_model->listOficios();  
                //$this->load->library('form_validation');
                
                //echo "antes de rpta";
                $rpta= $this->input->post('enviar');
                //echo "despues de rpta";
                
                if( $rpta == "agregar")                    
                {
                    $cod_Tipo_Operadora=1;
                    $cod_Tmrh='0002';
                    $telefono=$this->input->post('telefono');
                    
                   
                    echo "igual a agregar";
                    $data['telef_array']= $this->agregar_Lista_Contacto($cod_Tmrh,$cod_Tipo_Operadora,$telefono);                   
                    //$this->load->view('demo',$data['telef_array']);	                
                    
                }else{
                    
                    if($rpta == "eliminar" && empty($this->input->post('telefonos'))==false)                        
                    {
                        $this->eliminar_Lista_Contacto($this->input->post('telefonos'));
                        //echo "igual a eliminar";

                        $data['telef_array']=$this->lista_Telefonos_Contactos;
                        $this->load->view('demo',$data['telef_array']);		                       

                    }
                    
                }


	}
     

}

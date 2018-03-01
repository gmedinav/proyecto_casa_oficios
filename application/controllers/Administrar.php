<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();


		$this->load->database();
		$this->load->helper('url');

        $this->load->library('session');	    
        //ini_set('max_execution_time', 65); 

		$this->load->library('grocery_CRUD');

		if($this->sesion_activa()==false){

			//$this->load->view('vw_login');
			redirect(base_url()."Login/");
			die();			
		}  


	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}



	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}



	public function clientes()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_cliente');
			$crud->set_subject('Clientes');
			$crud->required_fields('NOM_CLIENTE','APE_PATERNO');
			$crud->columns(

			'COD_CLIENTE',
			'NOM_CLIENTE',
			'APE_PATERNO',
			'APE_MATERNO',
			'COD_TIPO_DOCUMENTO',
			'NUM_DOCUMENTO',
			'COD_TIPO_GENERO',
			'COD_UBIGEO',
			'DIRECCION',
			'CEL_1',
			'CEL_2',
			'COD_USUARIO',
			'CUENTA_FACEBOOK',
			'CUENTA_GMAIL',
			'FEC_NACIMIENTO',
			'COD_TIPO_CANAL_CONTACTO',
			'COD_USUARIO_REGISTRO',
			'ESTADO'
				);

			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->set_relation('COD_TIPO_GENERO','tb_tip_sexo','DES_TIPO_MAESTRO');			
			$crud->set_relation('COD_TIPO_DOCUMENTO','tb_tip_documento','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_UBIGEO','tb_ubigeo','DES_UBIGEO');
			$crud->set_relation('COD_TIPO_CANAL_CONTACTO','tb_tip_canal_contacto','DES_TIPO_MAESTRO');


			$crud->fields(

			'COD_CLIENTE',
			'NOM_CLIENTE',
			'APE_PATERNO',
			'APE_MATERNO',
			'COD_TIPO_DOCUMENTO',
			'NUM_DOCUMENTO',
			'COD_TIPO_GENERO',
			'COD_UBIGEO',
			'DIRECCION',
			'CEL_1',
			'CEL_2',
			'COD_USUARIO',
			'CUENTA_FACEBOOK',
			'CUENTA_GMAIL',
			'FEC_NACIMIENTO',
			'COD_TIPO_CANAL_CONTACTO',
			'COD_USUARIO_REGISTRO',
			'ESTADO'

				);


			$crud->display_as('COD_CLIENTE','Id Cliente');	
			$crud->display_as('NOM_CLIENTE','Nombres');	
			$crud->display_as('APE_PATERNO','Apellido Paterno');			
			$crud->display_as('APE_MATERNO','Apellido Materno');	
			$crud->display_as('NUM_DOCUMENTO','Número Documento');	
			$crud->display_as('CUENTA_FACEBOOK','Cuenta Facebook');	
			$crud->display_as('COD_TIPO_DOCUMENTO','Tipo Documento');
			$crud->display_as('COD_UBIGEO','Ubigeo');				
			$crud->display_as('DIRECCION','Dirección');			
			$crud->display_as('FEC_NACIMIENTO','Fecha Nacimiento');		
			$crud->display_as('CUENTA_GMAIL','Cuenta Gmail');		
			$crud->display_as('COD_TIPO_CANAL_CONTACTO','Tipo Canal Contacto');		
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');		
			$crud->display_as('COD_USUARIO','Usuario');	
			$crud->display_as('COD_TIPO_GENERO','Sexo');				
			$crud->display_as('CEL_1','Celular 1');		
			$crud->display_as('CEL_2','Celular 2');		
			$crud->display_as('ESTADO','Estado');		
	
			$output = $crud->render();


			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function sexo()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_table('tb_tip_sexo');
			$crud->set_subject('Tipo Sexo');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);
			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Sexo');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

/*
	public function asignacion_trabajo()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_asignacion_tmrh');
			$crud->set_subject('Asignación de Trabajo');
			//$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'cod_tmrh',
			'cod_solicitud_trabajo'

				);

			$crud->set_relation('cod_tmrh','tb_tmrh','{NUM_DOCUMENTO} - {NOM_TMRH} {APE_PATERNO} {APE_MATERNO}');
			$crud->set_relation('cod_solicitud_trabajo','tb_solicitud_trabajo','{COD_SOLICITUD} - {TITULO}', null,'COD_SOLICITUD ASC');

			$crud->fields('cod_tmrh', 'cod_solicitud_trabajo');

			$crud->display_as('cod_tmrh','Código TMRH');
			$crud->display_as('cod_solicitud_trabajo','Código Solicitud de Trabajo');


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
*/


	public function asignacion_trabajo($codigo_solicitud, $codigo_trabajador){




		$this->solicitud_trabajo();

		
	}



	public function asignacion_estado()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');



			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}






	public function tipo_canal_contacto()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_canal_contacto');
			$crud->set_subject('Tipo Canal Contacto');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);
			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Canal Contacto');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function tipo_averia()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tipo_averia');
			$crud->set_subject('Tipo Avería');
			$crud->required_fields('DES_TIPO_AVERIA','COD_TIPAVERIA');
			$crud->columns(

			'COD_TIPAVERIA',
			'DES_TIPO_AVERIA',
			'COD_USUARIO_REGISTRO'

				);
			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPAVERIA', 'DES_TIPO_AVERIA', 'COD_USUARIO_REGISTRO');

			$crud->display_as('DES_TIPO_AVERIA','Descripción');
			$crud->display_as('COD_TIPAVERIA','Id Tipo Avería');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}





	public function tipo_prioridad()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_prioridad');
			$crud->set_subject('Tipo Avería');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);
			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Tipo Prioridad');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}






	public function solicitud_trabajo()
	{
		try{
			$crud = new grocery_CRUD();



		    $crud->or_where('ESTADO',1);
		    $crud->or_where('ESTADO',5);


			#$crud->set_theme('datatables');
			$crud->set_table('tb_solicitud_trabajo');
			$crud->set_subject('Solicitud Trabajo');
			//$crud->required_fields('COD_SOLICITUD','COD_SOLICITUD','NOMBRE','EMAIL','TELEFONO','TITULO','DESCRIPCION','COD_UBIGEO');
		
			$crud->columns(

			'COD_SOLICITUD',
			'NOMBRE',
			'COD_UBIGEO',			
			'DIRECCION',		
			'COD_TIPO_AVERIA',
			'ESTADO',
			'FEC_REGISTRO'

				);


			$crud->add_action('Asignar Trabajador', site_url('assets/grocery_crud/themes/flexigrid/css/images/worker.png'), 'Administrar/trabajador_por_asignar');

			$crud->fields('NOMBRE', 'EMAIL', 'TELEFONO','TITULO','DESCRIPCION','FEC_REGISTRO','COD_UBIGEO','COD_OFICIO');	

			$crud->set_relation('COD_OFICIO','tb_oficio','DES_OFICIO');
			$crud->set_relation('COD_TIPO_AVERIA','tb_tipo_averia','DES_TIPO_AVERIA');
			$crud->set_relation('ESTADO','tb_estado_solicitud_trabajo','descripcion');
			$crud->set_relation('COD_UBIGEO','tb_ubigeo','DES_UBIGEO',array('COD_PAIS' => '001','COD_DEPARTAMENTO' => '15','COD_PROVINCIA'=>'01','COD_DISTRITO <>'=>'00'),'COD_UBIGEO ASC');

			$crud->edit_fields('NOMBRE', 'EMAIL', 'TELEFONO','TITULO','DESCRIPCION','FEC_REGISTRO','COD_UBIGEO','COD_OFICIO');

			$crud->display_as('COD_SOLICITUD','Código Solicitud');
			$crud->display_as('NOMBRE','Nombre Contacto');
			$crud->display_as('COD_TIPO_AVERIA','Tipo Avería');
			$crud->display_as('TELEFONO','Teléfono');
			$crud->display_as('DESCRIPCION','Descripción de Avería');
			$crud->display_as('FEC_REGISTRO','Fecha Registro');
			$crud->display_as('DIRECCION','Dirección');
			$crud->display_as('ESTADO','Estado');
			$crud->display_as('COD_UBIGEO','Distrito');
			$crud->display_as('COD_OFICIO','Oficio');

			$crud->field_type('DESCRIPCION', 'textarea');


			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_read();
			

			$output = $crud->render();
			$this->_example_output($output);


		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

/*
	function _just_a_test2($primary_key , $row)
	{
		return '<a href="Administrar/trabajador_por_asignar/'.$row->id.'"><img src="http://www.grocerycrud.com/assets/uploads/general/smiley.png"></a>';
	}

	function vincular_tmrh($primary_key , $row)
	{
	return site_url('Administrar/trabajador_por_asignar/').$row->country;
	}
 
*/




	public function trabajador()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tmrh');
			$crud->set_subject('Trabajador (TMRH)');
			$crud->required_fields(

				'COD_TMRH',
				'NOM_TMRH',
				'APE_PATERNO',
				'APE_MATERNO',
				'EMAIL',
				'COD_TIPO_DOCUMENTO',
				'NUM_DOCUMENTO',
				'COD_TIPO_GENERO',
				'COD_UBIGEO',
				'DIRECCION',
				'FEC_NACIMIENTO',
				'COD_OFICIO_PRINCIPAL',
				'COD_TIEMPO_EXPERIENCIA',
				'COD_USUARIO_REGISTRO',
				'NUM_CELU',
				'COD_TIPO_OPERADORA'

				);
			$crud->columns(

			'COD_TMRH',
			'NOM_TMRH',
			'APE_PATERNO',
			'APE_MATERNO',
			'EMAIL',
			'COD_TIPO_DOCUMENTO',
			'NUM_DOCUMENTO',
			'COD_TIPO_GENERO',
			'COD_UBIGEO',
			'DIRECCION',
			'FEC_NACIMIENTO',
			'EDAD',
			'COD_OFICIO_PRINCIPAL',
			'COD_TIEMPO_EXPERIENCIA',
			'FEC_REGISTRO',
			'FEC_MODIFICACION',
			'COD_USUARIO_REGISTRO',
			'NUM_CELU',
			'COD_TIPO_OPERADORA'


				);

			$crud->fields(

				'COD_TMRH',
				'NOM_TMRH',
				'APE_PATERNO',
				'APE_MATERNO',
				'EMAIL',
				'COD_TIPO_DOCUMENTO',
				'NUM_DOCUMENTO',
				'COD_TIPO_GENERO',
				'COD_UBIGEO',
				'DIRECCION',
				'FEC_NACIMIENTO',
				'COD_OFICIO_PRINCIPAL',
				'COD_TIEMPO_EXPERIENCIA',
				'COD_USUARIO_REGISTRO',
				'NUM_CELU',
				'COD_TIPO_OPERADORA'

				);



			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->set_relation('COD_TIPO_GENERO','tb_tip_sexo','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_TIEMPO_EXPERIENCIA','tb_tip_experiencia','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_TIPO_DOCUMENTO','tb_tip_documento','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_UBIGEO','tb_ubigeo','DES_UBIGEO');
			$crud->set_relation('COD_OFICIO_PRINCIPAL','tb_oficio','DES_OFICIO');
			$crud->set_relation('COD_TIPO_OPERADORA','tb_tip_operadora','DES_TIPO_MAESTRO');


			$crud->display_as('COD_TMRH','Id Trabajador');
			$crud->display_as('NOM_TMRH','Nombres');
			$crud->display_as('APE_PATERNO','Apelido Paterno');			
			$crud->display_as('APE_MATERNO','Apelido Materno');	
			$crud->display_as('NUM_DOCUMENTO','Número Documento');	
			$crud->display_as('EMAIL','E-mail');	
			$crud->display_as('COD_TIPO_DOCUMENTO','Tipo Documento');
			$crud->display_as('COD_UBIGEO','Ubigeo');				
			$crud->display_as('DIRECCION','Dirección');				
			$crud->display_as('FEC_NACIMIENTO','Fecha Nacimiento');				
			$crud->display_as('COD_OFICIO_PRINCIPAL','Oficio Principal');				
			$crud->display_as('COD_TIEMPO_EXPERIENCIA','Tiempo Experiencia');				
			$crud->display_as('COD_TIPO_OPERADORA','Tipo Operadora');				
			$crud->display_as('COD_USUARIO_REGISTRO','Tipo Documento');		
			$crud->display_as('NUM_CELU','Teléfono Principal');		
			$crud->display_as('COD_TIPO_GENERO','Género');				
			$crud->display_as('FEC_REGISTRO','Tipo Documento');		
			$crud->display_as('COD_TIPO_GENERO','Género');	
			$crud->display_as('FEC_REGISTRO','Fecha registro');	
			$crud->display_as('FEC_MODIFICACION','Fecha Modificación');	
			
			$crud->callback_column('EDAD', array($this,'busca_edad'));

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}



	public function busca_edad($primary_key, $row){

		$fecha_nacimiento = $row->FEC_NACIMIENTO;

		$dia=date("d");
		$mes=date("m");
		$ano=date("Y");


		$dianaz=date("d",strtotime($fecha_nacimiento));
		$mesnaz=date("m",strtotime($fecha_nacimiento));
		$anonaz=date("Y",strtotime($fecha_nacimiento));


		//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

		if (($mesnaz == $mes) && ($dianaz > $dia)) {
		$ano=($ano-1); }

		//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

		if ($mesnaz > $mes) {
		$ano=($ano-1);}

		 //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

		$edad=($ano-$anonaz);


		return $edad;


	}



	public function trabajador_por_asignar($id_solicitud)
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tmrh');
			$crud->set_subject('Trabajador (TMRH)');
			$crud->required_fields(

				'COD_TMRH',
				'NOM_TMRH',
				'APE_PATERNO',
				'APE_MATERNO',
				'EMAIL',
				'COD_TIPO_DOCUMENTO',
				'NUM_DOCUMENTO',
				'COD_TIPO_GENERO',
				'COD_UBIGEO',
				'DIRECCION',
				'FEC_NACIMIENTO',
				'COD_OFICIO_PRINCIPAL',
				'COD_TIEMPO_EXPERIENCIA',
				'COD_USUARIO_REGISTRO',
				'NUM_CELU',
				'COD_TIPO_OPERADORA'

				);
			$crud->columns(

			'COD_TMRH',
			'NOM_TMRH', 'APE_PATERNO', 'APE_MATERNO',
			'COD_TIPO_GENERO',
			'COD_UBIGEO',
			'FEC_NACIMIENTO',
			'NUM_CELU'

				);

			$crud->fields(

				'COD_TMRH',
				'NOM_TMRH',
				'APE_PATERNO',
				'APE_MATERNO',
				'EMAIL',
				'COD_TIPO_DOCUMENTO',
				'NUM_DOCUMENTO',
				'COD_TIPO_GENERO',
				'COD_UBIGEO',
				'DIRECCION',
				'FEC_NACIMIENTO',
				'COD_OFICIO_PRINCIPAL',
				'COD_TIEMPO_EXPERIENCIA',
				'COD_USUARIO_REGISTRO',
				'NUM_CELU',
				'COD_TIPO_OPERADORA'

				);



			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->set_relation('COD_TIPO_GENERO','tb_tip_sexo','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_TIEMPO_EXPERIENCIA','tb_tip_experiencia','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_TIPO_DOCUMENTO','tb_tip_documento','DES_TIPO_MAESTRO');
			$crud->set_relation('COD_UBIGEO','tb_ubigeo','DES_UBIGEO');
			$crud->set_relation('COD_OFICIO_PRINCIPAL','tb_oficio','DES_OFICIO');
			$crud->set_relation('COD_TIPO_OPERADORA','tb_tip_operadora','DES_TIPO_MAESTRO');


			$crud->display_as('COD_TMRH','Código Trabajador');
			$crud->display_as('NOM_TMRH','Nombres');
			$crud->display_as('APE_PATERNO','Apelido Paterno');			
			$crud->display_as('APE_MATERNO','Apelido Materno');	
			$crud->display_as('NUM_DOCUMENTO','Número Documento');	
			$crud->display_as('EMAIL','E-mail');	
			$crud->display_as('COD_TIPO_DOCUMENTO','Tipo Documento');
			$crud->display_as('COD_UBIGEO','Distrito');				
			$crud->display_as('DIRECCION','Dirección');				
			$crud->display_as('FEC_NACIMIENTO','Fecha Nacimiento');				
			$crud->display_as('COD_OFICIO_PRINCIPAL','Oficio Principal');				
			$crud->display_as('COD_TIEMPO_EXPERIENCIA','Tiempo Experiencia');				
			$crud->display_as('COD_TIPO_OPERADORA','Tipo Operadora');				
			$crud->display_as('COD_USUARIO_REGISTRO','Tipo Documento');		
			$crud->display_as('NUM_CELU','Teléfono Principal');		
			$crud->display_as('COD_TIPO_GENERO','Género');				
			$crud->display_as('FEC_REGISTRO','Tipo Documento');		
			$crud->display_as('COD_TIPO_GENERO','Género');	
			$crud->display_as('FEC_REGISTRO','Fecha registro');	
			$crud->display_as('FEC_MODIFICACION','Fecha Modificación');	
			
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();
			//$crud->unset_read();

			$crud->add_action('Asignar Trabajador', site_url('assets/grocery_crud/themes/flexigrid/css/images/users.png'), 'Asignacion_solicitud_trabajador/asignacion/'.$id_solicitud,'',array($this, 'botaoExcluir'));
			$output = $crud->render();



			$data['id_asignacion'] = $id_solicitud;


			$this->load->model('solicitud_trabajo_model');
			$solicitud = $this->solicitud_trabajo_model->detalle_simple_solicitud($id_solicitud); 

			$data['COD_SOLICITUD'] = $solicitud['COD_SOLICITUD'] ;
			$data['DES_TIPO_AVERIA'] = $solicitud['DES_TIPO_AVERIA'] ;
			$data['DESCRIPCION'] = $solicitud['DESCRIPCION'] ;
			$data['DES_UBIGEO'] = $solicitud['DES_UBIGEO'] ;
			$data['DIRECCION'] = $solicitud['DIRECCION'] ;


			$output->data = $data;

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}



	function botaoExcluir($primary_key, $row) {
	     return "javascript:confirmar_asignacion(".$row->COD_TMRH.")";
	}





	public function tipo_operadora()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_operadora');
			$crud->set_subject('Tipo Operadora');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Tipo Operadora');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');		
			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');	

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function tipo_usuario()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_usuario');
			$crud->set_subject('Tipo Usuario');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Tipo Usuario');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');	

			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	

	public function tipo_registro()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_registro');
			$crud->set_subject('Tipo Registro');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Tipo Registro');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');	


			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}		



	public function tipo_documento()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_documento');
			$crud->set_subject('Tipo Documento');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Tipo Documento');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');	


			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	

	public function tiempo_experiencia()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
			$crud->set_table('tb_tip_experiencia');
			$crud->set_subject('Tiempo Experiencia');
			$crud->required_fields('DES_TIPO_MAESTRO','COD_TIPO_MAESTRO');
			$crud->columns(

			'COD_TIPO_MAESTRO',
			'DES_TIPO_MAESTRO',
			'COD_USUARIO_REGISTRO'

				);

			$crud->display_as('DES_TIPO_MAESTRO','Descripción');
			$crud->display_as('COD_TIPO_MAESTRO','Id Tipo Experiencia');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');	

			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	





	public function oficio_especialidades()
	{
		try{
			$crud = new grocery_CRUD();


			$crud->set_table('tb_oficio');
			$crud->set_subject('Especialidad');
			$crud->fields('COD_OFICIO', 'DES_OFICIO', 'COD_USUARIO_REGISTRO');


			$crud->required_fields('COD_OFICIO','DES_OFICIO');
			$crud->columns(

			'COD_OFICIO',
			'DES_OFICIO',
			'COD_USUARIO_REGISTRO'

				);

			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');

			$crud->display_as('DES_OFICIO','Descripción');
			$crud->display_as('COD_OFICIO','Id Especialidad');
			$crud->display_as('COD_USUARIO_REGISTRO','Usuario Registro');		


			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	


/*

	public function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}




	public function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');

			$crud->required_fields('lastName');

			$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();

		$this->_example_output($output);
	}

	public function film_management_twitter_bootstrap()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('film');
			$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			$crud->unset_columns('special_features','description','actors');

			$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$this->_example_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}

	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('offices');
		$crud->set_subject('Office');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function employees_management2()
	{
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');

		$crud->required_fields('lastName');

		$crud->set_field_upload('file_url','assets/uploads/files');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function customers_management2()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}


*/

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

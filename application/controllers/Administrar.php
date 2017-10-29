<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
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

			$output = $crud->render();
			$crud->set_relation('COD_USUARIO_REGISTRO','tb_usuario','DES_USUARIO');
			$crud->fields('COD_TIPO_MAESTRO', 'DES_TIPO_MAESTRO', 'COD_USUARIO_REGISTRO');

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function sexo()
	{
		try{
			$crud = new grocery_CRUD();

			#$crud->set_theme('datatables');
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
}

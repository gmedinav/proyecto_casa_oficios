<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'web_public/solicitar_trabajo';//'welcome'; //
$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;


//$route['web_public/(:any)'] = "web_public/solicitar_trabajo/index";

$route['index'] = "web_public/solicitar_trabajo";
$route['solicitar_trabajo'] = "web_public/solicitar_trabajo";
$route['trabaja_con_nosotros'] = "web_public/trabaja_con_nosotros";

$route['oficio_albanil'] = "web_public/oficio_albanil";
$route['oficio_carpintero'] = "web_public/oficio_carpintero";
$route['oficio_gasfitero'] = "web_public/oficio_gasfitero";
$route['oficio_jardinero'] = "web_public/oficio_jardinero";



$route['contactenos'] = "web_public/contactenos";
$route['faq'] = "web_public/faq";
//$route['admin'] = "admin/login";




//$route['web_public/solicitar_trabajo#feature'] = "solicitar_trabajo";


//$route['index'] = 'web_public/solicitar_trabajo/index'; --demo

/*Validar Login*/

$route['wsvalidarlogin/validar/(:num)'] = 'wsvalidarlogin/validar/usuario/$1/pass/$2'; 


    
/*Generos*/

$route['wsgenero']['get'] = 'wsgenero/generos';

/*Oficios*/
$route['wsoficios']['get'] = 'wsoficios/oficios';



/*Solicitudes*/


$route['wssolicitudestrabajo/solicitrab/(:num)'] = 'wssolicitudestrabajo/solicitrab/codigo/$1'; 



/*clientes*/


$route['wscliente/cliente/(:num)'] = 'wscliente/cliente/codigo/$1'; 


$route['wscliente/clientexuserid/(:num)'] = 'wscliente/clientexuserid/codigo/$1'; 

/*Usuarios*/


$route['wsusuario/usuario/(:num)'] = 'wsusuario/usuario/codigo/$1'; 

$route['wsusuario/mailvalida/(:num)'] = 'wsusuario/mailvalida/correo/$1'; 


/*Ubigeo*/

$route['wsubigeo/ubigeo/(:num)'] = 'wsubigeo/ubigeo/codigo/$1'; 

$route['wsubigeo']['get'] = 'wsubigeo/distritos'; 


/*Ubigeo*/

$route['wstipaveria/averiaidoficio/(:num)'] = 'wstipaveria/averiaidoficio/codigo/$1'; 

$route['wstipaveria']['get'] = 'wsubigeo/averias'; 


/*Tipo documento*/

$route['wstip_documento/tipdocumento/(:num)'] = 'wstip_documento/tipdocumento/codigo/$1'; 






/*Others*/

$route['api/example/users/(:num)'] = 'api/example/users/id/$1/name/$2'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8



$route['cities']['get'] = 'cities/index';
$route['cities/(:num)']['get'] = 'cities/find/$1';
$route['cities']['post'] = 'cities/index';
$route['cities/(:num)']['put'] = 'cities/index/$1';
$route['cities/(:num)']['delete'] = 'cities/index/$1';

//
//

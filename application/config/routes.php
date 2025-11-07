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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Index_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// DASHBOARD
//$route[DASHBOARD_PATH]  = 'admin/Dashboard_controller';
// INDEX
$route[ADMIN_PATH] = 'Index_controller';

$route[ADMIN_PATH . '/login']['post'] = 'Index_controller/login';
$route[ADMIN_PATH . '/salir'] = 'Index_controller/frmSalir';
$route[ADMIN_PATH . '/logout']['post'] = 'Index_controller/logout';



// DASHBOARD
$route[DASHBOARD_PATH]  = 'admin/Dashboard_controller';

// PERFIL DE USUARIO EN SESION
$route[PERFIL_PATH . '/editarPerfil'] = 'admin/Perfil_controller/frmEditarPerfil';
$route[PERFIL_PATH . '/frmEditarContrasena'] = 'admin/Perfil_controller/frmEditarContrasena';
$route[PERFIL_PATH . '/actualizarPerfil'] = 'admin/Perfil_controller/actualizarPerfil';
$route[PERFIL_PATH . '/actualizarContrasena'] = 'admin/Perfil_controller/actualizarContrasena';

//CREAR USUARIOS
$route[INSPECTORES_PATH]  = 'admin/Inspector_controller';
$route[INSPECTORES_PATH . '/frmNueva']  = 'admin/Inspector_controller/frmNueva';
$route[INSPECTORES_PATH . '/frmEditar/(:num)']  = 'admin/Inspector_controller/frmEditar/$1';
$route[INSPECTORES_PATH . '/frmVer/(:num)']  = 'admin/Inspector_controller/frmVer/$1';
$route[INSPECTORES_PATH . '/crear']  = 'admin/Inspector_controller/crear';
$route[INSPECTORES_PATH . '/actualizar']  = 'admin/Inspector_controller/actualizar';
$route[INSPECTORES_PATH . '/eliminar/(:num)']  = 'admin/Inspector_controller/eliminar/$1';
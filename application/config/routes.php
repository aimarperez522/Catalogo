<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'productos';

$route['productos'] = 'productos/index';

$route['productos/nuevo'] = 'productos/nuevo';

$route['productos/guardar'] = 'productos/guardar';

$route['productos/editar/(:num)'] = 'productos/editar/$1';

$route['productos/actualizar/(:num)'] = 'productos/actualizar/$1';

$route['productos/eliminar/(:num)'] = 'productos/eliminar/$1';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;
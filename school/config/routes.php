<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "guest";
$route['category/(:num)'] = "exam_control/view_mocks_by_category/$1";
$route['mock_detail/(:num)'] = "admin_control/view_my_mock_detail/$1";
$route['mocks'] = "admin_control/view_my_mocks";
$route['create_mock'] = "admin_control/mock_form";
$route['create_category'] = "admin_control/category_form";
$route['category/all'] = "exam_control/view_all_mocks";
$route['dashboard/(:num)'] = "login_control/dashboard_control/$1";
$route['admin'] = 'login_control/admin_login';
$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
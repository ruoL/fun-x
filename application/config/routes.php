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

$route['default_controller'] = "index";
$route['404_override'] = '';

// admin routes
$route[ADMINDIR . '/article/all']           = ADMINDIR . '/article/index/all';
$route[ADMINDIR . '/article/all/(:num)']    = ADMINDIR . '/article/index/all/$1';
$route[ADMINDIR . '/article/publish']       = ADMINDIR . '/article/index/publish';
$route[ADMINDIR . '/article/publish/(:num)']= ADMINDIR . '/article/index/publish/$1';
$route[ADMINDIR . '/article/trash']         = ADMINDIR . '/article/index/trash';
$route[ADMINDIR . '/article/trash/(:num)']  = ADMINDIR . '/article/index/trash/$1';
$route[ADMINDIR . '/article/draft']         = ADMINDIR . '/article/index/draft';
$route[ADMINDIR . '/article/draft/(:num)']  = ADMINDIR . '/article/index/draft/$1';

// site routes
$route['news/(:any)']			= 'news/index/$1';
$route['news/(:any)/(:num)']	= 'news/index/$1/$2';
$route['category/(:any)']		= 'index/index/$1';
$route['article/(:num)']		= 'view/index/$1';
$route['page/(:any)']			= 'page/index/$1';
$route['tag/(:num)']			= 'tag/index/$1';
$route['tag/(:any)']			= 'tag/name/$1';
$route['tag/(:any)/(:num)']		= 'tag/name/$1/$2';
$route['person/(:num)']			= 'person/index/$1';
$route['book/(:num)']			= 'book/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
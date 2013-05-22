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

$route['about'] = "main/about";
$route['articles'] = "main/articles";
$route['features'] = "main/features";
$route['followers'] = "main/followers";
$route['following'] = "main/following";
$route['lists'] = "main/lists";
$route['list_edit'] = "main/list_edit";
$route['profile'] = "main/profile";
$route['oauth_callback'] = "main/oauth_callback";
$route['profile_edit'] = "main/profile_edit";
$route['quote'] = "main/quote";
$route['retweets'] = "main/retweets"; // For non-JS use case
$route['search'] = "main/search";
$route['sign_in'] = "main/sign_in";
$route['status'] = "main/status"; // View single tweet
$route['tips'] = "main/tips";
$route['tools'] = "main/tools"; // For non-JS use case
$route['user'] = "main/user"; // User details
$route['timeline'] = "main/timeline";
$route['default_controller'] = "main";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

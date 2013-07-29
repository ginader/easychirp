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
$route['direct'] = "main/direct";
$route['direct_inbox'] = "main/direct_inbox";
$route['direct_sent'] = "main/direct_sent";
$route['features'] = "main/features";
$route['favorites'] = "main/favorites";
$route['followers'] = "main/followers";
$route['following'] = "main/following";
$route['go_to_user'] = "main/go_to_user"; // For non-JS and keyboard use cases
$route['lists'] = "main/lists";
$route['list_edit'] = "main/list_edit";
$route['mentions'] = "main/mentions";
$route['mytweets'] = "main/mytweets";
$route['oauth_callback'] = "main/oauth_callback";
$route['profile'] = "main/profile";
$route['profile_edit'] = "main/profile_edit";
$route['quote'] = "main/quote";
$route['reply'] = "main/reply";
$route['retweet'] = "main/retweet"; // For non-JS and keyboard use cases
$route['retweets'] = "main/retweets"; // For non-JS and keyboard use cases
$route['retweets/(:any)'] = "main/retweets/$1"; // For non-JS and keyboard use cases
$route['search'] = "main/search";
$route['search_quick'] = "main/search_quick"; // For non-JS and keyboard use cases
$route['search_results'] = "main/search_results";
$route['sign_in'] = "main/sign_in";
$route['sign_out'] = "main/sign_out";
$route['status'] = "main/status"; // View single tweet
$route['tips'] = "main/tips";
$route['tools'] = "main/tools"; // For non-JS and keyboard use cases
$route['timeline'] = "main/timeline";
$route['trends'] = "main/trends";
$route['user'] = "main/user"; // User details
$route['default_controller'] = "main";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

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
$route['block_create/(:any)/(:any)'] = "main/blocking/$1/create/$2";
$route['block_destroy/(:any)/(:any)'] = "main/blocking/$1/destroy/$2";
$route['direct'] = "main/direct";
$route['direct_send'] = "main/direct_send";
$route['direct_delete/(:any)/(:any)'] = "main/direct_delete/$1/$2";
$route['direct_inbox'] = "main/direct_inbox";
$route['direct_sent'] = "main/direct_sent";
$route['features'] = "main/features";
$route['favorites'] = "main/favorites";
$route['favorites/(:any)'] = "main/favorites/$1";
$route['favorite_create/(:any)/(:any)'] = "main/favoriting/$1/create/$2";
$route['favorite_destroy/(:any)/(:any)'] = "main/favoriting/$1/destroy/$2";
$route['followers'] = "main/followers";
$route['following'] = "main/following";
$route['follow_user/(:any)/(:any)'] = "main/manage_follow_user/$1/follow/$2";
$route['unfollow_user/(:any)/(:any)'] = "main/manage_follow_user/$1/unfollow/$2";
$route['go_to_user'] = "main/go_to_user"; // For non-JS and keyboard use cases
$route['go_user_action'] = "main/go_user_action"; // Logic for 'go to user' form
$route['lists'] = "main/lists";
$route['list_edit'] = "main/list_edit";
$route['list_edit_action'] = "main/list_edit_action";
$route['list_timeline'] = "main/list_timeline";
$route['list_delete'] = "main/list_delete";
$route['list_create'] = "main/list_create";
$route['list_add_member/(:any)'] = "main/list_add_member/$1";
$route['list_subscribe'] = "main/list_subscribe";
$route['list_unsubscribe'] = "main/list_unsubscribe";
$route['mentions'] = "main/mentions";
$route['mytweets'] = "main/mytweets";
$route['oauth_callback'] = "main/oauth_callback";
$route['profile'] = "main/profile";
$route['profile_edit'] = "main/profile_edit";
$route['profile_edit_action'] = "main/profile_edit_action";
$route['profile_avatar_action'] = "main/profile_avatar_action";
$route['quote/(:any)'] = "main/quote/$1";
$route['reply/(:any)'] = "main/reply/$1";
$route['reply_all/(:any)'] = "main/reply/$1/all";
$route['report_spam/(:any)/(:any)'] = "main/report_spam/$1/$2";
$route['retweet'] = "main/retweet"; // For non-JS and keyboard use cases
$route['retweets'] = "main/retweets"; // For non-JS and keyboard use cases
$route['retweets/(:any)'] = "main/retweets/$1"; // For non-JS and keyboard use cases
$route['retweet_create/(:any)/(:any)'] = "main/retweet_action/$1/create/$2";
$route['retweet_destroy/(:any)/(:any)'] = "main/retweet_action/$1/destroy/$2";
$route['search'] = "main/search";
$route['search_save'] = "main/search_save";
$route['search_delete/(:any)'] = "main/search_delete/$1";
$route['search_quick'] = "main/search"; // For non-JS and keyboard use cases
$route['search_results'] = "main/search_results";
$route['search_results/(:any)'] = "main/search_results/$1";
$route['search_users'] = "main/search_users";
$route['sign_in'] = "main/sign_in";
$route['sign_out'] = "main/sign_out";
$route['status'] = "main/status"; // View single tweet
$route['status/(:any)'] = "main/status/$1"; // View single tweet
$route['tips'] = "main/tips";
$route['tools'] = "main/tools"; // For non-JS and keyboard use cases
$route['timeline'] = "main/timeline";
$route['timeline/(:any)'] = "main/timeline/$1";
$route['trends'] = "main/trends";
$route['user'] = "main/user"; // User details
$route['user_timeline'] = "main/user_timeline"; // User tweets
$route['user_timeline/(:any)'] = "main/user_timeline/$1"; // User tweets
$route['user_lists'] = "main/user_lists";
$route['default_controller'] = "main";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

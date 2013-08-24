<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);


/*
|--------------------------------------------------------------------------
| Time Constants 
|--------------------------------------------------------------------------
|
| Use these constants for expressing human-readable intervals in their 
| respective number of seconds.  
|
*/
define('MINUTE_IN_SECONDS', 60);
define('HOUR_IN_SECONDS',   60 * MINUTE_IN_SECONDS);
define('DAY_IN_SECONDS',    24 * HOUR_IN_SECONDS);
define('WEEK_IN_SECONDS',    7 * DAY_IN_SECONDS);  
define('YEAR_IN_SECONDS',  365 * DAY_IN_SECONDS);  

/*
|--------------------------------------------------------------------------
| Twitter Constants
|--------------------------------------------------------------------------
|
| These control the UI/API settings for Twitter
|
*/
define('TWEETS_PER_PAGE', 40);


/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

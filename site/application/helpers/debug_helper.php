<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package      EasyChirp
 * @author       EasyChirp Dev Team
 * @copyright    Copyright (c) 2013 - present, EasyChirp.
 * @license      http://codeigniter.com/user_guide/license.html
 * @link         http://codeigniter.com
 * @since        Version 1.9.0423
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * EasyChirp Debug Helpers
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      EasyChirp Dev Team
 * @link        http://codeigniter.com/user_guide/helpers/email_helper.html
 */


/**
 * display the contents of an object to standard output
 *
 * @access      public
 * @return      void
 */
if ( ! function_exists('debug_object'))
{
    function debug_object($value, $var_dump = FALSE)
    {
		echo "<pre>\n";
		if ($var_dump)
		{
			var_dump( $value );		
		}
		else
		{
			print_r( $value );		
		}
		echo "</pre>\n";
    }
}



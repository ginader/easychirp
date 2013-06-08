<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Help Developers to debug their CodeIgniter applicationhh
 *
 * @package      EasyChirp
 * @subpackage   Helpers
 * @author       EasyChirp Dev Team
 * @copyright    Copyright (c) 2013 - present, EasyChirp.
 * @since        Version 1.9.0423
 * @category    Helpers
 * @author      EasyChirp Dev Team
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * EasyChirp Debug Helpers
 *
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



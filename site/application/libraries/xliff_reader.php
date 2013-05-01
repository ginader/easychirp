<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Provides access to a single template which the output of your view 
* scripts gets injected into. 
*
* @package EasyChirp
* @subpackage Libraries
* @author Andrew Woods <atwoods1@gmail.com>
* @version 1.0 
* 
*/


/**
* Provides an interface to 
* the content for each individual page is inserted into the content
*/
class Xliff_reader
{
	public $doc = NULL;
	public $file = NULL;
	public $source_lang = NULL;
	public $target_lang = NULL;
	public $translations = array();

	public function __construct(){}

	/**
	* @param string $lang
	* @return string 
	*/
	public function lang_to_file($lang)
	{
		return APPPATH . 'language/' . $lang . '.xliff';
	}

	/**
	* @param $lang
	*/
	public function load( $lang )
	{
		$file = $this->lang_to_file( $lang );
		$this->doc = simplexml_load_file( $file );	

		$this->source_lang = (string) $file['source-language'];
		$this->target_lang = (string) $file['target-language'];
		
		$trans_units = $this->doc->file->body->children();
		foreach ($trans_units AS $unit)
		{
			$source = (string) $unit->source;
			$target = (string) $unit->target;

			$this->translations[$source] = $target; 
		}
	}

	/**
	* Retrieve translation text for Source text
	*/
	public function get( $source )
	{
		if ( isset($this->translations[ $source ]) )
		{
			// returns the Target translation
			return $this->translations[ $source ];
		}
		else 
		{
			// use the original text since i cant find the translated text
			return $source;
		}
	}

	/**
	* print out the structure of the value 
	*/
	public function debug($value)
	{
		echo '<pre>';
		print_r( $value );
		echo '</pre>';
	}


}


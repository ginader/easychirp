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
		log_message('info', 'xliff load file=' . $file);
		if ( file_exists( $file ) ){
			
			$this->doc = simplexml_load_file( $file );	

			$this->source_lang = $this->doc->file->attributes()->source_language;
			$this->target_lang = $this->doc->file->attributes()->target_language;
				
			if ( empty($this->source_lang) )
			{
				$this->source_lang = 'en-US';
			}

			if ( empty($this->target_lang) )
			{
				$this->target_lang = $lang;
			}
				
			$trans_units = $this->doc->file->body->children();
			foreach ($trans_units AS $trans)
			{
				$id =  $trans->attributes()->id;

				$source = (string) $trans->source->asXML();
				$target =  $trans->target;
				if ($target->children)
				{
					$target =  $trans->target->getChildren->asXML();
				}
				$this->translations["$id"] = array( 
					$this->source_lang => $source 
					, $this->target_lang => $target 
				); 
			}
		}
	}

	/**
	* Retrieve translation text for Source text
	*/
	public function get( $id )
	{
		if ( isset($this->translations["$id"]["$this->target_lang"]) )
		{
			// returns the Target translation
			return $this->translations["$id"]["$this->target_lang"];
		}
		else 
		{
			// use the original text since i cant find the translated text
			return $this->translations["$id"][$this->source_lang];
		}
	}


}


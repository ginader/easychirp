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
* Provides a consistent layout across all pages of a site. 
* the content for each individual page is inserted into the content
*/
class Layout
{
	
	private $obj;
	private $site_name = '';
	private $title_delimiter = ' | ';

	public $layout;
	public $skip_to_sign_in = FALSE;
	public $title = '';
	public $sign_in_url = '';
	public $base_url = '';
	public $description = "";
	public $logged_in = "";
	public $meta_name_tags = array();
	public $meta_http_equiv_tags = array();
	public $head_codes = array(
		'meta' => array(),
		'meta_equiv' => array(),
		'links' => array(),
		'scripts' => array(),
	);

	/**
	* Constructor. 
	*
	* @param String $layout optional name of the template in the views directory. 
	* 'layout_main' is the default name 
	* @return void
	*/ 
	function __construct($layout = "layout_main")
	{
		try 
		{
			$this->obj =& get_instance();
		}
		catch (ErrorException $e)
		{
			error_log($e->getMessage());
		}
		
		$this->layout = $layout;
	}

	/**
	* Override the default layout script
	*
	* @param String $layout name of the template file in the views directory
	* @return void
	*/ 
	function set_skip_to_sign_in($value)
	{
		if ( ! is_bool($value))
		{
			throw new Exception('The argument must be a boolean. TRUE or FALSE');
		}
		$this->skip_to_sign_in = $value;
	}


	/**
	* Override the default layout script
	*
	* @param String $layout name of the template file in the views directory
	* @return void
	*/ 
	function set_layout($layout)
	{
		$this->layout = $layout;
	}

	/**
	* Retrieve the title
	*
	* @return String
	*/ 
	function get_title()
	{
		$title = '';
		if ( isset($this->site_name) )
		{
			if ( isset($this->tagline) )
			{
				$title = $this->title . $this->title_delimiter . $this->site_name 
				                        . $this->title_delimiter . $this->tagline;
			}
			else 
			{
				$title = $this->title . $this->title_delimiter . $this->site_name;
			}
		}
		else
		{
			$title = $this->title;
		}

		return $title;
	}

	/**
	* Set the value of <title> in the head of the html. 
	* 
	* @param String $title 
	* @return void
	*/ 
	function set_title($title)
	{
		$this->title = $title;
	}

	/**
	* Retrieve the name of the Website 
	*
	* @return String
	*/
	function get_site_name()
	{
		return $this->site_name;
	}

	/**
	* Set the name of the site
	*
	* @param String $name 
	* @return void
	*/ 
	function set_site_name($name)
	{
		$this->site_name = $name;
	}

	/**
	* Retrieve the tagline of the site.
	*
	* @return String
	*/ 
	function get_tagline()
	{
		return $this->tagline;
	}

	/**
	* Set the tagline for the site
	*
	* @param String $tagline 
	* @return void
	*/ 
	function set_tagline($tagline)
	{
		$this->tagline = $tagline;
	}

	/**
	* @param String $desc the meta description 
	* @return void
	*/
	function set_description($desc)
	{
		$this->add_meta_tag_name('description', $desc);
	}

	/**
	* Determine if the user is logged in
	*
	* @return Boolean
	*/
	function get_logged_in()
	{
		return $this->logged_in;
	}

	/**
	* Pass the user's logged in status to the layout
	*
	* @param Boolean $status 
	* @return void
	*/ 
	function set_logged_in( $status )
	{
		$this->logged_in = $status;
	}



	/**
	* Add an array to regular meta tags 
	*
	* @param String $name 
	* @param String $value 
	* @return void
	*/
	function add_meta_tag_name($name, $value)
	{
		$this->head_codes['meta'][$name] = $value;
	}

	/**
	* Add an array to meta http tags 
	*
	* @param String $name 
	* @param String $value 
	* @return void
	*/
	public function add_meta_tag_equiv($name, $value)
	{
		$this->head_codes['meta_equiv'][$name] = $value;
	}

	/**
	* <META HTTP-EQUIV="name" CONTENT="content">
	* <META NAME="name" CONTENT="content">';
	*/
	public function write_meta_tags()
	{
		$tags = '';
		if ( sizeof($this->head_codes['meta_equiv']) > 0 )
		{
			foreach ($this->head_codes['meta_equiv'] As $name => $value)
			{
				$tags .= "<meta http-equiv=\"" . $name .  "\" content=\""  . $value . "\" />\n"; 
			}			
		}
		
		$tags .= "\n";
		if ( sizeof($this->head_codes['meta']) > 0 )
		{
			foreach ($this->head_codes['meta'] AS $name => $value)
			{
				if ($name === 'charset')
				{
					$tags .= "<meta charset=\"" . $value . "\" />\n"; 
				}
				else 
				{
					$tags .= "<meta name=\"" . $name . "\" content=\""  . $value . "\" />\n"; 
				}
			}
		}
		$tags .= "\n";
		
		return $tags;
	}

	/**
	* Add a link to the array of codes. 
	*
	* @param String $code the contents of a formatted <link> element 
	* @return void
	*/
	public function add_link_tag($href, $rel, $type = FALSE)
	{
		$data = array('href' => $href, 'rel' => $rel); 
		if ($type)
		{
			$data['type'] = $type;
		}
		 
		$this->head_codes['links'][] = $data;
	}

	/**
	*/
	public function write_link_tags()
	{
		$tags = '';
		if ( sizeof($this->head_codes['links']) > 0 )
		{
			foreach ($this->head_codes['links'] AS $link)
			{
				$tags .= '<link rel="' . $link['rel'] . '" href="'  . $link['href'] . '"' ; 
				if ( isset($link['type']) ){
					$tags .= ' type="' . $link['type'] . '"';
				}
				$tags .=  "/>\n"; 
			}
		}
		$tags .= "\n";
		
		return $tags;
	}

	/**
	* Add a script to the array of codes. 
	*
	* @param String $code the contents of a formatted <link> element 
	* @return void
	*/
	public function add_script_tag($src, $type = FALSE)
	{
		$data = array('src' => $src); 
		if ($type)
		{
			$data['type'] = $type;
		}
		 
		$this->head_codes['scripts'][] = $data;
	}

	/**
	*/
	public function write_script_tags()
	{
		$tags = '';
		if ( sizeof($this->head_codes['scripts']) > 0 )
		{
			foreach ($this->head_codes['scripts'] AS $link)
			{
				$tags .= '<script  src="'  . $link['src'] . '"' ; 
				if ( isset($link['type']) ){
					$tags .= ' type="' . $link['type'] . '"';
				}
				$tags .=  "/>\n"; 
			}
		}
		$tags .= "\n";
		
		return $tags;
	}

	public function get_head_codes(){
		$head_output = "\n";
		$head_output .= '<title>' . $this->get_title() . "</title>\n" ;	
		$head_output .= $this->write_meta_tags();
		$head_output .= $this->write_link_tags();
		$head_output .= $this->write_script_tags();

		return $head_output;
	}


	/**
	* Describe your function
	*
	* @param String $view 
	* @param Array $data optional  
	* @param Boolean $return optional Do you want to assign the view as a value. Default is FALSE.
	* @return void
	*/
	function view($view, $data=null, $return=false)
	{
		$loaded_data = array();
		$loaded_data['content'] = $this->obj->load->view($view,$data,true);
		$loaded_data['head_codes'] = $this->get_head_codes();
		$loaded_data['title'] = $this->title;
		$loaded_data['base_url'] = $this->base_url;
		$loaded_data['sign_in_url'] = $this->sign_in_url;
		$loaded_data['logged_in'] = $this->logged_in;
		$loaded_data['skip_to_sign_in'] = $this->skip_to_sign_in;

		if($return)
		{
			$output = $this->obj->load->view($this->layout, $loaded_data, true);
			return $output;
		}
		else
		{
			$this->obj->load->view($this->layout, $loaded_data, false);
		}
	}
}

/* End of file layout.php */ 
/* Location: ./application/libraries/layout.php */

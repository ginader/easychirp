<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xliff extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$dir = APPPATH . 'language/';	

		$files = glob(APPPATH . 'language/*.xliff');

		echo 'XLIFF Files<br /><br />';
		foreach ($files AS $file)
		{
			echo 'file=' . $file . '<br />';
		}
		echo '<hr noshade>';
		
	}

	
	public function file($lang_code = 'en-GB')
	{
		$this->load->library('xliff_reader');
		$file = APPPATH . 'language/' . $lang_code . '.xliff';	

		$this->xliff_reader->load( $lang_code );
		echo 'translations=';
		$this->xliff_reader->debug_object( $this->xliff_reader->translations );

		echo "<p>Languages -- \n" 
		. "source:" . $this->xliff_reader->source_lang . "\n" 
		. "target:" . $this->xliff_reader->target_lang . "</p>\n"; 
	
		/* RESTORE THESE
		echo 'Sign in: ' . $this->xliff_reader->get('nav-sign-in') . '<br />';
		echo 'Sign out: ' . $this->xliff_reader->get('nav-sign-out') . '<br />';
		echo 'My Profile: ' . $this->xliff_reader->get('my-profile') . '<br />';
		echo 'Home: ' . $this->xliff_reader->get('home') . '<br />';
		echo 'Skip to Main Content: ' . $this->xliff_reader->get('skip-main-content') . '<br />';
		*/
		echo 'Skip to Sign in: ' . $this->xliff_reader->get('skip-sign-in') . '<br />';

	}



}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

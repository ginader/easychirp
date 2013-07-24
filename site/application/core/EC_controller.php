<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Base controller used by all EasyChirp controllers
 *
 * @package EasyChirp
 * @subpackage core
 * @author EasyChirp Team
 */
class EC_Controller extends CI_Controller {

	/**
	 * Constructor used by all controllers
	 *
	 */
	public function __construct()
	{
		session_start();
		parent::__construct();

		$this->load->library('menu_generator');
		$this->load->library('xliff_reader');

		$lang_code = $this->config->item('site_language');
		$supported = $this->config->item('supported_langs');
		foreach ($this->get_user_languages() AS $lang)
		{
			if ( isset(  $supported[ $lang ]  ) )
			{
				$lang_code = $lang ;
				break;
			}

		}
		$lang_code = 'en-US';
		error_log('lang_code=' . $lang_code);
		$this->xliff_reader->load( $lang_code );
		
		$this->layout->set_site_name('EasyChirp');
		$this->layout->set_tagline('web accessibility for the Twitter.com website application');
		$this->layout->set_description('Easy Chirp. Web accessibility for the Twitter web site application. The Twitter.com website redone with strict web standards and web accessibility. Great for screen readers, low-vision, beginners, older browsers, text-only browsers, and non-JavaScript.');

		// META TAGS
		$this->layout->lang_code = $lang_code;
		$this->layout->add_meta_tag_name('charset', 'utf-8');
		$this->layout->add_meta_tag_name('author', 'Dennis E Lembree, Web Overhauls');
		$this->layout->add_meta_tag_name('viewport', 'width=device-width, initial-scale=1.0');
		$this->layout->add_meta_tag_name('verify-v1', '3gSFkFi1HCTZp2MP2dUh9mteuUJdRlMzx+HrFKopQN4=');
		$this->layout->add_meta_tag_name('keywords', 'accessible,Twitter,twitter,twitter.com,easy,web site,Web,web,site,accessibility,Accessibility,app,client,screenreader,screen reader,JAWS,NVDA,application,low vision');

		$this->layout->add_meta_tag_name('twitter:card', 'summary');
		$this->layout->add_meta_tag_name('twitter:site', '@EasyChirp');
		$this->layout->add_meta_tag_name('twitter:creator', '@DennisL');
		$this->layout->add_meta_tag_name('twitter:url', 'http://www.easychirp.com/');
		$this->layout->add_meta_tag_name('twitter:title', 'Easy Chirp, a user-friendly web-based Twitter application');
		$this->layout->add_meta_tag_name('twitter:image', 'http://www.easychirp.com/images/easy_chirp_icon_200.jpg');
		$this->layout->add_meta_tag_name('twitter:description', 'Easy Chirp has a simple interface and is optimized for disabled users and also works on older technology. It also functions well with keyboard-only, IE6, lowband internet connection, and without JavaScript.');

		$this->layout->add_link_tag('/images/brand/favicon.ico', 'shortcut icon');
		$this->layout->add_link_tag('/include/css/general.css', 'stylesheet', 'text/css');
		$this->layout->add_link_tag('/include/css/ico-moon-fonts2.css', 'stylesheet');

		//
		// Get Session Data
		//
		$this->layout->screen_name = $this->session->userdata('screen_name');

		//
		//	Translate menus
		// 
		$main_menu = array();
		foreach ($this->config->item('main_menu') AS $path => $data){
			
			// Remove the '/profile' link if the user is not logged in
			if ($this->session->userdata('logged_in') === FALSE && $path == '/profile')
			{
				continue;
			}
			$data['label'] = $this->xliff_reader->get( $data['lang-id'] );
			$main_menu[ $path ] = $data;
		}

		$tweet_menu = array();
		foreach ($this->config->item('tweet_menu') AS $path => $data){
			$data['label'] = $this->xliff_reader->get( $data['lang-id'] );
			$tweet_menu[ $path ] = $data;
		}

		$this->menu_generator->set_current_page( $this->get_current_url() );
		$this->menu_generator->load( $main_menu );

		
		$this->layout->main_menu = $this->menu_generator->generate('navMain'); 

		$this->menu_generator->load( $tweet_menu );
		$this->layout->tweet_menu = $this->menu_generator->generate('navTweet');
	}

	/**
	* Determine which languages the user's browser can understand
	*/
	public function get_user_languages(){
		$http_headers = getallheaders();
		
		if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) )
		{
			$data = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}
		else
		{
			$data = $http_headers['Accept-Language'];
		}

		if ( strpos($data, ';') !== FALSE )
		{
			list($data, $junk) = preg_split('/;/', $http_headers['Accept-Language']);
		}

		if ( strpos($data, ',') !== FALSE )
		{
			list($data, $junk) = preg_split('/,/', $data);
		}

		if (is_string($data))
		{
			return array( $data );
		}
		return $data;	
	}


	public function get_current_url()
	{
		$current_url = current_url();
		$site_url = rtrim(site_url(), '/');
	
		return str_replace($site_url, '', $current_url);
	}

	public function redirect_if_not_logged_in($page = 'home')
	{
		if (! $this->session->userdata('logged_in'))
		{
			// Send user to the homepage
			redirect( base_url() );
		}


	}

	
}

/* End of file EC_controller.php */
/* Location: ./application/core/EC_controller.php */

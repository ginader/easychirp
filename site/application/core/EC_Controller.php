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

		$supported = $this->config->item('supported_langs');

		$active_theme = $this->session->userdata('active_theme');
		if ( ! $active_theme)
		{
			$active_theme = $this->config->item('active_theme');
		}

		$lang_code = $this->session->userdata('lang_code');
		if ( ! $lang_code)
		{
			$lang_code = $this->config->item('site_language');
		}

		$pol_bool = $this->session->userdata('pol_bool');
		if ( ! $pol_bool)
		{
			$pol_bool = $this->config->item('pol_bool');
		}

		log_message('info', 'Before xliff->load lang_code=' . $lang_code);
		$this->xliff_reader->load( $lang_code );

		$this->layout->set_site_name('EasyChirp');
		// Output tagline only if on home page
		if($this->uri->total_segments() == 0) {
			$this->layout->set_tagline($this->xliff_reader->get('gbl-tagline'));
		}
		$this->layout->set_description('Easy Chirp is a web-based Twitter app with a simple interface. It is optimized for disabled users and works well with assistive technology such as screen readers. It also functions well with keyboard-only users, older browsers such as IE9, a lowband internet connection, and even no JavaScript.');

		// META TAGS
		$this->layout->add_meta_tag_name('charset', 'utf-8');
		$this->layout->add_meta_tag_name('author', 'Dennis E Lembree, Web Overhauls');
		$this->layout->add_meta_tag_name('viewport', 'width=device-width, initial-scale=1.0');
		$this->layout->add_meta_tag_name('verify-v1', '3gSFkFi1HCTZp2MP2dUh9mteuUJdRlMzx+HrFKopQN4=');
		$this->layout->add_meta_tag_name('keywords', 'accessible,Twitter,twitter,easy,website,Web,simple,web,site,accessibility,Accessibility,app,client,screenreader,screen reader,JAWS,NVDA,voiceover,IE8,application,low vision');

		$this->layout->add_meta_tag_name('twitter:card', 'summary');
		$this->layout->add_meta_tag_name('twitter:site', '@EasyChirp');
		$this->layout->add_meta_tag_name('twitter:creator', '@DennisL');
		$this->layout->add_meta_tag_name('twitter:url', 'http://www.easychirp.com/');
		$this->layout->add_meta_tag_name('twitter:title', 'Easy Chirp, a user-friendly web-based Twitter app');
		$this->layout->add_meta_tag_name('twitter:image', 'http://www.easychirp.com/images/brand/easy_chirp_icon_300.png');
		$this->layout->add_meta_tag_name('twitter:description', 'Easy Chirp is a web-based Twitter app with a simple interface. It is optimized for disabled users and works well with assistive technology such as screen readers. It also functions well with keyboard-only users, older browsers such as IE9, a lowband internet connection, and even no JavaScript.');

		$this->layout->add_link_tag('/images/brand/favicon.ico', 'shortcut icon');
		$this->layout->add_link_tag('/include/css/general.css', 'stylesheet', 'text/css');
		$this->layout->add_link_tag('/include/css/ico-moon-fonts2.css', 'stylesheet');

		// Add right-to-left stylesheet when language is Arabic
		if ($lang_code==='ar') {
			$this->layout->add_link_tag('/include/css/rtl.css', 'stylesheet');
		}

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
			if ( $this->session->userdata('logged_in') === FALSE && (strpos($data['id'], 'm_profile') !== false) )
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
		$this->layout->lang_menu = $this->config->item('supported_langs');
		$this->layout->theme_menu = $this->config->item('supported_themes');
		$this->layout->active_theme = $active_theme;
		$this->layout->lang_code = $lang_code;
		$this->layout->pol_bool = $pol_bool;
	}

	/**
	* Determine which languages the user's browser can understand
	*/
	public function get_user_languages(){
		if ( ! function_exists('getallheaders')){
			return array('en-US');
		}

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

	/**
	 * Describe your function
	 *
	 * @param string,boolean,integer,float,array,object,mixed,number $one a necessary parameter
	 * @param $two optional an optional value
	 * @return void
	 */
	public function set_default_timezone(){

		if (! ini_get('date.timezone')){
			date_default_timezone_set('UTC');
		}

	}

	/**
	* Deprecated Message for $_GET parameters;
	*
	* @param string,boolean,integer,float,array,object,mixed,number $one a necessary parameter
	* @param $two optional an optional value
	* @return void
	*/
	public function get_params_deprecated()
	{
		$trace = debug_backtrace();
		$info  = ' Called by ' . $trace[1]['class'] . '->' . $trace[1]['function'];
		if (isset($trace[1]['line']))
		{
			$info .= ' line ' . $trace[1]['line'];
		}

		$message = 'GET parameters are deprecated. Replace with a CodeIgniter implementation.';
		$message .= $info;
		$message .= ' It should either be part of the URL, so it gets passed as a function param';
		$message .= ' or as a POST value using $this->input->post("your_param") ';

		error_log($message);
	}

}

/* End of file EC_controller.php */
/* Location: ./application/core/EC_controller.php */

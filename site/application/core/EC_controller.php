<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EC_Controller extends CI_Controller {

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

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('debug');

		$this->layout->set_site_name('EasyChirp');
		$this->layout->set_tagline('web accessibility for the Twitter.com website application');
		$this->layout->set_description('Easy Chirp. Web accessibility for the Twitter web site application. The Twitter.com website redone with strict web standards and web accessibility. Great for screen readers, low-vision, beginners, older browsers, text-only browsers, and non-JavaScript.');

		// META TAGS
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

		$this->layout->add_link_tag('images/brand/favicon.ico', 'shortcut icon');
		$this->layout->add_link_tag('include/css/general.css', 'stylesheet', 'text/css');
		$this->layout->add_link_tag('include/css/ico-moon-fonts2.css', 'stylesheet');

		// $this->layout->add_script_tag('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');

	}

}

/* End of file EC_controller.php */
/* Location: ./application/core/EC_controller.php */

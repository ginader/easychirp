<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends EC_Controller {

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
		$this->layout->set_title('Home');
		$this->layout->set_description('Homepage description');
		$this->layout->set_skip_to_sign_in( TRUE );
		$this->layout->view('home');
	}

	public function about()
	{
		$this->layout->set_title('About');
		$this->layout->set_description('Description of About page');
		$this->layout->view('about');
	}

	public function articles()
	{
		$this->layout->set_title('Articles and Feedback');
		$this->layout->set_description('Description of Articles and Feedback page goes here');
		$this->layout->view('articles');
	}

	public function features()
	{
		$this->layout->set_title('Features');
		$this->layout->set_description('Description of Features page');
		$this->layout->view('features');
	}

	public function tips()
	{
		$this->layout->set_title('Tips');
		$this->layout->set_description('Description of Tips page');
		$this->layout->view('tips');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

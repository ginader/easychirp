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
		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->config->item('tw_access_key');
		$params[] = $this->config->item('tw_access_secret');

		$this->load->library('twitter_lib', $params);

		$easychirp_statuses = $this->twitter_lib->twitteroauth->get( 
			$this->config->item('tw_url_home_timeline') 
		);

		$data = array();
		$data['easychirp_statuses'] = $easychirp_statuses;
		$data['xliff_reader'] = $this->xliff_reader; 	
		
		$this->layout->set_title( $this->xliff_reader->get('Home') );
		$this->layout->set_description('Homepage description');
		$this->layout->set_skip_to_sign_in( TRUE );
		$this->layout->view('home', $data);
	}

	public function about()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('About');
		$this->layout->set_description('Description of About page');
		$this->layout->view('about', $data);
	}

	public function articles()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Articles and Feedback');
		$this->layout->set_description('Description of Articles and Feedback page goes here');
		$this->layout->view('articles', $data);
	}

	public function features()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Features');
		$this->layout->set_description('Description of Features page');
		$this->layout->view('features', $data);
	}

	public function followers()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Followers');
		$this->layout->set_description('Description of Followers page');
		$this->layout->view('followers', $data);
	}

	public function following()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Following');
		$this->layout->set_description('Description of Following page');
		$this->layout->view('following', $data);
	}

	public function lists()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Lists');
		$this->layout->set_description('Description of Lists page');
		$this->layout->view('lists', $data);
	}

	public function profile()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('My Profile');
		$this->layout->set_description('Details on my Twitter profile.');
		$this->layout->view('profile', $data);
	}

	public function profile_edit()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Edit Profile');
		$this->layout->set_description('Edit your Twitter account profile.');
		$this->layout->view('profile_edit', $data);
	}

	public function quote()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Quote');
		$this->layout->set_description('Quote a tweet.');
		$this->layout->view('quote', $data);
	}

	public function status()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('View Single Tweet');
		$this->layout->set_description('View a single status/tweet.');
		$this->layout->view('status', $data);
	}

	public function tips()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	


		$this->layout->set_title('Tips');
		$this->layout->set_description('Tips for this app, using Twitter, and recommended apps.');
		$this->layout->view('tips', $data);
	}

	public function user()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('User Details');
		$this->layout->set_description('Information for Twitter user.');
		$this->layout->view('user', $data);
	}

	public function timeline()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Timeline');
		$this->layout->set_description('Description of Timeline page');
		$this->layout->view('timeline', $data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

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

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$easychirp_statuses = $this->twitter_lib->twitteroauth->get( 
			$this->config->item('tw_url_home_timeline') 
		);
		
		$data = array();
		if ($easychirp_statuses->errors)
		{
			$data['error'] = $easychirp_statuses->errors[0]->message;
		}
		$data['easychirp_statuses'] = $easychirp_statuses;
		$data['xliff_reader'] = $this->xliff_reader; 	
		
		$this->layout->set_title( $this->xliff_reader->get('home') );
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

	public function favorites()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Favorites');
		$this->layout->set_description('Tweets user marked as a favorite.');
		$this->layout->view('favorites', $data);
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

	public function list_edit()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Edit List');
		$this->layout->set_description('Description of Edit List page');
		$this->layout->view('list_edit', $data);
	}

	public function mentions()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Mentions');
		$this->layout->set_description('Tweets that contain my user name.');
		$this->layout->view('mentions', $data);
	}

	public function mytweets()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('My Tweets');
		$this->layout->set_description('Tweets that I posted.');
		$this->layout->view('mytweets', $data);
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

	public function retweets()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Retweets');
		$this->layout->set_description('Links to retweet pages.');
		$this->layout->view('retweets', $data);
	}

	public function search()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Search');
		$this->layout->set_description('Search tweets, saved searches, and search users.');
		$this->layout->view('search', $data);
	}

	public function sign_in()
	{
		if ( isset($_SERVER["HTTP_REFERER"]) )
		{
			$this->session->set_userdata('previous_page', $_SERVER["HTTP_REFERER"]);
		}

		$access = (isset($_SESSION['access_token'])) ? $_SESSION['access_token'] : array();

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->config->item('tw_access_key');
		$params[] = $this->config->item('tw_access_secret');
		// $params[] = base_url() . $this->config->item('tw_callback_url');
		
		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		#--------
		# http://www.jondev.net/articles/Using_OAuth_with_Twitter_-_PHP_Example


		$callback_url = base_url() . $this->config->item('tw_callback_url');
		$consumer_key =  $this->config->item('tw_consumer_key'); 
		$consumer_secret = $this->config->item('tw_consumer_secret'); 

		// "http://twitter.com/oauth/request_token"; 
		$oauth_request_token = $this->twitter_lib->twitteroauth->requestTokenURL(); 
		$oauth_authorize = "http://twitter.com/oauth/authorize"; 
		$oauth_access_token = "http://twitter.com/oauth/access_token";

		$sig_method = new OAuthSignatureMethod_HMAC_SHA1(); 
		error_log('callback_url=' . callback_url);
		$test_consumer = new OAuthConsumer($consumer_key, $consumer_secret, $callback_url); 
		 
		$req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "GET", $oauth_request_token);     
		$req->sign_request($sig_method, $test_consumer, NULL); 
		  
		// debug_object( $reqData );

		$oc = new OAuthCurl(); 
		$reqData = $oc->fetchData($req->to_url()); 
		                   
		parse_str($reqData['content'], $reqOAuthData); 
							
		$req_token = new OAuthConsumer($reqOAuthData['oauth_token'], $reqOAuthData['oauth_token_secret'], $callback_url);
															 

		$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $req_token, "GET", $oauth_authorize); 
		$acc_req->sign_request($sig_method, $test_consumer, $req_token); 
		
		$session_data = array();	
		$session_data['oauth_token'] = $reqOAuthData['oauth_token']; 
		$session_data['oauth_token_secret'] = $reqOAuthData['oauth_token_secret']; 
		
		$this->session->set_userdata($session_data);
				   
		header("Location: $acc_req"); 
	}

	public function oauth_callback()
	{
		$oauth_token = $this->input->get('oauth_token', FALSE);	
		$oauth_verifier = $this->input->get('oauth_verifier', FALSE);	

		$callback_url = base_url() . $this->config->item('tw_callback_url');
		$consumer_key = $this->config->item('consumer_key'); 
		$consumer_secret = $this->config->item('consumer_secret'); 

		$this->load->library('twitter_lib');
		$param = array();
		$param[] = $consumer_key; 
		$param[] = $consumer_secret; 
		$this->twitter_lib->connect($param);	

		$oauth_access_token = $this->twitter_lib->twitteroauth->accessTokenURL();
		   
		$sig_method = new OAuthSignatureMethod_HMAC_SHA1(); 
		$test_consumer = new OAuthConsumer($consumer_key, $consumer_secret, $callback_url); 
		    
		$acc_token = new OAuthConsumer($_SESSION['oauth_token'], $_SESSION['oauth_token_secret'], 1); 
			                 
		$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $acc_token, "GET", $oauth_access_token); 
		$acc_req->sign_request($sig_method, $test_consumer, $acc_token); 
							  
		$oc = new OAuthCurl(); 
		$reqData = $oc->fetchData("{$acc_req}&oauth_verifier={$_GET['oauth_verifier']}"); 
		
		parse_str($reqData['content'], $accOAuthData); 
	

		if ( empty($accOAuthData['screen_name']) ){
			echo '<h2>Token Error</h2>';
			debug_object($accOAuthData, TRUE);
		}
		else
		{
			$session_data = array();
			$session_data['user_oauth_token'] = $accOAuthData['oauth_token']; 
			$session_data['user_oauth_token_secret'] = $accOAuthData['oauth_token_secret']; 
			$session_data['user_id'] = $accOAuthData['user_id']; 
			$session_data['screen_name'] = $accOAuthData['screen_name']; 
		
			$this->session->set_userdata($session_data);

			$next_page = ( isset($_SESSION['previous_page']) ) ? $_SESSION['previous_page'] : base_url();

			redirect( $next_page );
		}
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

	public function tools()
	{
		$data = array();
		$data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Tools');
		$this->layout->set_description('Tools including search, lists and trends.');
		$this->layout->view('tools', $data);
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

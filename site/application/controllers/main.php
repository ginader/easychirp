<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Main Controller for EasyChirp
 *
 * @package EasyChirp
 * @subpackage Controllers
 * @author EasyChirp Team
 */
class Main extends EC_Controller {

	private $_data = array();

	/**
	* Describe your function
	*
	* @param String $one a necessary parameter
	* @param String optional $two an optional value
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();

		$session_data = $this->session->all_userdata();
		if (isset($session_data['follower_count']))
		{
			$this->_data['follower_count']  = $session_data['follower_count']; 
			$this->_data['following_count'] = $session_data['following_count']; 
			$this->_data['tweet_count']     = $session_data['tweet_count']; 
			$this->_data['real_name']       = $session_data['real_name']; 
			$this->_data['time_zone']       = $session_data['time_zone']; 
		}
	
	}

	/**
	 * Manages the homepage.
	 *
	 * @return void
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
		
		
		if ( is_object($easychirp_statuses) && $easychirp_statuses->errors)
		{
			$this->_data['error'] = $easychirp_statuses->errors[0]->message;
		}
		$this->_data['easychirp_statuses'] = $easychirp_statuses;
		$this->_data['xliff_reader'] = $this->xliff_reader; 	
		
		$this->layout->set_title( $this->xliff_reader->get('home') );
		$this->layout->set_description('Homepage description');
		$this->layout->set_skip_to_sign_in( TRUE );
		$this->layout->view('home', $this->_data);
	}

	/**
	 * Manage the about page "/about"
	 *
	 * @return void
	 */
	public function about()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('About');
		$this->layout->set_description('All about Easy Chirp 2');
		$this->layout->view('about', $this->_data);
	}

	/**
	* Manages the articles page - /articles
	*
	* @return void
	*/
	public function articles()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Articles and Feedback');
		$this->layout->set_description('Articles, user feedback, books, wikis, and awards listed here.');
		$this->layout->view('articles', $this->_data);
	}

	public function direct()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Direct Messages');
		$this->layout->set_description('Send a direct message.');
		$this->layout->view('direct', $this->_data);
	}

	public function direct_inbox()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Inbox | Direct Messages');
		$this->layout->set_description('Direct messages sent to user.');
		$this->layout->view('direct_inbox', $this->_data);
	}

	public function direct_sent()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Sent | Direct Messages');
		$this->layout->set_description('Direct messages sent from user.');
		$this->layout->view('direct_sent', $this->_data);
	}

	public function favorites()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $this->session->userdata('screen_name');
		$tweets = $this->twitter_lib->get('favorites/list', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', array('tweets' => $tweets), TRUE);

		$this->layout->set_title('Favorites');
		$this->layout->set_description('Tweets that user marked as a favorite.');
		$this->layout->view('favorites', $this->_data);
	}

	/**
	* Manages the features page - /features
	*
	* @return void
	*/
	public function features()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Features');
		$this->layout->set_description('General and accessibility features of Easy Chirp.');
		$this->layout->view('features', $this->_data);
	}

	/**
	* Manages the followers page - /followers
	*
	* @return void
	*/
	public function followers()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Followers');
		$this->layout->set_description('Twitter users following me.');
		$this->layout->view('followers', $this->_data);
	}

	/**
	* Manages the following page - /following
	*
	* @return void
	*/
	public function following()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Following');
		$this->layout->set_description('Twitter users whom I am following.');
		$this->layout->view('following', $this->_data);
	}

	public function go_to_user()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Go To User');
		$this->layout->set_description('Go to user');
		$this->layout->view('go_to_user', $this->_data);
	}

	/**
	* Manages the lists page - /lists
	*
	* @return void
	*/
	public function lists()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Lists');
		$this->layout->set_description('Description of Lists page');
		$this->layout->view('lists', $this->_data);
	}

	/**
	* Manages the list_edit page - /list_edit
	*
	* @return void
	*/
	public function list_edit()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Edit List');
		$this->layout->set_description('Description of Edit List page');
		$this->layout->view('list_edit', $this->_data);
	}

	/**
	* Manages the Mentions page - /mentions
	*
	* @return void
	*/
	public function mentions()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	


		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $this->session->userdata('screen_name');
		$tweets = $this->twitter_lib->get('statuses/mentions_timeline', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', array('tweets' => $tweets), TRUE);

		$this->layout->set_title('Mentions');
		$this->layout->set_description('Tweets that contain my user name.');
		$this->layout->view('mentions', $this->_data);
	}

	/**
	* Manages the My Tweets page - /mytweets
	*
	* @return void
	*/
	public function mytweets()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $this->session->userdata('screen_name');
		$tweets = $this->twitter_lib->get('statuses/user_timeline', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', array('tweets' => $tweets), TRUE);

		$this->layout->set_title('My Tweets');
		$this->layout->set_description('Tweets that I posted.');
		$this->layout->view('mytweets', $this->_data);
	}

	/**
	* Manages the profile page - /profile
	*
	* @return void
	*/
	public function profile()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $this->session->userdata('screen_name');

		$this->_data['profile'] = $this->twitter_lib->get('users/show', $request_param );

		$this->layout->set_title('My Profile');
		$this->layout->set_description('Details on my Twitter profile.');
		$this->layout->view('profile', $this->_data);
	}

	/**
	* Manages the profile edit page - /profile_edit
	*
	* @return void
	*/
	public function profile_edit()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Edit Profile');
		$this->layout->set_description('Edit your Twitter account profile.');
		$this->layout->view('profile_edit', $this->_data);
	}

	/**
	* Manages the quote page - /quote
	*
	* @return void
	*/
	public function quote()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Quote');
		$this->layout->set_description('Quote a tweet.');
		$this->layout->view('quote', $this->_data);
	}

	/**
	* Manages the retweets page - /retweets
	*
	* @return void
	*/
	public function retweets()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $this->session->userdata('screen_name');
		$tweets = $this->twitter_lib->get('statuses/retweets_of_me', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', array('tweets' => $tweets), TRUE);

		$this->layout->set_title('Retweets');
		$this->layout->set_description('Links to retweet pages.');
		$this->layout->view('retweets', $this->_data);
	}
	
	/**
	 * Manage the search page - /search
	 *
	 * @param string $_POST['query'] the query you want to search via twitter
	 * @return void
	 */
	public function search($query)
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Search');
		$this->layout->set_description('Search tweets, saved searches, and search users.');
		$this->layout->view('search', $this->_data);
	}

	/**
	 * Manage the search results page - /search_results
	 *
	 * @param string $_POST['query'] the query you want to search via twitter
	 * @return void
	 */
	public function search_results($query)
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Search Results');
		$this->layout->set_description('Search results.');
		$this->layout->view('search_results', $this->_data);
	}

	/**
	 * Manage the sign in page - /sign_in
	 *
	 * Allows user to sign in to Twitter. Setup oauth tokens and send user to twitter to login
	 * Twitter will send the user to $this->oauth_callback();
	 *
	 * @return void
	 */
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
		error_log('callback_url=' . $callback_url);
		$test_consumer = new OAuthConsumer($consumer_key, $consumer_secret, $callback_url); 
		 
		$req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "GET", $oauth_request_token);     
		$req->sign_request($sig_method, $test_consumer, NULL); 
		  

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


	/**
	 * Manage the sign out page - /sign_out
	 *
	 * Allows user to sign out. Removes their user info from the session
	 *
	 * @return void
	 */
	public function sign_out()
	{
		$session_data = array();	
		$session_data['oauth_token'] = ''; 
		$session_data['oauth_token_secret'] = ''; 
		$session_data['user_id'] = ''; 
		$session_data['screen_name'] = ''; 
		$session_data['logged_in'] = FALSE; 

		$this->session->set_userdata($session_data);
		
		redirect( base_url() );
	}




	/**
	 * Handles the callback from twitter
	 *
	 * @param string $oauth_token A $_GET parameter 
	 * @param string $oauth_verifier A $_GET parameter
	 * @return void
	 */
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
		    
		$oauth_token = $this->session->userdata('oauth_token');
		$oauth_token_secret = $this->session->userdata('oauth_token');
		$acc_token = new OAuthConsumer($oauth_token, $oauth_token_secret, 1); 
			                 

		$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $acc_token, "GET", $oauth_access_token); 
		$acc_req->sign_request($sig_method, $test_consumer, $acc_token); 
							  

		$oc = new OAuthCurl(); 
		$reqData = $oc->fetchData("{$acc_req}&oauth_verifier={$oauth_verifier}"); 

		parse_str($reqData['content'], $accOAuthData); 
	

		if ( empty($accOAuthData['screen_name']) ){
			error_log('error callback - Failed login!');

			$session_data = array();
			$session_data['logged_in'] = false; 
				
			$this->session->set_userdata($session_data);
			redirect( base_url() );
		}
		else
		{

			$params = array();
			$params[] = $this->config->item('tw_consumer_key');
			$params[] = $this->config->item('tw_consumer_secret');
			$params[] = $this->session->userdata('user_oauth_token');
			$params[] = $this->session->userdata('user_oauth_token_secret');

			$this->load->library('twitter_lib');
			$this->twitter_lib->connect($params);

			$request_param = array();	
			$request_param['screen_name'] =  $this->session->userdata('screen_name');
			$user_data = $this->twitter_lib->get('users/show', $request_param );

			// debug_object( $user_data );


			error_log('successful callback');
			$session_data = array();
			$session_data['user_oauth_token'] = $accOAuthData['oauth_token']; 
			$session_data['user_oauth_token_secret'] = $accOAuthData['oauth_token_secret']; 
			$session_data['user_id'] = $accOAuthData['user_id']; 
			$session_data['screen_name'] = $accOAuthData['screen_name']; 
			$session_data['logged_in'] = TRUE; 

			$session_data['follower_count'] = $user_data->followers_count; 
			$session_data['tweet_count'] = $user_data->statuses_count; 
			$session_data['following_count'] = $user_data->friends_count; 
			$session_data['real_name'] = $accOAuthData['name']; 
			$session_data['time_zone'] = $accOAuthData['time_zone']; 
				
			$this->session->set_userdata($session_data);

			$next_page = base_url() . 'timeline'; 

			redirect( $next_page );
		}
	}


	/**
	* Manages the status page - /status
	*
	* @return void
	*/
	public function status()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('View Single Tweet');
		$this->layout->set_description('View a single status/tweet.');
		$this->layout->view('status', $this->_data);
	}

	/**
	* Manages the tips page - /tips
	*
	* @return void
	*/
	public function tips()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Tips');
		$this->layout->set_description('Tips for this app, using Twitter, and recommended apps.');
		$this->layout->view('tips', $this->_data);
	}

	/**
	* Manages the tools page - /tools
	*
	* @return void
	*/
	public function tools()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Tools');
		$this->layout->set_description('Tools including search, lists and trends.');
		$this->layout->view('tools', $this->_data);
	}

	/**
	* Manages the trends page - /trends
	*
	* @return void
	*/
	public function trends()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('Trends');
		$this->layout->set_description('Trending topics on Twitter.');
		$this->layout->view('trends', $this->_data);
	}

	/**
	* Manages the useer page - /user
	*
	* @return void
	*/
	public function user()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title('User Details');
		$this->layout->set_description('Information for Twitter user.');
		$this->layout->view('user', $this->_data);
	}

	/**
	* Manages the timeline page - /timeline
	*
	* @return void
	*/
	public function timeline()
	{
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $this->session->userdata('screen_name');
		$tweets = $this->twitter_lib->get('statuses/home_timeline', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', array('tweets' => $tweets), TRUE);


		$this->layout->set_title('Timeline');
		$this->layout->set_description('Description of Timeline page');
		$this->layout->view('timeline', $this->_data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

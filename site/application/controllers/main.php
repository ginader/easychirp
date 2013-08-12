<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Main Controller for EasyChirp
 *
 * @package EasyChirp
 * @subpackage Controllers
 * @author EasyChirp Team
 */
class Main extends EC_Controller {

	public $_data = array();

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

		if (isset($session_data['logged_in']))
		{
			$this->_data['logged_in'] = $session_data['logged_in']; 
		}
		else
		{
			$this->_data['logged_in'] = FALSE; 
		}

		if (isset($session_data['follower_count']))
		{
			$this->_data['follower_count'] = $session_data['follower_count']; 
		}
		else
		{
			$this->_data['follower_count'] = 0; 
		}


		if (isset($session_data['follower_count']))
		{
			$this->_data['following_count'] = $session_data['following_count']; 
		}
		else
		{
			$this->_data['following_count'] = 0; 
		}


		if (isset($session_data['follower_count']))
		{
			$this->_data['tweet_count'] = $session_data['tweet_count']; 
		}
		else
		{
			$this->_data['tweet_count'] = 0; 
		}


		if (isset($session_data['screen_name']))
		{
			$this->_data['screen_name'] =  $session_data['screen_name']; 
		}

		if (isset($session_data['time_zone'])) 
		{ 
			$this->_data['time_zone'] =  $session_data['time_zone']; 
		}

		$this->layout->set_logged_in($this->_data['logged_in']);
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

		$this->layout->set_title( $this->xliff_reader->get('about-h1') );
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

		$this->layout->set_title( $this->xliff_reader->get('articles-h1') );
		$this->layout->set_description('Articles, user feedback, books, wikis, and awards listed here.');
		$this->layout->view('articles', $this->_data);
	}

	public function direct()
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title( $this->xliff_reader->get('dm-h1') );
		$this->layout->set_description('Send a direct message.');
		$this->layout->view('direct', $this->_data);
	}

	public function direct_inbox()
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['include_entities'] = false;

		$dms = $this->twitter_lib->get('direct_messages', $request_param);
		$this->_data['dms'] = $this->load->view('fragments/dm', 
			array( 'dms' => $dms, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('dm-inbox') .' | '. $this->xliff_reader->get('dm-h1') );
		$this->layout->set_description('Direct messages sent to user.');
		$this->layout->view('direct_inbox', $this->_data);
	}

	public function direct_sent()
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['include_entities'] = false;

		$dms = $this->twitter_lib->get('direct_messages/sent', $request_param);
		$this->_data['dms'] = $this->load->view('fragments/dm', 
			array( 'dms' => $dms, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('dm-sent') .' | '. $this->xliff_reader->get('dm-h1') );
		$this->layout->set_description('Direct messages sent from user.');
		$this->layout->view('direct_sent', $this->_data);
	}

	public function favorites()
	{
		$this->redirect_if_not_logged_in();
		
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
		if ( isset($_GET["id"])) {
			$request_param['screen_name'] = $_GET["id"];
		}

		$tweets = $this->twitter_lib->get('favorites/list', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array('tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('favorites-h1') );
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

		$this->layout->set_title( $this->xliff_reader->get('features-h1') );
		$this->layout->set_description('General and accessibility features of Easy Chirp.');
		$this->layout->view('features', $this->_data);
	}

	/**
	* Manages the Followers page - /followers
	*
	* @return void
	*/
	public function followers()
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['skip_status'] =  true;
		if ( isset($_GET["id"])) {
			$request_param['screen_name'] = $_GET["id"];
		}

		$this->_data['f'] = $this->twitter_lib->get('followers/list', $request_param);

		$this->layout->set_title( $this->xliff_reader->get('followers-h1') );
		if ( isset($_GET["id"])) {
			$this->layout->set_title( $_GET["id"]." | ".$this->xliff_reader->get('followers-h1') );
		}
		$this->layout->set_description('Twitter users following me.');
		$this->layout->view('followers', $this->_data);
	}

	/**
	* Manages the Following page - /following AKA friends
	*
	* @return void
	*/
	public function following()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['skip_status'] =  true;
		if ( isset($_GET["id"])) {
			$request_param['screen_name'] = $_GET["id"];
		}

		$this->_data['f'] = $this->twitter_lib->get('friends/list', $request_param);

		$this->layout->set_title( $this->xliff_reader->get('following-h1') );
		if ( isset($_GET["id"])) {
			$this->layout->set_title( $_GET["id"]." | ".$this->xliff_reader->get('following-h1') );
		}
		$this->layout->set_description('Twitter users whom I am following.');
		$this->layout->view('following', $this->_data);
	}

	/**
	* Manages "go to user" page - /go_to_user
	*/
	public function go_to_user()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title( $this->xliff_reader->get('nav-goto-user') );
		$this->layout->set_description('Go to user');
		$this->layout->view('go_to_user', $this->_data);
	}

	/**
	* Manages the posting of "go to user" form - /go_user_action
	*/
	public function go_user_action()
	{
		$this->redirect_if_not_logged_in();

		$screen_name =  $_POST["screen_name"];
		$action =  $_POST["goUserAction"];

		if ($action == "profile") {
			redirect( base_url() . 'user?id=' . $screen_name );
		}
		else {
			redirect( base_url() . 'user_timeline?user=' . $screen_name );
		}
	}

	/**
	* Manages the lists page - /lists
	*
	* @return void
	*/
	public function lists()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$this->_data['myLists'] = $this->twitter_lib->get('lists/ownerships');
		$this->_data['subLists'] = $this->twitter_lib->get('lists/subscriptions');

		$this->layout->set_title( $this->xliff_reader->get('lists-h1') );
		$this->layout->set_description('Twitter lists of user');
		$this->layout->view('lists', $this->_data);
	}

	/**
	* Manages the list_edit page - /list_edit
	*
	* @return void
	*/
	public function list_edit()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['list_id'] =  $_GET['id'];
		$this->_data['list'] = $this->twitter_lib->get('lists/show', $request_param);

		$this->layout->set_title('Edit List'); // ****** NEED TO DO i18n ******
		$this->layout->set_description('Edit a Twitter List');
		$this->layout->view('list_edit', $this->_data);
	}

	/**
	* Manages the deletion of a list - /list_delete
	*
	* @return void
	*/
	public function list_delete($ajax = FALSE)
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['list_id'] = $_GET["id"];
		
		$tweet = $this->twitter_lib->post('lists/destroy', $request_param);
		if ($ajax) {
			echo json_encode($tweet);
		}
		else {
			redirect( base_url() . 'lists?deleted=true');
		}
	}

	/**
	* Manages the list_timeline page - /list_timeline
	*
	* @return void
	*/
	public function list_timeline()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['list_id'] =  $_GET['id'];

		$tweets = $this->twitter_lib->get('lists/statuses', $request_param);
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->_data['list_data'] = $this->twitter_lib->get('lists/show', $request_param);

		$x = $this->xliff_reader->get('lists-h1')." ".$this->xliff_reader->get('nav-timeline');
		$this->layout->set_title( $x );
		$this->layout->set_description('Lists Timeline');
		$this->layout->view('list_timeline', $this->_data);
	}

	/**
	* Manages the Mentions page - /mentions
	*
	* @return void
	*/
	public function mentions()
	{
		$this->redirect_if_not_logged_in();
		
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
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array('tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('mentions-h1') );
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
		$this->redirect_if_not_logged_in();

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
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array('tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('mytweets-h1') );
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
		$this->redirect_if_not_logged_in();
		
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

		$this->layout->set_title($this->xliff_reader->get('profile-h1'));
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
		$this->redirect_if_not_logged_in();
		
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

		$this->layout->set_title( $this->xliff_reader->get('edit-profile-h1') );
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
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['id'] =  $_GET["id"];

		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$tweets = array();
		$tweets[] = $data;

		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('quote-h1') );
		$this->layout->set_description('Quote a tweet.');
		$this->layout->view('quote', $this->_data);
	}

	/**
	* Manages the reply page - /reply
	*
	* @return void
	*/
	public function reply()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['id'] =  $_GET["id"];

		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$tweets = array();
		$tweets[] = $data;

		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('reply-h1') );
		$this->layout->set_description('Reply to a tweet.');
		$this->layout->view('reply', $this->_data);
	}

	/**
	* Manages the retweet page - /retweet
	*
	* @return void
	*/
	public function retweet()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['id'] =  $_GET["id"];

		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$tweets = array();
		$tweets[] = $data;

		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('retweet-h1') );
		$this->layout->set_description('Retweet a tweet.');
		$this->layout->view('retweet', $this->_data);
	}

	/**
	* Manages the retweets page - /retweets
	*
	* @return void
	*/
	public function retweets($retweet_type = FALSE)
	{
		$this->redirect_if_not_logged_in();
		
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

		$this->layout->set_title( $this->xliff_reader->get('nav-retweets') );
		if ($retweet_type === 'by_me')
		{
			$tweets = $this->retweets_by_me($request_param);
			$this->layout->set_title( $this->xliff_reader->get('nav-retweets-by-me') );
		}
		elseif ($retweet_type === 'of_me')
		{
			$tweets =  $this->retweets_of_me($request_param);
			$this->layout->set_title( $this->xliff_reader->get('nav-retweets-of-me') );
		}
		elseif ($retweet_type === 'to_me')
		{
			$tweets =  $this->retweets_to_me($request_param);
			$this->layout->set_title( $this->xliff_reader->get('nav-retweets-to-me') );
		}
		else
		{
			$tweets = array();
		}

		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array('type' => $retweet_type, 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		//$this->layout->set_title('Retweets'); // See logic above
		$this->layout->set_description('Links to retweet pages.');
		$this->layout->view('retweets', $this->_data);
	}

	/**
	* Tweets authored by others that I retweeted  
	*
	* @param array $params API query parameters
	* @return array 
	* @see https://dev.twitter.com/docs/api/1.1
	*/
	public function retweets_by_me($params)
	{
		$this->redirect_if_not_logged_in();

		$params['include_rts'] = 'true';
		$params['exclude_replies'] = 'true';

		$results = $this->twitter_lib->get('statuses/user_timeline', $params );
		$tweets = array();

		foreach ($results as $result)
		{
			if ($result->retweet_count > 0 && isset($result->retweeted_status))
			{
				$tweets[] = $result;
			}
		}

		return $tweets;
	}

	/**
	* Things that I tweeted that someone else retweeted 
	*
	* @param array $params API query parameters
	* @return array 
	*/
	public function retweets_of_me($params)
	{
		$this->redirect_if_not_logged_in();
		
		$tweets = $this->twitter_lib->get('statuses/retweets_of_me', $params );

		return $tweets;
	}

	/**
	* Tweets authored by other people retweeted by peope I follow 
	*
	* @param array $params API query parameters
	* @return array 
	* 
	* the method was removed in api 1.1 so instead call home_timeline and filter for RTs
	* @see https://dev.twitter.com/docs/api/1.1/get/statuses/home_timeline
	*/
	public function retweets_to_me($params)
	{
		$this->redirect_if_not_logged_in();

		$params['include_rts'] = 'true';
		$params['exclude_replies'] = 'true';
		$params['count'] = '60';

		$results = $this->twitter_lib->get('statuses/home_timeline', $params );
		$tweets = array();

		foreach ($results as $result)
		{
			if ($result->retweet_count > 0 && isset($result->retweeted_status))
			{
				$tweets[] = $result;
			}
		}

		return $tweets;
	}
	
	/**
	 * Manage the search page - /search
	 *
	 * @return void
	 */
	public function search()
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);
		$this->_data['saved_searches'] = $this->twitter_lib->get('saved_searches/list');

		$this->layout->set_title( $this->xliff_reader->get('search-h1') );
		$this->layout->set_description('Search tweets, saved searches, and search users.');
		$this->layout->view('search', $this->_data);
	}

	/**
	 * Manage the search results page - /search_results
	 */
	public function search_results()
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();
		$request_param['count'] = '25';
		if ( isset($_POST["query"]) ) {
			$request_param['q'] = $_POST["query"];
		}
		else {
			$request_param['q'] = $_GET["query"];
		}

		$data = $this->twitter_lib->get('search/tweets', $request_param);
		$this->_data['meta'] = $data->search_metadata;
		$this->_data['num'] = count($data->statuses);

		$tweets = $data->statuses;
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('search-results-h1') );
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
		$update_data = array();	
		$update_data['logged_in'] = FALSE; 
		$this->session->set_userdata($update_data);
		
		$delete_data = array();	
		$delete_data['screen_name'] = ''; 
		$this->session->set_userdata($delete_data);
		
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
		$this->load->library('twitter_lib');

		$oauth_token = $this->input->get('oauth_token', FALSE);	
		$oauth_verifier = $this->input->get('oauth_verifier', FALSE);	

		$callback_url = base_url() . $this->config->item('tw_callback_url');
		$consumer_key = $this->config->item('consumer_key'); 
		$consumer_secret = $this->config->item('consumer_secret'); 

		$param = array();
		$param[] = $consumer_key; 
		$param[] = $consumer_secret; 
		$this->twitter_lib->connect($param);	

		$oauth_access_token = $this->twitter_lib->twitteroauth->accessTokenURL();
		 
		$sig_method = new OAuthSignatureMethod_HMAC_SHA1(); 
		$test_consumer = new OAuthConsumer($consumer_key, $consumer_secret, $callback_url); 
		
		$oauth_token_secret = $oauth_verifier;
		$acc_token = new OAuthConsumer($oauth_token, $oauth_token_secret, 1); 
			                 

		$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $acc_token, "GET", $oauth_access_token); 
		$acc_req->sign_request($sig_method, $test_consumer, $acc_token); 
							  

		$oc = new OAuthCurl(); 
		$reqData = $oc->fetchData("{$acc_req}&oauth_verifier={$oauth_verifier}"); 
		
		$accOAuthData = array();
		parse_str($reqData['content'], $accOAuthData); 
	
		if ( empty($accOAuthData['screen_name']) ){
			error_log('error callback - Failed login!');

			$session_data = array();
			$session_data['logged_in'] = FALSE; 
				
			$this->session->set_userdata($session_data);
			redirect( base_url() );
		}
		else
		{
			$params = array();
			$params[] = $this->config->item('tw_consumer_key');
			$params[] = $this->config->item('tw_consumer_secret');
			$params[] = $accOAuthData['oauth_token']; 
			$params[] = $accOAuthData['oauth_token_secret'];

			$this->load->library('twitter_lib');
			$this->twitter_lib->connect($params);
			$this->twitter_lib->set_verify_peer( TRUE );

			$request_param = array();	
			$request_param['screen_name'] = $accOAuthData['screen_name'];
			$user_data = $this->twitter_lib->get('users/show', $request_param );

			if (isset($user_data->errors))
			{
				error_log('screen_name=' . $accOAuthData['screen_name'] . ' - message=' . $user_data->errors[0]->message);
			}

			error_log('successful callback');
			$session_data = array();
			$session_data['user_oauth_token']        = $accOAuthData['oauth_token']; 
			$session_data['user_oauth_token_secret'] = $accOAuthData['oauth_token_secret']; 
			$session_data['user_id']                 = $accOAuthData['user_id']; 
			$session_data['screen_name']             = $accOAuthData['screen_name']; 
			$session_data['logged_in']               = TRUE; 

			if (isset($user_data->followers_count)){
				$session_data['follower_count']  = $user_data->followers_count; 
				$session_data['following_count'] = $user_data->friends_count; 
				$session_data['tweet_count']     = $user_data->statuses_count; 
				$session_data['real_name']       = $user_data->name; 
				$session_data['time_zone']       = $user_data->time_zone; 
				$session_data['user_id']         = $user_data->id_str; 
			}
				
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
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['id'] =  $_GET["id"];

		// Get general data
		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$this->_data['show'] = $data;

		// Put data in array to then render in tweet fragment
		$tweets = array();
		$tweets[] = $data;
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title('View Single Tweet'); // ****** NEED TO DO i18n ******
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

		$this->layout->set_title( $this->xliff_reader->get('tips-h1') );
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
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$this->layout->set_title($this->xliff_reader->get('nav-tools'));
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
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		//$this->_data['trends_available'] = $this->twitter_lib->get('trends/available');

		$request_param = array();
		$request_param['id'] =  1;
		$this->_data['trends_worldwide'] = $this->twitter_lib->get('trends/place', $request_param);

		$this->layout->set_title( $this->xliff_reader->get('trends-h1') );
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
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] =  $_GET["id"];
		$this->_data['user'] = $this->twitter_lib->get('users/show', $request_param);

		$request_param['source_screen_name'] =  $this->session->userdata('screen_name');
		$request_param['target_screen_name'] =  $_GET["id"];
		$this->_data['friendship'] = $this->twitter_lib->get('friendships/show', $request_param);

		$this->layout->set_title( $this->xliff_reader->get('user-h1') );
		$this->layout->set_description('Information of Twitter user.');
		$this->layout->view('user', $this->_data);
	}

	/**
	* Manages the user timeline page - /user_timeline
	*
	* @return void
	*/
	public function user_timeline()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] = $_GET["user"];
		$tweets = $this->twitter_lib->get('statuses/user_timeline', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $_GET["user"]." | ".$this->xliff_reader->get('nav-timeline') );
		$this->layout->set_description('Timeline page');
		$this->layout->view('user_timeline', $this->_data);
	}

	/**
	* Manages the user lists page - /user_lists
	*
	* @return void
	*/
	public function user_lists()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();
		$request_param['screen_name'] = $_GET["id"];

		$this->_data['ownedLists'] = $this->twitter_lib->get('lists/ownerships', $request_param);
		$this->_data['subLists'] = $this->twitter_lib->get('lists/subscriptions', $request_param);

		$this->layout->set_title($_GET["id"]." | ".$this->xliff_reader->get('lists-h1'));
		$this->layout->set_description('User lists page');
		$this->layout->view('user_lists', $this->_data);
	}

	/**
	* Manages the timeline page - /timeline
	*
	* @return void
	*/
	public function timeline()
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['screen_name'] = $this->session->userdata('screen_name');
		$tweets = $this->twitter_lib->get('statuses/home_timeline', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('nav-timeline') );
		$this->layout->set_description('Timeline page');
		$this->layout->view('timeline', $this->_data);
	}

	/**
	* Manages the posting of a tweet page - /write_tweet
	*
	* @return void
	*/
	public function write_tweet($ajax = FALSE)
	{
		$this->redirect_if_not_logged_in();
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['status'] =  $_POST["status"];
		
		$tweet = $this->twitter_lib->post('statuses/update', $request_param);
		if ($ajax)
		{
			echo json_encode($tweet);
		}
		else
		{
			redirect( base_url() . 'timeline');
		}

	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

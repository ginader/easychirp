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
	 * Constructor. Retrieves session data and populates class data
	 *
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

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$ec_params = array();
		$ec_params['screen_name'] = 'easychirp';
		$ec_params['count'] = 40; //TWEETS_PER_PAGE_BRIEF;

		$favorites = array();
		$this->_data['favorites'] = $favorites;

		if ($this->session->userdata('logged_in'))
		{
			$favorites = $this->twitter_lib->get('favorites/list', $ec_params );
			$this->_data['favorites'] = $this->load->view('fragments/public_tweet',
				array(
				'tweets' => $favorites,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
				), TRUE);
		}

		$this->layout->set_title( $this->xliff_reader->get('articles-h1') );
		$this->layout->set_description('Articles, user feedback, books, wikis, and awards listed here.');
		$this->layout->view('articles', $this->_data);
	}
	

	/**
	 * /blocking -  Manage block & unblock.
	 *
	 * @param string $screen_name their twitter username
	 * @param string|bool $state Default is FALSE.
	 * @param string|bool $ajax Default is FALSE. when true data will be returned to browser as JSON
	 * @return void
	 */
	public function blocking($screen_name, $state = FALSE, $ajax = FALSE)
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
		$request_param['screen_name'] = $screen_name;

		if ($state == "create") {
			$post_url = "blocks/create";
			$action = "block_created";
		}
		else {
			$post_url = "blocks/destroy";
			$action = "block_destroyed";
		}

		$fav = $this->twitter_lib->post($post_url, $request_param);

		if ($ajax=="true") {
			echo json_encode($fav);
		}
		else {
			redirect( base_url() . 'user?id='.$screen_name.'&action='.$action);
		}
	}

	/**
	 * DM home/menu page
	 *
	 * @param string $screen_name the twitter username of the recipient.
	 * @param string $action optional. can be one of error-not-followed, sent, error-other, deleted
	 * @param string $message optional. the content of the message
	 * @return void
	 */
	public function direct($screen_name = '', $action = FALSE, $message = '')
	{
		$this->redirect_if_not_logged_in();

		$this->_data['screen_name'] = $screen_name;
		$this->_data['action'] = $action;
		$this->_data['msg'] = $message;
		$this->_data['xliff_reader'] = $this->xliff_reader;

		$this->layout->set_title( $this->xliff_reader->get('dm-h1') );
		$this->layout->set_description('Direct message menu.');
		$this->layout->view('direct', $this->_data);
	}

	/**
	 * Send a direct message to a user
	 *
	 * @param string $screen_name the twitter username of the recipient.
	 * @param string $action optional. can be one of error-not-followed, sent, error-other, deleted
	 * @param string $message optional. the content of the message
	 * @return void
	 */
	public function direct_send_page($screen_name = '', $action = FALSE, $message = '')
	{
		$this->redirect_if_not_logged_in();

		$this->_data['screen_name'] = $screen_name;
		$this->_data['action'] = $action;
		$this->_data['msg'] = $message;
		$this->_data['xliff_reader'] = $this->xliff_reader;

		$this->layout->set_title( $this->xliff_reader->get('dm-h2-send') );
		$this->layout->set_description('Send a direct message.');
		$this->layout->view('direct_send_page', $this->_data);
	}
	/**
	 * Send a direct message to a user
	 *
	 * @param string $action required. can be one of error-not-followed,sent,error-other,deleted
	 * @param string $message optional. the content of the message
	 * @param string $screen_name the twitter username of the recipient.
	 * @return void
	 */
	public function direct_action($action, $message = '', $screen_name = '')
	{
		switch ($action)
		{
		case "deleted":
		case "error-not-followed":
		case "error-other":
		case "sent":
			$this->direct_send_page($screen_name, $action, $message);
			break;

		default:
			throw new Exception('Invalid action provided');
		}
	}

	/**
	 * Actually sends the Direct Message(DM).
	 *
	 * @param string $_POST['tweep'] the username of the recipient
	 * @param string $_POST['message'] the content of the message
	 * @return void
	 */
	public function direct_send()
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
		$request_param['screen_name'] = $this->input->post('tweep');
		$request_param['text'] = $this->input->post('message');

		$data = $this->twitter_lib->post('direct_messages/new', $request_param);

		if (isset($data->errors[0]->code)) 
		{
			if ($data->errors[0]->code == 150) 
			{
				redirect(base_url('direct_action/error-not-followed/-/' . $request_param['screen_name']));
			}
			else 
			{
				$error_message = urlencode($data->errors[0]->message);
				redirect(base_url('direct_action/error-other/' .  $error_message));
			}
		}
		else 
		{
			redirect( base_url() . 'direct_action/sent/-/' . $request_param['screen_name']);
		}
	}

	/**
	 * Delete a Direct Message(DM)
	 *
	 * @param integer $id the unique ID of the DM you want to delete
	 * @param string $ajax optional. Default is FALSE. if true, data will be returned as JSON.
	 * @return void|json
	 */
	public function direct_delete($id, $ajax = FALSE)
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
		$request_param['id'] = $id;
		$request_param['include_entities'] = "false";

		$data = $this->twitter_lib->post('direct_messages/destroy', $request_param);

		if ($ajax == "true") {
			echo json_encode($data);
		}
		else {
			redirect( base_url() . 'direct?action=deleted');
		}
	}

	/**
	 * Render the current users dm_inbox
	 *
	 * @return void
	 */
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
			array( 
				'dms' => $dms,
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('dm-inbox') .' | '. $this->xliff_reader->get('dm-h1') );
		$this->layout->set_description('Direct messages sent to user.');
		$this->layout->view('direct_inbox', $this->_data);
	}

	/**
	 * The 'outbox' of the current user. a list of all the message they sent.
	 *
	 * @return void
	 */
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
			array( 
				'dms' => $dms, 
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('dm-sent') .' | '. $this->xliff_reader->get('dm-h1') );
		$this->layout->set_description('Direct messages sent from user.');
		$this->layout->view('direct_sent', $this->_data);
	}

	/**
	 * Display the favorite tweets for a user. Assumes current user if not specified.
	 *
	 * @param string $screen_name the twitter username
	 * @return void
	 */
	public function favorites($screen_name = FALSE, $tweet_id = FALSE)
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
		$request_param['count'] = TWEETS_PER_PAGE;
		if ($screen_name !== FALSE)
		{
			$request_param['screen_name'] = $screen_name;
			$this->_data['screen_name'] = $screen_name;
		}
		if ( $tweet_id) {
			$request_param['max_id'] = $tweet_id;
		}

		$pagination_path = '/favorites/' . $request_param['screen_name'] . '/';

		$tweets = $this->twitter_lib->get('favorites/list', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
			'paginate' => 1,
			'pagination_path' => $pagination_path,
			'tweets' => $tweets,
			'utc_offset' => $this->session->userdata('utc_offset'),
			'time_zone' => $this->session->userdata('time_zone'),
			'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$page_title = $this->xliff_reader->get('favorites-h1');
		if ($request_param['screen_name'] !== $this->session->userdata('screen_name')) 
		{
			$page_title = $request_param['screen_name'] . " | " . $this->xliff_reader->get('favorites-h1');
		}
		$this->layout->set_title( $page_title );
		$this->layout->set_description('Tweets that user marked as a favorite.');
		$this->layout->view('favorites', $this->_data);
	}

	/**
	* Creates or removes a favorite from a tweet - /favoriting
	*
	* @param integer $tweet_id the ID of the status "tweet"
	* @param string $state
	* @param string $ajax if true, a json encoded result will be echoed to browser. otherwise sent to new url
	* @return json|void
	*/
	public function favoriting($tweet_id, $state = FALSE, $ajax = FALSE)
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
		$request_param['id'] = $tweet_id;

		if ($state == "create") {
			$post_url = "favorites/create";
			$action = "favorite_created";
		}
		else {
			$post_url = "favorites/destroy";
			$action = "favorite_destroyed";
		}

		$fav = $this->twitter_lib->post($post_url, $request_param);

		if ($ajax=="true") {
			echo json_encode($fav);
		}
		else {
			redirect( base_url() . 'status?id='.$tweet_id.'&action='.$action);
		}
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
	 * @param string $screen_name. if not specified, the current user will be used.
	 * @return void
	 */
	public function followers($screen_name = FALSE)
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
		if (FALSE === $screen_name) 
		{
			$screen_name = $this->session->userdata('screen_name');
		}
		$request_param['screen_name'] = $screen_name;
		$this->_data['screen_name'] = $screen_name;

		$this->_data['f'] = $this->twitter_lib->get('followers/list', $request_param);

		$page_title = $this->xliff_reader->get('followers-h1');
		if ($screen_name !== $this->session->userdata('screen_name')) 
		{
			$page_title = $screen_name . " | " . $this->xliff_reader->get('followers-h1');
		}
		$this->layout->set_title( $page_title );
		$this->layout->set_description('Twitter users following me.');
		$this->layout->view('followers', $this->_data);
	}

	/**
	 * Manages the Following page - /following AKA friends
	 *
	 * @param string $screen_name. if not specified, the current user will be used.
	 * @return void
	 */
	public function following($screen_name = FALSE)
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
		if (FALSE === $screen_name) 
		{
			$screen_name = $this->session->userdata('screen_name');
		}
		$request_param['screen_name'] = $screen_name;
		$this->_data['screen_name'] = $screen_name;

		$this->_data['f'] = $this->twitter_lib->get('friends/list', $request_param);

		$page_title = $this->xliff_reader->get('following-h1');
		if ($screen_name !== $this->session->userdata('screen_name')) 
		{
			$page_title = $screen_name . " | " . $this->xliff_reader->get('following-h1');
		}
		$this->layout->set_title( $page_title );
		$this->layout->set_description('Twitter users whom I am following.');
		$this->layout->view('following', $this->_data);
	}


	/**
	 * gets tweet to make thread/conversation - /getResponse
	 * 
	 * @param integer $id the ID of the tweet
	 * @return void
	 */
	public function getResponse($id)
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
		$request_param['id'] = $id;

		$data = $this->twitter_lib->get('statuses/show', $request_param);
		$tweets = array();
		$tweets[] = $data;

		$theTweet = $this->load->view('fragments/tweet',
			array( 
			'tweets' => $tweets, 
			'utc_offset' => $this->session->userdata('utc_offset'),
			'time_zone' => $this->session->userdata('time_zone'),
			'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		/**
		 * Add ARIA and send back
		 *
		 * @todo move this to the tweet fragment.
		 */
		echo str_replace('class="tweet', 'aria-live="assertive" class="respond tweet', $theTweet);
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
			redirect( base_url() . 'user/' . $screen_name );
		}
		else {
			redirect( base_url() . 'user_timeline/' . $screen_name );
		}
	}

	/**
	 * Manages the homepage.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		if ($this->session->userdata('logged_in'))
		{
			// do something;
			$params[] = $this->session->userdata('user_oauth_token');
			$params[] = $this->session->userdata('user_oauth_token_secret');
		}

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$ec_params = array();
		$ec_params['screen_name'] = 'easychirp';
		$ec_params['count'] = TWEETS_PER_PAGE_BRIEF;

		$favorites = array();
		$this->_data['favorites'] = $favorites;

		if ($this->session->userdata('logged_in'))
		{
			$favorites = $this->twitter_lib->get('favorites/list', $ec_params );
			$this->_data['favorites'] = $this->load->view('fragments/public_tweet',
				array(
				'tweets' => $favorites,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
				), TRUE);
		}

		$ec_tweets = array();
		if ($this->session->userdata('logged_in'))
		{
			$ec_params['count'] = TWEETS_PER_PAGE;
			$ec_params['screen_name'] = "easychirp";
			$ec_tweets = $this->twitter_lib->get('statuses/user_timeline', $ec_params);
			if ( is_object($ec_tweets) && $ec_tweets->errors)
			{
				$this->_data['error'] = $ec_tweets->errors[0]->message;
			}
		}

		$this->_data['easychirp_statuses'] = $ec_tweets;

		$this->layout->set_title( $this->xliff_reader->get('home') );
		$this->layout->set_description('Homepage description');
		$this->layout->set_skip_to_sign_in( TRUE );
		$this->layout->view('home', $this->_data);
	}

	public function info()
	{
		phpinfo();
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
	 * Manages the editing of a list - /list_edit_action
	 */
	public function list_edit_action()
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
		$request_param['list_id'] = $_POST["list_id"];
		$request_param['name'] = $_POST["txt_listName"];
		$request_param['mode'] = $_POST["mode"];
		$request_param['description'] = $_POST["txt_listDesc"];

		$tweet = $this->twitter_lib->post('lists/update', $request_param);

		redirect( base_url() . 'list_edit?action=edited&id='.$_POST["list_id"]);
	}

	/**
	 * Manages the creation of a list - /list_create
	 *
	 * @param $ajax if true, content is returned to the browser as JSON.
	 * @param $_POST['txt_listName'] the name of the list to create
	 * @param $_POST['txt_listDesc'] the description of the new list
	 * @param $_POST['mode']
	 * @return json|void
	 */
	public function list_create($ajax = FALSE)
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		// Validation
		if ($_POST["txt_listName"]=="") {
			redirect( base_url() . 'lists?action=empty_name');
		}

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();
		$request_param['name'] = $_POST["txt_listName"];
		$request_param['mode'] = $_POST["mode"];
		$request_param['description'] = $_POST["txt_listDesc"];

		$tweet = $this->twitter_lib->post('lists/create', $request_param);
		if ($ajax) {
			echo json_encode($tweet);
		}
		else {
			redirect( base_url() . 'lists?action=created');
		}
	}

	/**
	 * Manages the addition of a member to a list - /list_add_member
	 *
	 * @param $ajax if true, content is returned to the browser as JSON.
	 */
	public function list_add_member($ajax = FALSE)
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;

		// Validation
		if ($_POST["userNameToAdd"]=="") {
			redirect( base_url() . 'lists?action=empty_add_name');
		}

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();
		$request_param['screen_name'] = $_POST["userNameToAdd"];
		$request_param['list_id'] = $_POST["lstid"];

		$tweet = $this->twitter_lib->post('lists/members/create', $request_param);
		if ($ajax) 
		{
			echo json_encode($tweet);
		}
		else 
		{
			redirect( base_url() . 'lists?action=member_added');
		}
	}

	/**
	 * Manages the deletion of a list - /list_delete
	 *
	 * @param $ajax if true, content is returned to the browser as JSON.
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
			redirect( base_url() . 'lists?action=deleted');
		}
	}

	/**
	 * Manages subscribing to a list - /list_subscribe
	 *
	 * @param $ajax if true, content is returned to the browser as JSON.
	 */
	public function list_subscribe($ajax = FALSE)
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

		$tweet = $this->twitter_lib->post('lists/subscribers/create', $request_param);
		if ($ajax) {
			echo json_encode($tweet);
		}
		else {
			redirect( base_url() . 'user_lists?id=' . $_GET["user"] . '&action=subscribed');
		}
	}

	/**
	 * Manages unsubscribing from a list - /list_unsubscribe
	 *
	 * @param $ajax if true, content is returned to the browser as JSON.
	 */
	public function list_unsubscribe($ajax = FALSE)
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

		$tweet = $this->twitter_lib->post('lists/subscribers/destroy', $request_param);
		if ($ajax) {
			echo json_encode($tweet);
		}
		else {
			redirect( base_url() . 'lists?action=unsubscribed');
		}
	}

	/**
	 * Manages the Subscribers page - /list_subscribers
	 *
	 * @param $list_owner, $list_id, $list_name
	 * @return void
	 */
	public function list_subscribers($list_owner, $list_id = FALSE, $list_name)
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
		$request_param['list_id'] = $list_id;

		$this->_data['f'] = $this->twitter_lib->get('lists/subscribers', $request_param);

		$this->_data['list_owner'] = $list_owner;
		$this->_data['list_id'] = $list_id;
		$this->_data['list_name'] = $list_name;

		$page_title = $this->xliff_reader->get('lists-subs');

		$this->layout->set_title( $page_title );
		$this->layout->set_description('Twitter users subscribed to a list.');
		$this->layout->view('list_subscribers', $this->_data);
	}

	/**
	 * Manages the Members page - /list_members
	 *
	 * @param $list_owner, $list_id, $list_name
	 * @return void
	 */
	public function list_members($list_owner, $list_id = FALSE, $list_name)
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
		$request_param['list_id'] = $list_id;

		$this->_data['f'] = $this->twitter_lib->get('lists/members', $request_param);

		$this->_data['list_owner'] = $list_owner;
		$this->_data['list_id'] = $list_id;
		$this->_data['list_name'] = $list_name;

		$page_title = $this->xliff_reader->get('lists-mems');

		$this->layout->set_title( $page_title );
		$this->layout->set_description('Users who are on a Twitter list.');
		$this->layout->view('list_members', $this->_data);
	}

	/**
	 * Manages the list_timeline page - /list_timeline
	 *
	 * @return void
	 */
	public function list_timeline($list_id, $subscribed = FALSE, $tweet_id = FALSE)
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
		$request_param['list_id'] = $list_id;
		$request_param['count'] = TWEETS_PER_PAGE;
		if ($tweet_id !== FALSE && $tweet_id !== "false") {
			$request_param['max_id'] = $tweet_id;
		}

		$pagination_path = '/list_timeline/'.$list_id.'/'.$subscribed.'/';

		$tweets = $this->twitter_lib->get('lists/statuses', $request_param);
		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'paginate' => 1,
				'pagination_path' => $pagination_path,
				'tweets' => $tweets, 
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->_data['list_data'] = $this->twitter_lib->get('lists/show', $request_param);

		$this->_data['subscribed'] = FALSE;
		if ($subscribed !== FALSE && $subscribed !== "false") {
			$this->_data['subscribed'] = TRUE;
		}

		$x = $this->xliff_reader->get('lists-h1')." ".$this->xliff_reader->get('nav-timeline');
		$this->layout->set_title( $x );
		$this->layout->set_description('Lists Timeline');
		$this->layout->view('list_timeline', $this->_data);
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
	 * Follows or unfollows user - /manage_follow_user
	 *
	 * @param string $screen_name twitter username of the desired user.
	 * @param string $state
	 * @param string $ajax if true, data will be returned as json. other will be sent to a new URL
	 * @return json|void
	 */
	public function manage_follow_user($screen_name, $state = FALSE, $ajax = FALSE)
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
		$request_param['screen_name'] = $screen_name;

		if ($state == "follow") {
			$post_url = "friendships/create";
			$action = "followed";
		}
		else {
			$post_url = "friendships/destroy";
			$action = "unfollowed";
		}

		$data = $this->twitter_lib->post($post_url, $request_param);

		if ($ajax=="true") {
			echo json_encode($data);
		}
		else {
			redirect( base_url() . 'user?id='.$screen_name.'&action='.$action);
		}
	}

	/**
	 * Manages the Mentions page - /mentions
	 *
	 * @return void
	 */
	public function mentions($tweet_id = FALSE)
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
		$request_param['count'] =  TWEETS_PER_PAGE;
		if ($tweet_id) {
			$request_param['max_id'] =  $tweet_id;
		}


		$tweets = $this->twitter_lib->get('statuses/mentions_timeline', $request_param );
		$tweets_data = array(
			'paginate' => 1,
			'pagination_path' => '/mentions/',
			'tweets' => $tweets,
			'utc_offset' => $this->session->userdata('utc_offset'),
			'time_zone' => $this->session->userdata('time_zone'),
			'xliff_reader' => $this->_data['xliff_reader']
		);

		if ($tweet_id) 
		{
			$tweets_data['last_id'] = $tweet_id; 
		}
		
		$this->_data['tweets'] = $this->load->view('fragments/tweet', $tweets_data , TRUE);

		$this->layout->set_title( $this->xliff_reader->get('mentions-h1') );
		$this->layout->set_description('Tweets that contain my user name.');
		$this->layout->view('mentions', $this->_data);
	}

	/**
	 * Manages the My Tweets page - /mytweets
	 *
	 * @return void
	 */
	public function mytweets($tweet_id = FALSE)
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
		$request_param['count'] = TWEETS_PER_PAGE;
		if ($tweet_id) {
			$request_param['max_id'] = $tweet_id;
		}

		$pagination_path = '/mytweets/';

		$tweets = $this->twitter_lib->get('statuses/user_timeline', $request_param );
		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'paginate' => 1,
				'pagination_path' => $pagination_path,
				'tweets' => $tweets,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('mytweets-h1') );
		$this->layout->set_description('Tweets that I posted.');
		$this->layout->view('mytweets', $this->_data);
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
			$session_data['utc_offset']              = -18000; // EST 5 hours behind UTC


			$lang_code = $this->session->userdata('lang_code');
			if (empty($lang_code)){
				$user_lang = substr($user_data->lang, 0, 2);
				if ( isset($config['supported_langs'][$user_lang]) ){
					$session_data['lang_code'] = $user_lang;
				} else {
					$session_data['lang_code'] = $this->config->item('site_language');
				}
			}

			if (isset($user_data->followers_count)){
				$session_data['follower_count']  = $user_data->followers_count;
				$session_data['following_count'] = $user_data->friends_count;
				$session_data['tweet_count']     = $user_data->statuses_count;
				$session_data['real_name']       = $user_data->name;
				$session_data['time_zone']       = $user_data->time_zone;
				$session_data['utc_offset']      = $user_data->utc_offset;
				$session_data['user_id']         = $user_data->id_str;
			}

			$this->session->set_userdata($session_data);

			$next_page = base_url() . 'timeline';

			redirect( $next_page );
		}
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
		$request_param['screen_name'] = $this->session->userdata('screen_name');

		$profile = $this->twitter_lib->get('users/show', $request_param );
		$this->_data['profile'] = $profile;

		$this->_data['follower_count']  = $profile->followers_count;
		$this->_data['following_count'] = $profile->friends_count;
		$this->_data['tweet_count']     = $profile->statuses_count;


		$request_param['count'] = 3; // This doesn't use TWEETS_PER_PAGE because it should only show a subset
		$tweets = $this->twitter_lib->get('statuses/user_timeline', $request_param );

		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'tweets' => $tweets,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title($this->xliff_reader->get('profile-h1'));
		$this->layout->set_description('Details on my Twitter profile.');
		$this->layout->view('profile', $this->_data);
	}

	/**
	 * Manages the form data from Edit Profile page - /profile_avatar_action
	 *
	 * @see https://dev.twitter.com/docs/api/1.1/post/account/update_profile_image
	 */
	public function profile_avatar_action()
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
		$file = $_FILES['avatar']['tmp_name'];
		$fh = fopen($file, "r");
		if ( ! $fh) {
			echo 'could not open file';
		}
		$imgbinary = fread($fh, filesize($file));
		$b64_image = base64_encode($imgbinary);

		$request_param['image'] =  $b64_image . ';type=image/jpg;filename=profile.jpg';

		$data = $this->twitter_lib->post('account/update_profile_image', $request_param);
		sleep(5); // wait 5 seconds. The twitter API method says so.

		redirect( base_url() . 'profile_edit?action=modified_avatar');
	}

	/**
	 * Manages the profile edit page - /profile_edit
	 */
	public function profile_edit($action = FALSE)
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
	 	$this->_data['profile'] = $this->twitter_lib->get('users/show', $request_param);

		if ($action)
		{
			$this->_data['action'] = $action;
		}

		$this->layout->set_title( $this->xliff_reader->get('edit-profile-h1') );
		$this->layout->set_description('Edit your Twitter account profile.');
		$this->layout->view('profile_edit', $this->_data);
	}

	/**
	 * Manages the form data from Edit Profile page - /profile_edit_action
	 */
	public function profile_edit_action()
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
		$request_param['name'] =  $this->input->post('name');
		$request_param['location'] =  $this->input->post('location');
		$request_param['description'] =  $this->input->post('description');
		$request_param['url'] =  $this->input->post('url');

		$data = $this->twitter_lib->post('account/update_profile', $request_param);

		redirect( base_url() . 'profile_edit?action=modified_text');
	}

	/**
	 * Manages the quote page - /quote
	 *
	 * @param int $tweet_id the ID of the status "tweet" you want to quote
	 * @return void
	 */
	public function quote($tweet_id = FALSE)
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
		$request_param['id'] =  $tweet_id;

		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$tweets = array();
		$tweets[] = $data;
		$reply_to = 'RT @' . $data->user->screen_name . ': ' . $data->text;
		$this->_data['page_heading'] = $this->xliff_reader->get('quote-h1');
		$this->_data['write_tweet_form'] = $this->load->view('fragments/write_tweet',
			array(
			'expand' => 1,
			'single' => '0',
			'reply_to' => $reply_to,
			'xliff_reader' => $this->_data['xliff_reader']),
			TRUE);

		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'tweets' => $tweets,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('quote-h1') );
		$this->layout->set_description('Quote a tweet.');
		$this->layout->view('timeline', $this->_data);
	}

	/**
	 * Manages the reply pages - /reply and /reply_all
	 *
	 * @param integer $tweet_id
	 * @param string|boolean $tweet_id the string 'all' will include the name of each user mentioned. Default is boolean false.
	 * @return void
	 */
	public function reply($tweet_id, $all = FALSE)
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
		$request_param['id'] =  $tweet_id;

		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$tweets = array();
		$tweets[] = $data;

		$twitter_ids = array();
		$twitter_ids[] = $data->user->screen_name;
		if ($all !== FALSE)
		{
			foreach ($data->entities->user_mentions AS $user){
				$twitter_ids[] = $user->screen_name;
			}
		}

		$reply_to = '';
		foreach ($twitter_ids AS $twitter_id)
		{
			$reply_to .= '@' . $twitter_id . ' ';
		}

		$in_reply_to = $data->id_str;

		$this->_data['page_heading'] = $this->xliff_reader->get('reply-h1');

		$this->_data['write_tweet_form'] = $this->load->view('fragments/write_tweet',
			array(
			'expand' => 1,
			'reply_to' => $reply_to,
			'in_reply_to' => $in_reply_to,
			'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
			'tweets' => $tweets,
			'utc_offset' => $this->session->userdata('utc_offset'),
			'time_zone' => $this->session->userdata('time_zone'),
			'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('reply-h1') );
		$this->layout->set_description('Reply to a tweet.');
		$this->layout->view('timeline', $this->_data);
	}

	/**
	* Manages the retweet page (for non-JS use case) - /retweet
	*
	* @todo REMOVE the GET parameter. Instead pass it through the URL as a parameter
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
			array( 
			'tweets' => $tweets, 
			'utc_offset' => $this->session->userdata('utc_offset'),
			'time_zone' => $this->session->userdata('time_zone'),
			'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);
		$this->_data['id'] = $request_param['id'];

		$this->layout->set_title( $this->xliff_reader->get('retweet-h1') );
		$this->layout->set_description('Retweet a tweet.');
		$this->layout->view('retweet', $this->_data);
	}

	/**
	 * Creates or removes a retweet - /retweet_action
	 *
	 * @param integer $tweet_id
	 * @param string $state
	 * @param string $ajax
	 * @return json|void
	 */
	public function retweet_action($tweet_id, $state = FALSE, $ajax = FALSE)
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

		if ($state == "create") {
			$post_url = "statuses/retweet/".$tweet_id;
			$action = "retweet_created";
		}
		else {
			$post_url = "statuses/destroy/".$tweet_id;
			$action = "retweet_destroyed";
		}

		$rt = $this->twitter_lib->post($post_url);

		if ($ajax=="true") {
			echo json_encode($rt);
		}
		else {
			redirect( base_url() . 'retweet?id='.$tweet_id.'&action='.$action);
		}
	}

	/**
	 * Reports a user as a spammer (which also blocks the user) - /report_spam
	 *
	 * @param string $screen_name
	 * @param string $ajax if true, data will be returned to browser as JSON
	 */
	public function report_spam($screen_name, $ajax = FALSE)
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
		$request_param['screen_name'] = $screen_name;

		$data = $this->twitter_lib->post('users/report_spam', $request_param);

		if ($ajax=="true") {
			echo json_encode($data);
		}
		else {
			redirect( base_url() . 'user?id='.$screen_name.'&action=reported');
		}
	}

	/**
	 * Manages the retweets page - /retweets
	 *
	 * @return void
	 */
	public function retweets($retweet_type = FALSE, $tweet_id = FALSE)
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
		$request_param['count'] = TWEETS_PER_PAGE;

		if ($tweet_id) {
			$request_param['max_id'] = $tweet_id;
		}

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

		$this->_data['write_tweet_form'] = $this->load->view('fragments/write_tweet',
			array( 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->_data['num'] = count($tweets);

		$pagination_path = '/retweets/' . $retweet_type . '/';

		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'paginate' => 1,
				'pagination_path' => $pagination_path,
				'type' => $retweet_type,
				'tweets' => $tweets,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

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
		$params['count'] = TWEETS_PER_PAGE;

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
	 * Created a saved search - /search_save
	 */
	public function search_save($ajax = FALSE)
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
		$request_param['query'] = $_GET["query"];
		$data = $this->twitter_lib->post('saved_searches/create', $request_param);

		if ($ajax == "true") {
			echo json_encode($data);
		}
		else {
			redirect( base_url() . 'search?action=saved');
		}
	}

	/**
	 * Delete a saved search - /search_delete
	 *
	 * @param integer $id the ID of the tweet
	 */
	public function search_delete($id)
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

		$del = $this->twitter_lib->post('saved_searches/destroy/'.$id);
		redirect( base_url() . 'search?action=deleted');
	}

	/**
	 * Display the search results page - /search_results
	 *
	 * @todo MODIFY items that call this to NOT USE GET parameters
	 * @param string $query
	 * @return void
	 */
	public function search_results($query = FALSE)
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
		$request_param['count'] = TWEETS_PER_PAGE;
		if ( isset($_POST["query"]) )
		{
			$request_param['q'] = $_POST["query"];
		}
		else 
		{
			if ($query === FALSE )
			{
				$request_param['q'] = $_GET["query"];
				$this->get_params_deprecated();
			}
			else
			{
				$request_param['q'] = $query;
			}

		}

		$data = $this->twitter_lib->get('search/tweets', $request_param);
		$this->_data['meta'] = $data->search_metadata;
		$this->_data['num'] = count($data->statuses);

		$tweets = $data->statuses;
		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'tweets' => $tweets,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title( $this->xliff_reader->get('search-results-h1') );
		$this->layout->set_description('Search results.');
		$this->layout->view('search_results', $this->_data);
	}

	/**
	 * Manage the search users page - /search_users
	 *
	 * @return void
	 */
	public function search_users()
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
		$request_param['q'] = $_POST["queryUsers"];

		$this->_data['users'] = $this->twitter_lib->get('users/search', $request_param);
		$this->_data['q'] = $_POST["queryUsers"];

		$this->layout->set_title( $this->xliff_reader->get('search-h2-users') );
		$this->layout->set_description('Search user results.');
		$this->layout->view('search_users', $this->_data);
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

		$callback_url = base_url() . $this->config->item('tw_callback_url');
		$consumer_key =  $this->config->item('tw_consumer_key');
		$consumer_secret = $this->config->item('tw_consumer_secret');

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
	 * Allows user to sign out. Removes their user info from the session. Sends user back to homepage
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
	 * Manages the status page - /status
	 *
	 * @todo change items the call this to remove GET parameters
	 * @return void
	 */
	public function status($tweet_id = FALSE)
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
		if ($tweet_id === FALSE)
		{
			$request_param['id'] = $_GET["id"];
			$this->get_params_deprecated();
		}
		else
		{
			$request_param['id'] = $tweet_id;
		}

		// Get general data
		$data = $this->twitter_lib->get('statuses/show', $request_param );
		$this->_data['show'] = $data;

		// Put data in array to then render in tweet fragment
		$tweets = array();
		$tweets[] = $data;
		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array( 
				'tweets' => $tweets, 
				'utc_offset' => $this->session->userdata('utc_offset'), 
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']
			), TRUE);

		$this->layout->set_title('View Single Tweet'); // ****** NEED TO DO i18n ******
		$this->layout->set_description('View a single status/tweet.');
		$this->layout->view('status', $this->_data);
	}

	/**
	 * Change user interface langauges
	 *
	 * @param string $lang_code the desired language code.
	 * @return void
	 */
	public function switch_lang($lang_code)
	{
		$this->_data['lang_code'] = $lang_code;
		$this->session->set_userdata('lang_code', $lang_code);

		redirect($_SERVER['HTTP_REFERER']);
	}


	/**
	 * Change themes
	 *
	 * @param string $theme the desired theme id
	 * @return void
	 */
	public function switch_theme($theme)
	{
		$this->_data['active_theme'] = $theme;
		$this->session->set_userdata('active_theme', $theme);

		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 * Manages the tips page - /test
	 *
	 * @return void
	 */
	public function test()
	{
		$utc_offset = $this->session->userdata('utc_offset');
		$time_zone = $this->session->userdata('time_zone');

		$this->_data['xliff_reader'] = $this->xliff_reader;
		$this->_data['user_langs'] = $this->get_user_languages();
		$this->_data['utc_offset'] = (empty($utc_offset)) ? 'No UTC offset' : $utc_offset; 
		$this->_data['time_zone'] = (empty($time_zone)) ? 'No Time Zone' : $time_zone;



		$this->layout->set_title( 'Test Page' );
		$this->layout->set_description('This is a Test Page');
		$this->layout->view('test', $this->_data);
	}


	/**
	 * Manages the timeline page - /timeline
	 * @todo add ajax in the future. Update to retrieve new tweets since page has been loaded.
	 *
	 * @param integer $tweet_id
	 * @param string $place where on the current timeline should be injected - use this for ajax
	 * @return void
	 */
	public function timeline($tweet_id = FALSE, $place = 'append')
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
		$request_param['count'] = TWEETS_PER_PAGE;
		$request_param['screen_name'] = $this->session->userdata('screen_name');

		if (FALSE !== $tweet_id)
		{
			// Most cases, the tweet_id is a numeric ID that uniquely identifies a tweet
			// if its not a integer, it's a username. It's the user that you're writing to
			if (! is_numeric($tweet_id))
			{
				$reply_to = '@' . $tweet_id . ' ';
			}
			else 
			{
				error_log('tweet_id=' . $tweet_id);
				$request_param['max_id'] = $tweet_id;
			}
		}

		$tweets = $this->twitter_lib->get('statuses/home_timeline', $request_param );
		
		$this->_data['page_heading'] = $this->xliff_reader->get('nav-timeline');

		$tweet_form_params = array( 'xliff_reader' => $this->_data['xliff_reader']);
		if (isset($reply_to))
		{
			$tweet_form_params['expand'] = 1;
			$tweet_form_params['reply_to'] = $reply_to;
		}

		if (isset($_GET["url_short"]))
		{
			if ($_GET["url_short"] != "")
			{
				$tweet_form_params['expand'] = 1;
			}
		}

		$this->_data['write_tweet_form'] = $this->load->view('fragments/write_tweet', 
			$tweet_form_params, TRUE);

		$utc_offset = $this->session->userdata('utc_offset');
		$this->_data['tweets'] = $this->load->view('fragments/tweet',
			array(
				'paginate' => 1,
				'tweets' => $tweets,
				'utc_offset' => $this->session->userdata('utc_offset'),
				'time_zone' => $this->session->userdata('time_zone'),
				'xliff_reader' => $this->_data['xliff_reader']),
			TRUE);

		$this->layout->set_title( $this->xliff_reader->get('nav-timeline') );
		$this->layout->set_description('Timeline page');
		$this->layout->view('timeline', $this->_data);
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
	 * Delete a tweet
	 *
	 * @param integer $id the id of the status "tweet" that you want to delete
	 * @param string $ajax optional. if true, content will be returned to the browser as JSON.
	 * @return json|void
	 */
	public function tweet_delete($id, $ajax = FALSE)
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

		$data = $this->twitter_lib->post('statuses/destroy/'.$id);

		if ($ajax == "true") {
			echo json_encode($data);
		}
		else {
			redirect( base_url() . 'timeline?action=tweet_deleted');
		}
	}

	/**
	 * Use a service to expand a short url
	 *
	 * @param string $_POST['service'] the ID of the Service e.g. bitly, webaim;
	 * @param string $_POST['url'] the URL you want to shorten
	 * @param string $_POST['ajax'] Default is FALSE.
	 * @return json|array JSON is returned when AJAX is used. otherwise returns an array 
	 *
	 */
	public function url_expand()
	{
		$this->load->library('url_shortener');

		$type = $this->input->post('urlService');
		$url  = $this->input->post('url');
		$ajax = $this->input->post('ajax');
		log_message('debug', 'main url_expand type=' . $type . " ajax=" . $ajax . " url=" . $url);

		$service = Url_shortener::get($type);	
		$result = $service->expand($url);
		log_message('debug', 'main url_expand result=' . print_r($result, TRUE));

		if ($ajax)
		{
			echo json_encode($result);
		}
		else
		{
			return $result;
		}
	}

	/**
	 * Use a service to shorten a long url
	 *
	 * @param string $_POST['service'] the ID of the Service e.g. bitly, webaim;
	 * @param string $_POST['url_long'] the URL you want to shorten
	 * @param string|bool $_POST['ajax'] Optional. Default is FALSE.
	 * @return json|void JSON is returned when AJAX is used. otherwise redirected to a URL
	 */
	public function url_shorten()
	{
		$this->load->library('url_shortener');

		$type = $this->input->post('urlService');
		$url  = $this->input->post('url_long');
		$ajax = $this->input->post('ajax');
		if (ctype_digit($ajax))
		{
			$ajax = (int) $ajax;
		}
		log_message('debug', 'main url_shorten type=' . $type . " ajax=" . $ajax . " url=" . $url);

		if (empty($url))
		{
			log_message('info', 'The URL is EMPTY');
			$error = array('status' => 'error', 'message' => 'URL is empty');
			if ($ajax)
			{
				echo json_encode($error);
				exit(0);
			}
			else
			{
				return $error;
			}
		}

		$service = Url_shortener::get($type);
		$result = $service->shorten($url);
		log_message('debug', 'main url_shorten result=' . print_r($result, TRUE));

		if ($ajax)
		{
			log_message('info', 'ajax response ' . print_r($result, true));
			echo json_encode($result);
		}
		else
		{
			log_message('info', 'redirect to timeline with short url=' . $result['short_url']);
			redirect( base_url() . "timeline?url_short=" . $result["short_url"] );
		}
	}

	/**
	 * Manages the useer page - /user
	 *
	 * @param $screen_name
	 * @return void
	 */
	public function user($screen_name = FALSE)
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
		if (FALSE === $screen_name)
		{
			$this->get_params_deprecated();
			$screen_name = $_GET["id"];
		}
		$request_param['screen_name'] =  $screen_name;

		$this->_data['user'] = $this->twitter_lib->get('users/show', $request_param);

		// Error handling
		if (isset($this->_data['user']->errors[0]->code)) {
			$this->_data['error'] = "not_found";
			$this->_data['user'] = $screen_name;
		}
		else {
			$request_param['count'] = 3; // This doesn't use TWEETS_PER_PAGE because it should only show a subset
			$tweets = $this->twitter_lib->get('statuses/user_timeline', $request_param);

			$this->_data['tweets'] = $this->load->view('fragments/tweet', 
				array(
					'tweets' => $tweets, 
					'utc_offset' => $this->session->userdata('utc_offset'),
					'time_zone' => $this->session->userdata('time_zone'),
					'xliff_reader' => $this->_data['xliff_reader']
				), TRUE);

			$request_param['source_screen_name'] =  $this->session->userdata('screen_name');
			$request_param['target_screen_name'] =  $screen_name;
			$this->_data['friendship'] = $this->twitter_lib->get('friendships/show', $request_param);
		}

		$this->layout->set_title( $this->xliff_reader->get('user-h1') );
		$this->layout->set_description('Information of Twitter user.');
		$this->layout->view('user', $this->_data);
	}

	/**
	 * Manages the user timeline page - /user_timeline
	 *
	 * @param string $screen_name
	 * @return void
	 */
	public function user_timeline($screen_name = FALSE)
	{
		$this->redirect_if_not_logged_in();

		if ($screen_name === FALSE)
		{
			$screen_name = $_GET['user'];
			$this->get_params_deprecated();
		}

		$this->_data['xliff_reader'] = $this->xliff_reader;

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();
		$request_param['screen_name'] = $screen_name;
		$request_param['count'] = TWEETS_PER_PAGE;
		$tweets = $this->twitter_lib->get('statuses/user_timeline', $request_param );

		// @todo create a page header for user timeline that lets the username be passed in.
		$this->_data['page_heading'] = $this->xliff_reader->get('nav-timeline') ." : @" . $screen_name;

		$tweet_form_params = array( 'xliff_reader' => $this->_data['xliff_reader']);

		$this->_data['write_tweet_form'] = $this->load->view('fragments/write_tweet',
			$tweet_form_params, TRUE);

		// Error handling
		if (isset($tweets->errors[0]->code)) {
			$this->_data['error'] = "not_found";
			$this->_data['user'] = $screen_name;
		}
		else {
			$this->_data['tweets'] = $this->load->view('fragments/tweet',
				array( 'tweets' => $tweets, 
					'utc_offset' => $this->session->userdata('utc_offset'),
					'time_zone' => $this->session->userdata('time_zone'),
					'xliff_reader' => $this->_data['xliff_reader']
				), TRUE);
		}

		$this->layout->set_title( $screen_name . " | " . $this->xliff_reader->get('nav-timeline') );
		$this->layout->set_description('Timeline page');
		$this->layout->view('timeline', $this->_data);
	}

	/**
	 * Manages the user lists page - /user_lists
	 *
	 * @param string $screen_name
	 * @return void
	 */
	public function user_lists($screen_name = FALSE)
	{
		$this->redirect_if_not_logged_in();

		$this->_data['xliff_reader'] = $this->xliff_reader;
		// $this->_data['screen_name'] is already set to the logged in user.
		// the $screen_name parameter overrides the default.
		if (FALSE !== $screen_name)
		{
			$this->_data['screen_name'] = $screen_name;
		}

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();
		$request_param['screen_name'] = $this->_data['screen_name'];

		$this->_data['ownedLists'] = $this->twitter_lib->get('lists/ownerships', $request_param);
		$this->_data['subLists'] = $this->twitter_lib->get('lists/subscriptions', $request_param);

		$this->get_params_deprecated();
		$this->layout->set_title($this->_data['screen_name'] . " | " . $this->xliff_reader->get('lists-h1'));
		$this->layout->set_description('User lists page');
		$this->layout->view('user_lists', $this->_data);
	}

}


/* End of file main.php */
/* Location: ./application/controllers/main.php */

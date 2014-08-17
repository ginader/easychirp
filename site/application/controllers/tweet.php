<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Main Controller for EasyChirp
 *
 * @package EasyChirp
 * @subpackage Controllers
 * @author EasyChirp Team
 */
 class Tweet extends EC_Controller {

	public $_data = array();

	/**
	* Describe your function
	*
	* @param string,boolean,integer,float,array,object,mixed,number $one a necessary parameter
	* @param $two optional an optional value
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

		if (isset($session_data['following_count']))
		{
			$this->_data['following_count'] = $session_data['following_count']; 
		}
		else
		{
			$this->_data['following_count'] = 0; 
		}

		if (isset($session_data['tweet_count']))
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

		$this->layout->set_logged_in($this->_data['logged_in']);
	 }

	public function reply($id)
	{

		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		$request_param = array();	
		$request_param['id'] =  $id;
		$tweets = array();
		$tweets[] = $this->twitter_lib->get('statuses/show', $request_param );
		
		$this->_data['xliff_reader'] = $this->xliff_reader; 	
		$this->_data['tweets'] = $this->load->view('fragments/tweet', 
			array( 'tweets' => $tweets, 'xliff_reader' => $this->_data['xliff_reader']), TRUE);

		$this->layout->set_title('Timeline');
		$this->layout->set_description('');
		$this->layout->view('timeline', $this->_data);
	}

	/**
	* Manages the posting of a tweet page - /write_tweet
	*
	* @return void
	*/
	public function write($ajax = FALSE)
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
		if (isset($_POST["in_reply_to_status_id"]))
		{
			$request_param['in_reply_to_status_id'] =  $_POST["in_reply_to_status_id"];
		}
		
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


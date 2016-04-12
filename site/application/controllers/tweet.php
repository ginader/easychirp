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

	/*******

	APPEARS NOT BEING USED. SHOULD MOVE REPLY & QUOTE FUNCTIONS FROM MAIN TO HERE.

	********/
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

		// Get tokens etc
		$params = array();
		$params[] = $this->config->item('tw_consumer_key');
		$params[] = $this->config->item('tw_consumer_secret');
		$params[] = $this->session->userdata('user_oauth_token');
		$params[] = $this->session->userdata('user_oauth_token_secret');

		$this->load->library('twitter_lib');
		$this->twitter_lib->connect($params);

		// Do image if provided
		$media_id = "";
		if ($_FILES['imagePath']['size'] != 0 ) {

			// Open image
			$file = $_FILES['imagePath']['tmp_name'];
			$fh = fopen($file, "r");
			if ( ! $fh) {
				echo 'Could not open file.';
			}

			// Check image type
			// Ref: http://www.php.net/manual/en/function.exif-imagetype.php
			$numType = exif_imagetype($file);
			if ($numType!==1 && $numType!==2 && $numType!==3 ) {
				echo "file must be GIF, JPG, or PNG";
				die;
			}

			// Check image size
			$maxsize = 5242880; // 5 Megs
			if($_FILES['imagePath']['size'] >= $maxsize) {
				echo 'The file size too large. The limit is 5 MB.';
				die;
			}

			// Convert image
			$imgbinary = fread($fh, filesize($file));
			$b64_image = base64_encode($imgbinary);

			$request_param_img = array();
			$request_param_img["media_data"] = $b64_image;

			// UPLOAD IMAGE AND GET MEDIA ID
			// Note: different domain! So adding upload parameter. https://upload.twitter.com/1.1/media/upload.json
			$img = $this->twitter_lib->post('media/upload', $request_param_img, $upload = TRUE);

			//DEBUG
			//echo debug_object( $img );
			//echo "<p>Type of above var $img: ".gettype($img)."</p>";

			// ATTACH ALT TO IMAGE
			$request_param_meta = array();
			$request_param_meta["media_id"] = $img->media_id;
			$request_param_meta["alt_text"]["text"] = $_POST['imageAlt'];
			//example: $request_param_meta = '{ "media_id": "'.$img->media_id.'", "alt_text": {"text": "'.$_POST['imageAlt'].'" }}';

			$imgMeta = $this->twitter_lib->post('media/metadata/create', $request_param_meta, $upload = "alt_text");

			//DEBUG
			//echo debug_object( $imgMeta );
			//echo "<p>Type of above var $imgMeta: ".gettype($imgMeta)."</p>";

			echo "<hr>";
			echo "<p>Filename: " . $_FILES['imagePath']['name'];
		}
		// DEBUG
		echo "<p>alt text: ".$_POST['imageAlt']."</p>";
		echo "<p>media_id: ".$img->media_id."</p>";


		exit; // *** STILL TESTING ***

/* JSON IMG RETURN
stdClass Object
(
    [media_id] => 697607213268013056
    [media_id_string] => 697607213268013056
    [size] => 7591
    [expires_after_secs] => 86400
    [image] => stdClass Object
        (
            [image_type] => image/jpeg
            [w] => 225
            [h] => 225
        )
)
*/

		// Post it!
		$request_param = array();
		$request_param['status'] = $_POST["status"];
		if (isset($_POST["in_reply_to_status_id"]))
		{
			$request_param['in_reply_to_status_id'] = $_POST["in_reply_to_status_id"];
		}
		if ($media_id != "")
		{
			$request_param['media_ids'] = $media_id;
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


<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Provides a factory to shorten url
*
* @package EasyChirp
* @subpackage Libraries
* @author Andrew Woods <atwoods1@gmail.com>
* @version 0.1
* 
*/
class Url_shortener
{
	public function __construct()
	{
		// do something;
	}

	public static function get($service)
	{
		switch ($service)
		{
		case 'bitly':
			return new Bitly();
			break;

		case 'webaim':
			return new Webaim();
			break;

		default:
			throw new Exception('Invalid URL shortening service');
		}
	}

}

/**
 * Provides an interface to unify the usage of multiple URL shortening services
 *
 * @package EasyChirp
 * @subpackage Interfaces
 * @author EasyChirp Dev Team
 */
interface Iurl_service
{
	public function shorten($url);
	public function expand($url);
}

/**
 * WebAim URL Shortening
 *
 * @package EasyChirp
 * @subpackage Libraries
 * @author EasyChrip Dev Team
 */
class Webaim implements Iurl_service
{
	private $service_url = 'http://weba.im/api.php';
	private $key = 'a11y';

	public function __construct() { }

	/**
	 * Create a short URL from a long URL
	 *
	 * @param string $one a necessary parameter
	 * @return array
	 *
	 * @see http://weba.im/api.php
	 */
	public function shorten($url)
	{
		$params = array();
		$params['action'] = 'shorturl';
		$params['url'] = urlencode($url);
		$params['format'] = 'json';
		$params['key'] = $this->key;
		$request_url = $this->service_url . '?' . http_build_query($params);
		log_message('info', 'webaim shorten request_url=' . $request_url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = json_decode(curl_exec($ch));

		if($response->status === 'fail')
		{
			log_message('error', 'Error from WEBAIM: ' .  $response->message);
			log_message('error', 'Curl error: ' . curl_error($ch));
			curl_close($ch);
			return array(
				'status' => 'error',
				'message' => $response->message
			);
		}

		curl_close($ch);
		return array(
			'status' => 'success',
			'message' => $response->message,
			'short_url' => $response->shorturl
		) ;
	}

	/**
	 * Expand a short URL to a long URL
	 *
	 * @param string $url a short url
	 * @return array
	 *
	 * @see http://weba.im/api.php
	 */
	public function expand($url)
	{
		$params = array();
		$params['action'] = 'expand';
		$params['shorturl'] = $url;
		$params['format'] = 'json';
		$params['key'] = $this->key;
		$request_url = $this->service_url . '?' . http_build_query($params);
		log_message('info', 'webaim expand request_url=' . $request_url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = json_decode(curl_exec($ch));
		log_message('info', 'webaim expand response=' . print_r($response, TRUE));

		if(isset($response->errorCode))
		{
			$message = $response->errorCode . ': ' .  $response->message;
			log_message('error', 'Error from WEBAIM: ' . $message);
			log_message('error', 'Curl error: ' . curl_error($ch));
			curl_close($ch);
			return array(
				'status' => 'error',
				'message' => $message
			);
		}

		curl_close($ch);
		return array(
			'status' => 'success',
			'message' => 'URL retrieved for ' . $response->shorturl,
			'url' => urldecode($response->longurl)
		) ;
	}

}


class Bitly implements Iurl_service
{
	/** Top level URL of the service */
	private $service_url = 'https://api-ssl.bitly.com';

	/** the username you login with at bitly.com  */
	private $username = 'o_42rtvbhinu';

	/** the password you login with on bitly.com */
	private $password = 'cure9292';

	/** the fields referred to as client_secret in Bitly's API documentation */
	private $secret = '';

	/** API KEY: R_e0641d85bf9c1d59f5c3a5458a4febdf */

	/** the token returned from the authenticate method */
	private $access_token = NULL;


	public function __construct() { }


	/**
	 * Provide your credentials to obtain an access token
	 *
	 * @param string $username a necessary parameter
	 * @param string $password optional an optional value
	 * @return bool
	 */
	public function authenticate()
	{
		$post_data = array();
		$post_data['client_id'] = $this->username;
		$post_data['client_secret'] = $this->secret;
		$post_data['format'] = 'json';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->service_url . '/oauth/access_token');
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		curl_close($ch);

		$result = array();
		switch ($response)
		{
		case 'INVALID_CLIENT_ID':
			$result['status'] = 'error';
			$result['message'] = $response;
			break;

		default:
			$result['status'] = 'success';
			$result['content'] = $response;
		}

		return $result;
	}


	/**
	 * Expand a short URL to a long URL
	 *
	 * @param string $url a short url
	 * @return array
	 *
	 * @see http://dev.bitly.com/links.html#v3_expand
	 */
	public function expand($url)
	{
		if ( ! $this->access_token)
		{
			$auth_result = $this->authenticate();
			if ($auth_result['status'] == 'success')
			{
				$this->access_token = $auth_result['content'];
			}
		}

		$query = array();
		$query['access_token'] = $this->access_token;
		$query['shortUrl'] = $url;

		$get_url = $this->service_url . '/v3/expand?' . http_build_query($query);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $get_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);

		$response = array();
		$response['message'] = $result->status_txt;
		$response['status'] = $result->status_code;
		if ($result->status_code == 200)
		{
			$response['long_url'] = $result->data->expand[0]->long_url;
		}

		return $response;
	}


	/**
	 * Create a short URL from a long URL
	 *
	 * @param string $url a long URL that you want to shorten
	 * @return array
	 *
	 * @see http://dev.bitly.com/links.html#v3_shorten
	 */
	public function shorten($url)
	{
		if ( ! $this->access_token)
		{
			$auth_result = $this->authenticate();
			if ($auth_result['status'] == 'success')
			{
				$this->access_token = $auth_result['content'];
			}
		}

		$query = array();
		$query['access_token'] = $this->access_token;
		$query['longUrl'] = $url;

		$get_url = $this->service_url . '/v3/shorten?' . http_build_query($query);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $get_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);

		$response = array();
		$response['message'] = $result->status_txt;
		$response['status'] = $result->status_code;
		if ($result->status_code == 200)
		{
			$response['short_url'] = $result->data->url;
		}

		return $response;
	}

}


/* End of file url_shortener.php */ 
/* Location: ./application/libraries/url_shortener.php */

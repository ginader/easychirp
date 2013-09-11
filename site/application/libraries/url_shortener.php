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

/* End of file url_shortener.php */ 
/* Location: ./application/libraries/url_shortener.php */

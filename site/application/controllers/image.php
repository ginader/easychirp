<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image Controller for EasyChirp
 *
 * @package EasyChirp
 * @subpackage Controllers
 * @author EasyChirp Team
 */
class Image extends CI_Controller {

	public $_data = array();

	/**
	 * Manages the image page - /img
	 * this page is public
	 * uses IMGUR API
	 */
	public function img($id)
	{
		// Use $id to get image data from service

		// Get image data from API
		$client_id = "8ad419cacdc4c52";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image/'.$id);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);
		curl_close ($curl);

		$imgData = json_decode($response,false);
		//print_r($imgData); die;

		// Parse the image extension, title, and description
		$imgExt = "jpg";//$imgData -> data -> ; // TODO use type property
		if (isset($imgData->data->title)) {
			$imgTitle = $imgData->data->title;
		}
		else {
			$imgTitle = "[no title available]";
		}
		if (isset($imgData->data->description)) {
			$imgDesc = $imgData->data->description;
		}
		else {
			$imgDesc = "[no description available]";
		}
		$_data["width"] = $imgData->data->width;
		$_data["height"] = $imgData->data->height;

		// Set vars for image URL and image title
		$_data["url"] = "https://i.imgur.com/".$id."l.".$imgExt;
		$_data["title"] = $imgTitle;
		
		// Create dataURI for longdesc
		$longdescStr = '<html><head><title>Description: '.$imgTitle.'</title><meta charset="utf-8"></head><body>'.$imgDesc.'</body></html>';
		$_data["longdescUri"] = "data:text/html;base64," . base64_encode($longdescStr);

		$this->load->view("img", $_data);
	}

}


/* End of file image.php */
/* Location: ./application/controllers/image.php */

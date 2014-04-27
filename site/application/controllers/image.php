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
	 * Manages the image posting to Imgur - /imgPost
	 * uses IMGUR API
	 */
	public function img_post()
	{
		//$this->redirect_if_not_logged_in();

		$ajax = $this->input->post('ajax');

		//Check if blank
		if ($_FILES['imagePath']['tmp_name'] == '') {
			echo "No filename found.";
			exit;
		}

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

		// Push image, title, and description to API
		$client_id = "8ad419cacdc4c52";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image');
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		curl_setopt($curl, CURLOPT_POSTFIELDS, array( 'image' => $b64_image, 'title' => $_POST['imageTitle'], 'description' => $_POST['imageDesc'] ));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);
		curl_close ($curl);

		$imgData = json_decode($response,false);

		if (isset($imgData->data->link)) {
			if ($ajax) {
				//log_message('info', 'ajax response ' . print_r($result, true));
				echo $imgData->data->id;
			}
			else {
				//log_message('info', 'redirect to timeline with image');
				redirect(base_url() . "timeline?img_url=http://easychirp.com/img/" . $imgData->data->id);
			}
		}
		else {
			if ($ajax) {
				echo $imgData->data->error;
			}
			else {
				echo "<h2>Sorry, there's an error.</h2>";
				echo "<p>".$imgData->data->error."</p>";
			}
		}
	}


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

		// Set the image extension, title, and description
		// Image
		$imgType = $imgData->data->link;
		$imgExt = "jpg";
		if ($imgType == "image/gif") {
			$imgExt = "gif";
		}
		else if ($imgType == "image/png") {
			$imgExt = "png";
		}
		// Title
		if (isset($imgData->data->title)) {
			$imgTitle = $imgData->data->title;
		}
		else {
			$imgTitle = "[no title available]";
		}
		// Description
		if (isset($imgData->data->description)) {
			$imgDesc = $imgData->data->description;
		}
		else {
			$imgDesc = "[no description available]";
		}

		$isAnimated = $imgData->data->animated;

		// Set var for image URL
		// If animated, get the original image, otherwide get large thumbnail
		if ($isAnimated) {
			$_data["url"] = "https://i.imgur.com/".$id.".".$imgExt;
		}
		else {
			$_data["url"] = "https://i.imgur.com/".$id."l.".$imgExt;
		}

		// Set var for image title
		$_data["title"] = $imgTitle;
		
		// Create dataURI for longdesc
		$longdescStr = '<html><head><title>Description: '.$imgTitle.'</title><meta charset="utf-8"></head><body>'.$imgDesc.'</body></html>';
		$_data["longdescUri"] = "data:text/html;base64," . base64_encode($longdescStr);

		$this->load->view("img", $_data);
	}

}


/* End of file image.php */
/* Location: ./application/controllers/image.php */

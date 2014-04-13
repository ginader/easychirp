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
	 */
	public function img($id)
	{
		// Use $id to get image data from service
		// Parse the image URL, title, and description
		// Use the 'image' template to output the HTML

		// Dummy/fake data (would come from API)
		$url = "http://www.webaxe.org/wp-content/uploads/2013/08/tl-horizontal_main1.jpg";
		$title = "Coffee Cup Caffeine Infographic";
		$longdesc = "<p>9 kinds of coffee, each with a coffee mug that displays an amount of coffee relative to the level of caffeine. Each amount below is in milligrams of caffeine per fluid ounce.</p><ol reversed><li>McDonald&rsquo;s: 9.1</li><li>Seattle&rsquo;s Best: 10.4</li><li>Biggby Coffee: 12.5</li><li>Dunkin&rsquo;Donuts: 12.7</li><li>Dutch Bros. Coffee: 12.8</li><li>Caribou Coffee: 15</li><li>Peet&rsquo;s: 16.7</li><li>Starbucks: 20.6</li><li>Deathwish coffee: 54.2</li></ol>";
		
		// Set page data vars
		$_data["url"] = $url;
		$_data["title"] = $title . " " . $id;
		$_data["longdesc"] = $longdesc;
		
		// Create dataURI for longdesc page
		$longdescStr = '<html><head><title>Description: '.$title.'</title><meta charset="utf-8"></head><body>'.$longdesc.'</body></html>';
		$_data["longdescUri"] = "data:text/html;base64," . base64_encode($longdescStr);

		$this->load->view("img", $_data);
	}

}


/* End of file image.php */
/* Location: ./application/controllers/image.php */

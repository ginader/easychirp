<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Donate Controller for EasyChirp
 *
 * @package EasyChirp
 * @subpackage Controllers
 * @author EasyChirp Team
 */
class Donate extends CI_Controller {

	//public $_data = array();

	/**
	 * Manages the donation thank-you page - /donate_thank
	 */
	public function donate_thank()
	{
		$this->load->view("donate_thank");//, $_data);
	}

}


/* End of file image.php */
/* Location: ./application/controllers/donate.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OAuthModel extends CI_Model {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
		$this->load->database();
	}
	
}

?>
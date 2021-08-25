<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		

	}

	public function index(){
		
		$data['title'] = 'Article';
		$data['page'] = 'article_view';
		$this->load->view('public/root',$data);
		//exit;
	}
}
?>
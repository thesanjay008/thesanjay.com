<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {
	
	public function __construct(){
		ob_start();
		date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->model('postmodel');
		$this->load->model('usersmodel');
		$this->load->model('genraloptions');
		$this->load->model('restModel');
		$this->admin_bar();
	}
	
	public function admin_bar(){
		if($this->session->userdata('user_role') == 'administrator'){
			echo '<div style="background:#000; padding:4px 20px;">';
			echo '<a href="'. SITEURL .'/admin" style="background-color:#f4f4f4; color:#444; text-decoration:none; border-radius:3px; border:1px solid transparent; padding:2px 10px; font-size: 13px;">Go to admin panel</a>';
			echo '</div>';
		}
	}
	
	public function index(){
		$page = 'first-page';
		$data['genraloptions']= $this->genraloptions->index();
		$data['title'] = $data['genraloptions']['site_title'];
		$data['page'] = $page;
		$this->load->view(THEME.'/'.$page,$data);
	}
	
	public function view($slug){
		$slug = trim($slug);
		$page = '404';
		$data['genraloptions']= $this->genraloptions->index();
		$data['login_info']= $this->usersmodel->login_user();
		$result = $this->postmodel->get_post_by_slug($slug);
		if(empty($result)){
			$data['title'] = '404';
			$data['page'] = '404';
			$this->load->view(THEME.'/'.$page,$data);
		}else{
			if($result['post_type'] == 'post'){
				$page = 'single';
			}else if($result['post_type'] == 'page'){
				$page = 'page';
				if($result['post_template'] != ''){
					$page = $result['post_template'];
				}
				
			}else{
				$page = 'index';
			}
			$data['title'] = $result['post_title'];
			$data['page'] = $page;
			$data['post_data'] = $result;
			$this->load->view(THEME.'/'.$page,$data);
		}
	}
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('genraloptions');
		$this->load->model('usersModel');
		$data['genraloptions']= $this->genraloptions->index();
	}
	
	public function index(){
		if($this->session->userdata('user_id')){
			return redirect('admin/dashboard');
		}
		$data['genraloptions']= $this->genraloptions->index();
		$this->load->helper('form');
		$this->load->view('admin/login', $data);
	}

	public function auth(){
		$this->load->library('form_validation');
		$data['genraloptions']= $this->genraloptions->index();
		
		if($this->form_validation->run('admin_login')){
			//Success
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			
			$user_data = $this->usersModel->login($username, $password);
			
			if($user_data){
				$this->session->set_userdata($user_data);
				return redirect(SITEURL);
			}else{
				$this->session->set_flashdata('login_failed', 'Invalid username OR password.');
				$this->load->view('admin/login', $data);
			}
		}else{
			$this->load->view('admin/login', $data);
		}
	}
}

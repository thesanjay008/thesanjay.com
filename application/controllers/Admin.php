<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		if(! $this->session->userdata('user_id')){
			return redirect('login');
		}
		if($this->session->userdata('user_role') != 'administrator'){
			exit('Unauthorise Access!');
		}
		$this->load->helper('form');
		$this->load->model('postmodel');
		$this->load->model('usersmodel');
		$this->load->model('genraloptions');
		$data['genraloptions']= $this->genraloptions->index();
		$data['login_user_info']= $this->usersmodel->login_user();
		$this->load->view('admin/head',$data);
	}

	public function index(){
		return redirect('admin/dashboard');
	}

	public function dashboard(){
		$data['users']= $this->usersmodel->get_users();
		$data['loan_data']= '';
		$data['recent_loans']= '';
		$data['upcoming_instalment']= '';
		
		$data['page']= 'dashboard';
		$data['page_title']= 'Dashboard';
		$this->load->view('admin/root',$data);
	}

	/* POST DATA*/
	public function view(){
		$post_type = $this->input->get('post_type', TRUE);
		if(empty($post_type)){
			$post_type = 'post';
		}
		$data['post_type'] = $post_type;
		$data['page_title'] = ucfirst($post_type);
		$data['post_data'] = $this->postmodel->get_post_list($post_type, 1, 20);
		
		$data['page'] = 'post_list';
		$this->load->view('admin/root',$data);
	}
	
	public function add_new($post_type=null){
		$post_type = $this->uri->segment('3');
		$data = $this->postmodel->add_new($post_type);
		redirect('admin/edit/'.$data, 'refresh');
	}
	
	public function edit($post_id=null){
		$post_id = $this->uri->segment('3');
		$data = $this->postmodel->get_post($post_id);
		if(empty($data)){
			redirect('admin/dashboard');
		}
		
		$is_post_title = 'Add';
		if($data['post_modified'] != 0){
			$is_post_title = 'Edit';
		}
		
		$data['page_title'] = $is_post_title .' ' . $data['post_type'];
		$data['post_id'] = $data['post_id'];
		$data['post_type'] = $data['post_type'];
		$data['page'] = 'post_save';
		$data['details'] = $data;
		$this->load->view('admin/root',$data);
	}
	
	/* PLANS */
	public function plans($action = null, $plan_id = null){
		$action  = $this->uri->segment('3');
		$user_id = $this->uri->segment('4');
		$current = $this->input->get('current');
		$count	 = $this->input->get('count');
		
		if($action == 'add'){
			$data['page']= 'add_plan';
			$data['page_title']= 'Add Plan';
			$this->load->view('admin/root', $data);
			
		}else if($action == 'edit'){
			
			//$user = $this->usersmodel->get_user_by_id($user_id);
			$data['page']= 'edit_plan';
			$data['page_title']= 'Add User';
			$this->load->view('admin/root', $data);
			
		}else{
			$data['users']= $this->usersmodel->get_users(0, $current, $count);
			$data['page']= 'plan-list';
			$data['page_title']= 'All Plans';
			$this->load->view('admin/root', $data);
		}
	}
	
	/* USERS */
	public function users($action = null, $user_id = null){
		$action  = $this->uri->segment('3');
		$user_id = $this->uri->segment('4');
		$current = $this->input->get('current');
		$count	 = $this->input->get('count');
		
		if($action == 'add'){
			$data['page']= 'add_user';
			$data['page_title']= 'Add User';
			$this->load->view('admin/root', $data);
			
		}else if($action == 'edit'){
			if(empty($user_id)){
				return redirect('admin/users');
			}
			$user = $this->usersmodel->get_user_by_id($user_id);
			$data['page']= 'edit_user';
			$data['page_title']= 'Add User';
			$data['user']= $user;
			$this->load->view('admin/root', $data);
			
		}else{
			$data['users']= $this->usersmodel->get_users(0, $current, $count);
			$data['page']= 'users';
			$data['page_title']= 'Users';
			$this->load->view('admin/root', $data);
		}
	}
	
	/* FINANCE */
	public function finance($action= null, $finance_id = null){
		
		
		$data['page']= 'financelist';
		$data['page_title']= 'Finance List';
		$this->load->view('admin/root', $data);
	}
	
	public function finance_add($finance_type= null, $finance_id = null){
		$user_type = "member";
		$user_id = "";
		$data['finance_type']= $finance_type;
		$data['finance_id']= $finance_id;
		$data['members']= $this->usersmodel->get_users($user_type, $user_id= null);
		$data['results']= $this->usersmodel->financelist($finance_type, $finance_id);
		
		$data['page']= 'finance_add';
		$data['page_title']= 'Add Finance';
		$this->load->view('admin/root', $data);
	}
	
	public function finance_member($member_id= null){
		
		$data['finance_type']= 'as';
		$data['results'] = array();
		if(!empty($member_id)){
			$data['results']= $this->usersmodel->financelist($finance_type=null, $finance_id=null, $member_id);
		}
		$member_data = $this->usersmodel->get_users($user_type=null, $member_id);
		//echo"<pre>"; print_r($data['results']); exit;
		
		$data['page']= 'member_member-list';
		$data['member_data']= $member_data[0];
		$data['page_title']= 'Member Loan List';
		$this->load->view('admin/root', $data);
	}
	
	public function instalments($finance_id= null){
		
		$data['finance_type']= 'as';
		$data['results'] = array();
		if(!empty($finance_id)){
			$data['results']= $this->usersmodel->instalments_list($finance_id);
		}
		//$member_data = $this->usersmodel->get_users($user_type=null, $member_id);
		//echo"<pre>"; print_r($data['results']); exit;
		
		$data['page']= 'instalments_list';
		$data['page_title']= 'Instalments List';
		$this->load->view('admin/root', $data);
	}
	
	/* SETTINGS */
	public function settings($action = null, $id = null){
		
		if($action == 'genral'){
			$data['page']= 'add_user';
			$data['page_title']= 'Add User';
			$this->load->view('admin/root', $data);
			
		}else{
			$data['page']= 'settings_general';
			$data['page_title']= 'General Settings';
			$data['genraloptions']= $this->genraloptions->index();
			$this->load->view('admin/root', $data);
		}
	}

	public function add_user(){
		$data['page']= 'add_user';
		$data['page_title']= 'Add User';
		$this->load->view('admin/root', $data);
	}
	
	public function store_user(){
		$this->load->library('form_validation');
		if($this->form_validation->run('add_user_rules')){
			
			$post= $this->input->post();
			unset($post['add_user']);
			
			$this->flash_message(
				$this->usersmodel->add_user($post),
				"<strong>All done!</strong> New user added successfully...",
				"<strong>Oh snap!</strong> Change a few things up and try again."
			);
			return redirect('admin/users');

		}else{
			$data['page']= 'add_user';
			$data['page_title']= 'Add User';
			$this->load->view('admin/root', $data);
		}
	}

	public function edit_user($user_id){
		$user=$this->usersmodel->find_user($user_id);
		$data['page']= 'edit_user';
		$data['page_title']= 'Edit User';
		$data['user']= $user;
		$this->load->view('admin/root', $data);
	}
	
	public function update_user($user_id){
		$this->load->library('form_validation');
		if($this->form_validation->run('update_user_rules')){
			
			$post= $this->input->post();
			unset($post['submit']);
			
			$this->flash_message(
				$this->usersmodel->update_user($user_id, $post),
				"<strong>All done!</strong> requested User update successfully...",
				"<strong>Oh snap!</strong> Change a few things up and try again."
			);
			return redirect("admin/edit_user/{$user_id}");

		}else{
			$this->load->view('admin/edit_user');
		}

	}
	
	
	/* Profile page */
	public function profile(){
		
		$user_id = $this->session->userdata('user_id');
		$this_user_data = $this->usersmodel->login_user_data($user_id);
		
		$data['page']= 'profile';
		$data['page_title']= 'Profile';
		$data['details'] = $this_user_data;
		$this->load->view('admin/root', $data);
	}

	private function flash_message($successful, $success_message, $failure_message){
		if($successful){
			$this->session->set_flashdata('feedback', $success_message);
			$this->session->set_flashdata('feedback_class', 'alert-success');
		}else{
			$this->session->set_flashdata('feedback', $failure_message);
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}
	}
	
}
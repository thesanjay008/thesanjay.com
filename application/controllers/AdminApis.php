<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminApis extends MY_Controller {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		header('Content-type: application/json');
		parent::__construct();
		if(! $this->session->userdata('user_id')){
			return redirect('login');
		}
		$this->auth_check();
		$this->load->model('postmodel');
		$this->load->model('Mediamodel');
		
	}
	
	/* CHECK AUTHENTICATION */
    public function auth_check() {
        $response['status'] = 'error';
		$response['message']= "";
		$response['details']= array();
		
        $oauth_id = $this->input->post('oauth_id');
        $visit_from = $this->input->post('visit_from');
		
		if(!empty($this->session->userdata('user_id'))){
			$visit_from = 'web';
			$oauth_id = OAUTH_ID;
		}
        if(empty($oauth_id)) {
			$response['message'] = 'Unauthorise Access.';
            echo json_encode($response);
            exit;
        }else if(empty($visit_from)) {
			$response['message'] = 'Unauthorise Access.';
            echo json_encode($response);
            exit;
		}else {
            $query = 'SELECT secret_value FROM '.TABLE_PREFIX.'oauth WHERE `secret_key` = "'. $visit_from .'"';
            $result = $this->db->query($query)->row_array();
			
			if ($oauth_id != $result['secret_value']) {
				$response['message'] = 'Unauthorise Access.';
				echo json_encode($response);
				exit;
			}
        }
    }

	public function save_post(){
		$timestamp = time();
		
		$post_id = $this->input->post('post_id');
		$author_id = $this->input->post('author_id');
		$post_title = $this->input->post('post_title');
		$post_content = $this->input->post('post_content');
		$post_image = $this->input->post('post_image');
		$category_id = $this->input->post('category_id');
		$post_status = $this->input->post('post_status');
		
		$this->db->where('post_id',$post_id);
		$post_data = $this->db->get(TABLE_PREFIX .'posts')->row_array();
		if(empty($post_data)){
			redirect('admin/dashboard');
		}
		
		$data = array(
		 'post_id'  =>$post_id,
		 'author_id'  =>$author_id,
		 'post_status'  =>$post_status,
		 'post_title'	=>$post_title,
		 'post_content'	=>$post_content,
		 'category_id'	=>$category_id,
		 'lastEdited'	=>$timestamp
		);
		
		$post_id = $this->postmodel->save_post($data);
		
		if($post_status == 'trash'){
			redirect('admin/posts');
		}
		redirect('admin/edit/'.$post_id);
	}
	
	public function save_profile(){
		$response['status'] = 'error';
		$response['message']= "";
		$response['details']= array();
		
		$timestamp = time();
		$response['status']= 0;
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$user_email = $this->input->post('user_email');
		$username = $this->input->post('username');
		$mobile_no = $this->input->post('mobile_no');
		$profile_pic = isset($_FILES['profile_pic']) ? $_FILES['profile_pic'] : "";
		
		
		$data = array(
		  'first_name'=> $first_name,
		  'last_name'=> $last_name,
		  'user_email'=> $user_email,
		  'mobile_no'=> $mobile_no,
		);
		
		if(!empty($user_id)){
			$this->db->where('ID', $user_id);
			$this->db->update(TABLE_PREFIX . 'users', $data);
			$response['message']= "Profile Saved successfully!";
		}else{
			$response['message']= "Profile created successfully!";
		}
		/* UPLOAD NEW IMAGES */
        if (!empty($profile_pic)) {
            
			$file_data = $this->Mediamodel->upload_file($profile_pic);
			
			if(!empty($file_data) && !empty($user_id)){
				$this->db->where('ID', $user_id);
				$this->db->update(TABLE_PREFIX . 'users', array('profile_pic' => $file_data));
			}
        }
		
		$response['status']= 'ok';
		echo json_encode($response);
		exit;
	}
}
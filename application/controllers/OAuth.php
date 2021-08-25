<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "libraries/SimpleImage.php");

class OAuth extends MY_Controller {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		header('Content-type: application/json');
		parent::__construct();
		$this->load->database();
		$this->load->model('OAuthModel');
		$this->load->model('postmodel');
		$this->auth_check();
	}
	
	
	/* CHECK AUTHENTICATION */
    public function auth_check() {
        $response['status'] = 0;
		$response['message']= "";
		$response['details']= array();
		
        $oauth_id = $this->input->post('oauth_id');
        $visit_from = $this->input->post('visit_from');
		
		if(!empty($this->session->userdata('user_id'))){
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
	
	/* INSERT POST */
	public function  add_post_master($param = array()){
		/* DEFAULT VALUE */
		$is_admin = 0;
		$author_id = 0;
		$user_id = 0;
		$post_id = 0;
		$post_content = '';
		
		if (isset($param['post_id'])) {
            $post_id = $param['post_id'];
        }
		if (isset($param['post_type'])) {
            $post_type = $param['post_type'];
        } else {
            $post_type = "post";
        }
		if (isset($param['author_id'])) {
            $author_id = $param['author_id'];
        }
		if (isset($param['post_content'])) {
            $post_content = $param['post_content'];
        }
		$data = array(
			'post_type'	=> $post_type,
		);
	}
	
	/* ADD NEW POST */
	public function  add_post(){
		$timestamp = time();
		$response['status']= 0;
		$response['message']= "";
		$response['details']= array();
		
		$post_id = $this->input->post('post_id');
		$post_title = $this->input->post('post_title');
		$post_content = $this->input->post('post_content');
		$post_type = $this->input->post('post_type');
		$post_image = $this->input->post('post_image');
		$post_image_from_url = $this->input->post('post_image_from_url');
		$post_status = $this->input->post('post_status');
		$author_id = $this->input->post('author_id');
		
		if(empty($author_id) || !is_numeric($author_id)){
			$response['message']= "Invalid Author Id";
			echo json_encode($response);
			exit;
		}
		if(empty($post_type)){
			$response['message']= "Invalid post type";
			echo json_encode($response);
			exit;
		}
		if(empty($post_status)){
			$response['message']= "Invalid post status";
			echo json_encode($response);
			exit;
		}
		if(empty($post_title)){
			$response['message']= "Invalid post title";
			echo json_encode($response);
			exit;
		}
		
		$insert_data = array(
			'post_id'	=>	$post_id,
			'post_type'	=>	$post_type,
			'post_title'	=>	$post_title,
			'post_content'	=>	$post_content,
			'author_id'	=>	$author_id,
			'post_status'	=>	$post_status,
		);
		
		$return = $this->postmodel->save_post($insert_data);
		
		$response['details']= $return;
		echo json_encode($response);
		exit;
	}
	
	public function update_profile(){
		$timestamp = time();
		$response['status']= 0;
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$mobileno = $this->input->post('mobileno');
		
		if(empty($user_id) || !is_numeric($user_id)){
			$response['message']= "Invalid user id";
			echo json_encode($response);
			exit;
		}
		
		$data = array(
		  'fname'=> $fname,
		  'lname'=> $lname,
		  'email'=> $email,
		  'mobileno'=> $mobileno,
		);
		
		$this->db->where('ID', $user_id);
		$this->db->update('users', $data);
		
		$response['status']= 1;
		$response['message']= "Data Saved successfully!";
		echo json_encode($response);
		exit;
	}
	
	public function update_profilePic(){
		$timestamp = time();
		$response['status']= 0;
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		$user_image = isset($_FILES['user_image']) ? $_FILES['user_image'] : "";
		
		if(empty($user_id) || !is_numeric($user_id)){
			$response['message']= "Invalid user id";
			echo json_encode($response);
			exit;
		}
		
		/* UPLOAD NEW IMAGES */
        if (!empty($user_image)) {

            $image_names = array();
            $this->db->select('image');
            $this->db->where('ID', $user_id);
            $old_data = $this->db->get('users')->row_array();
			
			if (!empty($old_data)) {
                //$old_image = base_url('media/admin/').$old_data['image'];
                if(file_exists(FILES_PATH.('media/admin/').$old_data['image'])){
					unset($old_image);
				}
            }
			
			$directory = FILES_PATH . 'media/admin/';
			$image_name = base64_encode($timestamp . rand(1111, 999999) . $user_id) . '.jpg';
			$simple_image = new SimpleImage($user_image['tmp_name']);
			$simple_image->resizeToWidth(1024);
			$simple_image->save($directory . $image_name);
			
			$simple_image->square(256);
            $simple_image->save($directory . 'th_' . $image_name);
				
			$this->db->where('ID', $user_id);
			$this->db->update('users', array('image' => $image_name));
        }
		
		$response['status']= 1;
		$response['message']= "Image Uploaded successfully!";
		echo json_encode($response);
		exit;
	}
}
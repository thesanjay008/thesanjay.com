<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "libraries/SimpleImage.php");

class Restapis extends MY_Controller {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		header('Content-type: application/json');
		parent::__construct();
		$this->load->database();
		$this->load->model('restModel');
		$this->load->model('usersmodel');
		$this->load->model('message');
		//$this->auth_check();
	}
	
	
	/* CHECK AUTHENTICATION */
    public function auth_check() {
        $response['status'] = 'error';
		$response['message']= "";
		$response['details']= array();
		
        $oauth_id = $this->input->post('oauth_id');
        $visit_from = $this->input->post('visit_from');
		
		if(!empty($this->session->userdata('user_id'))){
			$oauth_id	= OAUTH_ID;
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
	
	public function media_directory(){
		$year = date("Y");
		$month = date("m");
		$media_path1 = FILES_PATH . $year.'/';
		$media_path2 = FILES_PATH . $year .'/'. $month.'/';
		$media_path3 = $year .'/'. $month.'/';
		
		if(!is_dir($media_path1)){
			mkdir($media_path1, 0755, true);
		}
		if(!is_dir($media_path2)){
			mkdir($media_path2, 0755, true);
		}
		return $media_path3;
	}
	
	public function media_upload($media){
		if (!empty($media)){
			$directory = $this->media_directory();
			$image_name = md5(time()) . rand(11, 999);
			$image_type = '.jpg';
			$storage_name = $directory . $image_name . $image_type;
			$simple_image = new SimpleImage($media['tmp_name']);
			$simple_image->resizeToWidth(1024);
			$simple_image->save(FILES_PATH . $directory . $image_name . $image_type);
			
			$simple_image->square(150);
			$simple_image->save(FILES_PATH . $directory . $image_name . '150X150' . $image_type);
			return $storage_name;
		}
	}
	
	
	/* USER LIST */
	public function get_users(){
		$response['status'] = "error";
		$response['message'] = "";
		$response['details'] = array();
		$response['count_total'] = 0;
        $response['pages'] = 1;
		$page = 1;
        $count = 10;
		
		$user_id	= trim($this->input->post('field_data1'));
		$page		= trim($this->input->post('field_data2'));
		$count		= trim($this->input->post('field_data3'));
		$search		= trim($this->input->post('field_data4'));
		
		if ($page <= 0){ $page = 1; }
        if ($count <= 0){ $count = 10; }
        $start = $count * ($page - 1);
		if ($count < 0){ $start = 0;}
		$query = 'SELECT
			SQL_CALC_FOUND_ROWS t1.ID as user_id,
			IF(t1.profile_pic = "","'. SITEURL .'/media/defoult/defoult.png",concat("'. SITEURL . '/media/", t1.profile_pic)) as profile_pic,
			t1.username, 
			t1.user_email, 
			t1.first_name, 
			t1.last_name, 
			t1.user_role, 
			t1.is_active, 
			t1.create_date 
			FROM '.TABLE_PREFIX.'users t1 
			WHERE 1 = 1';
		if(!empty($user_id)) {
			$query .= ' AND t1.ID = '.$user_id;
        }
		if(!empty($search)) {
			$query .= ' AND (t1.first_name LIKE "%' . $search . '%" OR t1.last_name LIKE "%' . $search . '%" OR t1.username LIKE "%' . $search . '%" OR t1.user_email LIKE "%' . $search . '%")';
        }
		$query .= ' Group by t1.ID ORDER BY t1.ID DESC LIMIT ' . $start . ','. $count;
		$postdata = $this->db->query($query)->result_array();
		//print_r($postdata); exit;
		
		/* COUNT DATA */
        $count_row = array();
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$count_row = $query->row()->Count;
		
		$response['start'] = $start;
		$response['count_total'] = $count_row;
		$response['pages'] = ceil($count_row / $count);
		$response['page'] = $page;
		
		$response['status'] = 'ok';
        $response['message'] = 'Total ' . count($postdata) . ' records found';
        $response['details'] = $postdata;
        echo json_encode($response);
        exit;
	}
	
	/* USER APIS */
	public function user_login(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$visit_from = trim($this->input->post('visit_from'));
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		
		if(empty($username)){
			$response['message']= "Invalid username";
			echo json_encode($response);
			exit;
		}
		if(empty($password)){
			$response['message']= "Invalid password";
			echo json_encode($response);
			exit;
		}
		
		$user_data = $this->usersmodel->login($username, $password);
		
		if(!empty($user_data)){
			$response['status']= "ok";
			$response['message']= "Login Successfully!";
			$response['details']= $user_data;
			
			if($visit_from == 'web'){
			  $this->session->set_userdata($user_data);
			}
		}else{
			$response['message']= "Invalid Username or Password";
		}
		
		echo json_encode($response);
		exit;
	}
	
	public function user_registration(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$visit_from	= trim($this->input->post('visit_from'));
		$username_o	= trim($this->input->post('username'));
		$username 	= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $username_o)));
		$password 	= trim($this->input->post('password'));
		$first_name = trim($this->input->post('first_name'));
		$last_name 	= trim($this->input->post('last_name'));
		$user_email = trim($this->input->post('user_email'));
		$mobile_no 	= trim($this->input->post('mobile_no'));
		$referral_id= trim($this->input->post('referral_id'));
		$user_role	= trim($this->input->post('user_role'));
		
		if($username_o != $username){
            $response['message']= "Enter valid username";
			echo json_encode($response);
			exit;
        }else if(empty($username)){
            $response['message']= "Invalid username";
			echo json_encode($response);
			exit;
        }else if(empty($password)){
            $response['message']= "Invalid password";
			echo json_encode($response);
			exit;
        }else if(empty($first_name)){
            $response['message']= "Invalid first name";
			echo json_encode($response);
			exit;
        }else if(empty($last_name)){
            $response['message']= "Invalid last name";
			echo json_encode($response);
			exit;
        }else if(empty($user_email)){
            $response['message']= "Empty email";
			echo json_encode($response);
			exit;
        }else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            $response['message']= "Invalid email";
			echo json_encode($response);
			exit;
        }else if(empty($mobile_no)){
            $response['message']= "Invalid mobile no";
			echo json_encode($response);
			exit;
        }else if(empty($user_role)){
            $response['message']= "Invalid role";
			echo json_encode($response);
			exit;
        }
		if($this->session->userdata('user_role') != 'administrator' && $user_role == 'administrator'){
			$user_role = 'subscriber';
		}
		
		/* CHECK USERNAME EXIST OR NOT */
		$check_username = $this->usersmodel->check_user_exist($username);
		$check_email = $this->usersmodel->check_user_exist($user_email);
		if(!empty($check_username)){
			$response['message']= "Username already exists!";
			echo json_encode($response);
			exit;
		}
		if(!empty($check_email)){
			$response['message']= "Email already exists!";
			echo json_encode($response);
			exit;
		}
		
		$user_data = array(
		  'username' => $username,
		  'password' => $password,
		  'first_name' => $first_name,
		  'last_name' => $last_name,
		  'user_email' => $user_email,
		  'mobile_no' => $mobile_no,
		  'referral_id' => $referral_id,
		  'user_role' => $user_role,
		);
		$return_data = $this->usersmodel->registration($user_data);
		
		if(!empty($return_data)){
			$response['status']= "ok";
			$response['message']= "Registration Successfully!";
			$response['details']= $return_data;
			
			/* ALSO LOGIN*/
			$user_data = $this->usersmodel->login($username, $password);
			if(!empty($user_data) && $visit_from == 'web'){
			  $this->session->set_userdata($user_data);
			}
		}else{
			$response['message']= "User not registered";
		}
		echo json_encode($response);
		exit;
	}
	
	public function forgot_password(){
		$response['status'] = 'error';
		$response['message']= 'Please try again';
		$response['details']= array();
		$mail_type = 'simple';
		$visit_from = trim($this->input->post('visit_from'));
		$user_email	= trim($this->input->post('user_email'));
		
		if(empty($user_email)){
			$response['message']= "Invalid email id";
			echo json_encode($response);
			exit;
		}
		
		$user_data = $this->usersmodel->get_user_by('user_email', $user_email);
		if(empty($user_data)){
			$response['message']= "User not exist with this email";
			echo json_encode($response);
			exit;
		}else{
			$subject = 'Forgot Password';
			$user_data['access_token'] = md5(time().$user_email);
			$data['user_data'] = $user_data;
			$message = $this->load->view('templates/forgot-password',$data, true);
			$return = $this->message->sendMail(trim($user_email), $message, $subject, $mail_type);
			if($return){
			  $response['status']= "ok";
			  $response['message']= "Email sent successfully!";
			  $response['details']= "Forgot link successfully send to given email id please check your mail";
			}
		}
		echo json_encode($response);
		exit;
	}
	
	public function get_users_deprecated(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		$user_data = $this->usersmodel->get_users($user_id);
		
		
		$response['status']= 'ok';
		$response['message']= count($user_data) . ' user found';
		$response['details']= $user_data;
		echo json_encode($response);
		exit;
	}
	
	public function get_user_dashboardData(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		
		$dsbrdata = array('total_plans'=>0,'total_orders'=>0,'total_spend'=>0.00,'total_earning'=>0.00,'withdrawal'=>0.00,'available_revenue'=>0.00,);
		
		$this->db->select('COUNT(plan_id)as total_plans');
		$this->db->where(array('user_id'=>$user_id));
		$details = $this->db->get(TABLE_PREFIX . 'plan_list')->row_array();
		if(!empty($details)){
			$dsbrdata['total_plans'] = $details['total_plans'];
		}
		
		$this->db->select('COUNT(order_id)as total_orders');
		$this->db->select('IFNULL(SUM(subtotal), "0")as total_spend');
		$this->db->where(array('order_status'=>4,'user_id'=>$user_id));
		$details = $this->db->get(TABLE_PREFIX . 'cart_orders')->row_array();
		if(!empty($details)){
			$dsbrdata['total_orders'] = $details['total_orders'];
			$dsbrdata['total_spend'] = $details['total_spend'];
		}
		
		$this->db->select('total_earning, withdrawal, available_revenue');
		$this->db->where('author_id', $user_id);
		$details2 = $this->db->get(TABLE_PREFIX . 'plan_revenue_main')->row_array();
		if(!empty($details2)){
			$dsbrdata['total_earning'] = $details2['total_earning'];
			$dsbrdata['withdrawal'] = $details2['withdrawal'];
			$dsbrdata['available_revenue'] = $details2['available_revenue'];
		}
		
		$response['status']= 'ok';
		$response['message']= 'Dashboard data';
		$response['details']= $dsbrdata;
		echo json_encode($response);
		exit;
	}
	
	public function get_user_bankdetails(){
		$response['status']= 'error';
		$response['message']= "Please try again";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		
		$this->db->select('meta_key, meta_value');
		$this->db->where('user_id',$user_id);
		$this->db->where_in('meta_key',array('bank_name','account_no','ifsc_code'));
		$details = $this->db->get(TABLE_PREFIX . 'users_meta')->result_array();
		$finalArray = array();
		if(!empty($details)){
			foreach($details as $key => $data){
				$finalArray[$data['meta_key']] = $data['meta_value'];
			}
		}
		
		
		
		$response['status']= 'ok';
		$response['message']= 'Data Found';
		$response['details']= $finalArray;
		echo json_encode($response);
		exit;
	}
	
	public function save_user_bankdetails(){
		$response['status']= 'error';
		$response['message']= "Please try again";
		$response['details']= array();
		
		$user_id	= trim($this->input->post('user_id'));
		$bank_name	= trim($this->input->post('bank_name'));
		$account_no	= trim($this->input->post('account_no'));
		$ifsc_code	= trim($this->input->post('ifsc_code'));
		
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		if(empty($bank_name)){
            $response['message']= "Invalid bank name";
			echo json_encode($response);
			exit;
        }
		if(empty($account_no)){
            $response['message']= "Invalid account no";
			echo json_encode($response);
			exit;
        }
		if(empty($ifsc_code)){
            $response['message']= "Invalid ifsc code";
			echo json_encode($response);
			exit;
        }
		
		$param = array(
		  'user_id'=>$user_id,
		  'bank_name'=>$bank_name,
		  'account_no'=>$account_no,
		  'ifsc_code'=>$ifsc_code,
		);
		$return_data = $this->usersmodel->save_user_meta($user_id, $param);
		if(!empty($return_data)){
			$response['status']= "ok";
			$response['message']= "Data saved!";
			$response['details']= $return_data;
		}else{
			$response['message']= "Data not saved";
		}
		echo json_encode($response);
		exit;
	}
	
	public function save_profile(){
		$timestamp = time();
		$response['status']= 'error';
		$response['message']= "Plese try again";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		$first_name	= $this->input->post('first_name');
		$last_name	= $this->input->post('last_name');
		$user_email	= $this->input->post('user_email');
		$mobile_no	= $this->input->post('mobile_no');
		$profile_pic = isset($_FILES['profile_pic']) ? $_FILES['profile_pic'] : "";
		$address	= $this->input->post('address');
		$city		= $this->input->post('city');
		$country	= $this->input->post('country');
		$zip_code	= $this->input->post('zip_code');
		
		if(empty($user_id) || !is_numeric($user_id)){
			$response['message']= "Invalid user id";
			echo json_encode($response);
			exit;
		}
		if(empty($user_email)){
			$response['message']= "Invalid email";
			echo json_encode($response);
			exit;
		}
		if(empty($first_name)){
			$response['message']= "Invalid first name";
			echo json_encode($response);
			exit;
		}
		if(empty($last_name)){
			$response['message']= "Invalid last name";
			echo json_encode($response);
			exit;
		}
		if(empty($mobile_no)){
			$response['message']= "Invalid mobile no";
			echo json_encode($response);
			exit;
		}
		
		$data = array(
		  'first_name'=> $first_name,
		  'last_name'=> $last_name,
		  'user_email'=> $user_email,
		  'mobile_no'=> $mobile_no,
		);
		
		if(!empty($address)){
			$data['address'] = $address;
		}
		if(!empty($city)){
			$data['city'] = $city;
		}
		if(!empty($country)){
			$data['country'] = $country;
		}
		if(!empty($zip_code)){
			$data['zip_code'] = $zip_code;
		}
		
		$this->db->where('ID', $user_id);
		$this->db->update(TABLE_PREFIX .'users', $data);
		
		/* UPLOAD NEW IMAGES */
        if (!empty($profile_pic)){
			$url = $this->media_upload($profile_pic);
			if(!empty($url)){
			  $this->db->where('ID', $user_id);
			  $this->db->update(TABLE_PREFIX .'users', array('profile_pic'=>$url));
			}
		}
		
		$response['status']= 'ok';
		$response['message']= "Data Saved successfully!";
		echo json_encode($response);
		exit;
	}
	
	
	/* PLAN APIS */
	public function add_plan(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$order_id = $this->input->post('order_id');
		$user_id = $this->input->post('user_id');
		
		if(empty($order_id)){
            $response['message']= "Invalid order id";
			echo json_encode($response);
			exit;
        }else if(empty($user_id)){
            $response['message']= "Invalid user id";
			echo json_encode($response);
			exit;
        }
		$response = $this->restModel->add_plan($order_id);
		if(!empty($response)){
			$response['status']= 'ok';
			$response['message']= 'Plan added successfully';
		}
		echo json_encode($response);
		exit;
	}
	
	public function get_plan_list(){
		$response['status']= 'error';
		$response['message']= 'Plese try again';
		$response['start'] = 0;
		$response['count_total'] = 0;
        $response['page'] = 1;
        $response['pages'] = 1;
		$response['details']= array();
		$page = 1;
        $count = 10;
		
		$plan_id = trim($this->input->post('plan_id'));
		$user_id = trim($this->input->post('user_id'));
		$page	 = trim($this->input->post('field_data2'));
		$count	 = trim($this->input->post('field_data3'));
		
		
		if ($page <= 0){ $page = 1; }
        if ($count <= 0){ $count = 10; }
        $start = $count * ($page - 1);
		if ($count < 0){ $start = 0;}
		
		$this->db->where('t1.is_active', 1);
		if(!empty($user_id)){
		  $this->db->where('t1.user_id', $user_id);
		}if(!empty($plan_id)){
		  $this->db->where('t1.plan_id', $plan_id);
		}
		$details = $this->db->select('t1.*, t2.total_refund, t2.product_title, t3.first_name, t3.last_name');
		$details = $this->db->join(TABLE_PREFIX . 'products as t2', 't1.product_id = t2.product_id');
		$details = $this->db->join(TABLE_PREFIX . 'users as t3', 't3.ID = t1.user_id');
		
		$details = $this->db->get(TABLE_PREFIX . 'plan_list as t1')->result_array();
		
		/* COUNT DATA */
        $count_row = array();
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$count_row = $query->row()->Count;
		
		$response['start'] = $start;
		$response['count_total'] = $count_row;
		$response['page'] = $page;
		$response['pages'] = ceil($count_row / $count);
		
		$response['status']= 'ok';
		$response['message']= sizeof($details) . ' records found';
		$response['found']= sizeof($details);
		$response['details']= $details;
		echo json_encode($response);
		exit;
	}
	
	public function add_festival(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$title = $this->input->post('title');
		$date = $this->input->post('date');
		$year = intval($date);
		$timestamp = time();
		
		if(empty($title)){
            $response['message']= "Invalid title";
			echo json_encode($response);
			exit;
        }else if(empty($date)){
            $response['message']= "Invalid date";
			echo json_encode($response);
			exit;
        }
		
		$this->db->insert(TABLE_PREFIX . 'festivals', array('title' => $title, 'date' => $date, 'year' => $year, 'timestamp'=>$timestamp));
		
		$response['status']= 'ok';
		$response['message']= 'Data added successfully';
		echo json_encode($response);
		exit;
	}
	
	
	/* eCommerce */
	public function get_product_list(){
		$response['status']= 'error';
		$response['message']= '';
		$response['details']= array();
		
		$product_id = $this->input->post('product_id');
		
		if(!empty($product_id)){
		  $this->db->where('product_id', $product_id);
		}
		$this->db->where('is_active', 1);
		$product_list = $this->db->get(TABLE_PREFIX . 'products')->result_array();
		
		
		$response['status']= 'ok';
		$response['message']= count($product_list).' Product found';
		$response['details']= $product_list;
		echo json_encode($response);
		exit;
	}
	
	public function add_to_cart(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		$product_id = $this->input->post('product_id');
		$qty = $this->input->post('qty');
		$timestamp = time();
		
		if(empty($product_id)){
            $response['message']= "Invalid plan";
			echo json_encode($response);
			exit;
        }else if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		
		$this->db->where('product_id', $product_id);
		$product_details = $this->db->get(TABLE_PREFIX . 'products')->row_array();
		if(empty($product_details)){
			$response['message']= "Invalid Plan";
			echo json_encode($response);
			exit;
		}
		
		$this->db->where('product_id', $product_id);
		$this->db->where('order_id', 0);
		$this->db->where('user_id', $user_id);
		$cart_products = $this->db->get(TABLE_PREFIX . 'cart_products')->row_array();
		
		if(!empty($cart_products)){
		  $response['status']= 'ok';
		  $response['message']= 'Plan added successfully';
		  echo json_encode($response);
		  exit;
		}
		
		$total_qty = 1;
		if(!empty($cart_products)){
		  $total_qty = $qty + $cart_products['qty'];
		}
		$price = $product_details['price'];
		$total_price = $total_qty * $product_details['price'];
		
		$data = array(
		  'qty'=>$total_qty, 
		  'price'=>$price, 
		  'gross_total'=>$total_price, 
		  'net_amount'=>$total_price, 
		);
		if(empty($cart_products)){
			$data['product_id'] = $product_id;
			$data['user_id'] = $user_id;
			$data['timestamp'] = $timestamp;
			$this->db->insert(TABLE_PREFIX . 'cart_products', $data);
		}else{
			$this->db->update(TABLE_PREFIX . 'cart_products', $data);
		}
		
		$response['status']= 'ok';
		$response['message']= 'Plan added successfully';
		echo json_encode($response);
		exit;
	}
	
	public function update_cart($product_id, $qty){
		if(empty($product_id)){
            return 0;
        }else if(empty($qty)){
            return 0;
        }
		
		$this->db->select('C.product_id, C.qty, P.price');
		$this->db->where('C.product_id', $product_id);
		$this->db->where('P.is_active', 1);
		$this->db->join(TABLE_PREFIX . 'products as P', 'P.product_id = C.product_id');
		$product_details = $this->db->get(TABLE_PREFIX . 'cart_products as C')->row_array();
		if(empty($product_details)){ return 0; }
		$total_qty 	 = $qty + $product_details['qty'];
		$price = $qty * $product_details['price'];
		
		$data = array(
		  'qty'=>$total_qty, 
		  'price'=>$price, 
		  'gross_total'=>$price, 
		  'net_amount'=>$price, 
		);
		$this->db->update(TABLE_PREFIX . 'cart_products', $data);
	}
	
	public function get_cart_products(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		$details = $this->restModel->get_cart_products($user_id);
		if(!empty($details)){
			$response['message']= sizeof($details['list']) . ' records found';
			$response['details']= $details;
		}
		$response['status']= 'ok';
		echo json_encode($response);
		exit;
	}
	
	public function get_current_order(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		$order_data = $this->restModel->get_current_order($user_id);
		if(!empty($order_data)){
			$response['message']= 'Order found';
			$response['details']= $order_data;
		}
		$response['status']= 'ok';
		echo json_encode($response);
		exit;
	}
	
	public function create_order(){
		$response['status']= 'error';
		$response['message']= 'Please try again';
		$response['details']= array();
		
		$user_id = $this->input->post('user_id');
		
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		$user_data = $this->usersmodel->login_user_data($user_id);
		if(empty($user_data)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		
		$cart_products = $this->restModel->get_cart_products($user_id);
		$data = array(
		  'subtotal'=>$cart_products['subtotal'],
		  'first_name'=>$user_data['first_name'],
		  'last_name'=>$user_data['last_name'],
		  'email'=>$user_data['user_email'],
		  'user_id'=>$user_id,
		  'country'=>'india',
		  'timestamp'=>time(),
		);
		
		$this->db->insert(TABLE_PREFIX .'cart_orders', $data);
		$order_id = $this->db->insert_id(); 
		
		if(!empty($order_id)){
		  $this->db->where(array('order_id'=>0, 'user_id'=>$user_id));
		  $update_data = $this->db->update(TABLE_PREFIX .'cart_products', array('order_id'=>$order_id));
		  if($update_data){
		    $response['status']= 'ok';
		    $response['message']= 'Order created';
		  }
		}
		echo json_encode($response);
		exit;
	}
	
	public function checkout(){
		$response['status']= 'error';
		$response['message']= 'Please try again';
		$response['details']= array();
		
		$user_id 		= $this->input->post('user_id');
		$order_id 		= $this->input->post('order_id');
		$first_name		= $this->input->post('first_name');
		$last_name 		= $this->input->post('last_name');
		$email 			= $this->input->post('email');
		$addressline1	= $this->input->post('addressline1');
		$addressline2	= $this->input->post('addressline2');
		$city 			= $this->input->post('city');
		$pincode 		= $this->input->post('pincode');
		$country 		= $this->input->post('country');
		
		if(empty($user_id)){
            $response['message']= "Invalid user";
			echo json_encode($response);
			exit;
        }
		if(empty($first_name)){
            $response['message']= "Invalid first name";
			echo json_encode($response);
			exit;
        }
		if(empty($last_name)){
            $response['message']= "Invalid last name";
			echo json_encode($response);
			exit;
        }
		if(empty($email)){
            $response['message']= "Invalid email";
			echo json_encode($response);
			exit;
        }
		if(empty($addressline1)){
            $response['message']= "Invalid address";
			echo json_encode($response);
			exit;
        }
		if(empty($addressline2)){
            $response['message']= "Invalid address";
			echo json_encode($response);
			exit;
        }
		if(empty($city)){
            $response['message']= "Invalid city";
			echo json_encode($response);
			exit;
        }
		if(empty($pincode)){
            $response['message']= "Invalid pincode";
			echo json_encode($response);
			exit;
        }
		if(empty($country)){
            $response['message']= "Invalid country";
			echo json_encode($response);
			exit;
        }
		
		$data = array(
		  'first_name'=>$first_name,
		  'last_name'=>$last_name,
		  'email'=>$email,
		  'addressline1'=>$addressline1,
		  'addressline2'=>$addressline2,
		  'city'=>$city,
		  'pincode'=>$pincode,
		  'country'=>$country,
		  'modified_timestamp'=>time(),
		);
		
		$this->db->where(array('order_id'=>$order_id));
		$update_data = $this->db->update(TABLE_PREFIX .'cart_orders', $data);
		if($update_data){
		  $response['status']= 'ok';
		  $response['message']= 'Order Updated';
		}
		echo json_encode($response);
		exit;
	}
	
	public function confirm_order(){
		$response['status']= 'error';
		$response['message']= 'Please try again';
		$response['details']= array();
		
		$user_id 			= $this->input->post('user_id');
		$order_id 			= $this->input->post('order_id');
		$order_status		= $this->input->post('order_status');
		
		$response = $this->restModel->confirm_order($user_id, $order_id, $order_status);
		if($response){
			if($order_status == 4){
				$this->restModel->add_plan($order_id, $user_id);
			}
			$response['status']= 'ok';
		    $response['message']= 'Order Complete';
		}
		echo json_encode($response);
		exit;
	}
	
	/* REVENUE APIS */
	public function get_author_revenue(){
		$response['status']= 'error';
		$response['message']= "";
		$response['details']= array();
		
		$author_id = $this->input->post('author_id');
		$this->db->where('author_id', $author_id);
		$details = $this->db->get(TABLE_PREFIX . 'plan_revenue_main')->row_array();
		
		$response['status']= 'ok';
		$response['message']= 'records found';
		$response['details']= $details;
		echo json_encode($response);
		exit;
	}
	
	public function send_msg(){
		$response['status']= 'error';
		$response['message']= 'Please try again';
		
		$name 		= $this->input->post('name');
		$email 		= $this->input->post('email');
		$subject	= $this->input->post('subject');
		$comment	= $this->input->post('comment');
		
		if(empty($name)){
            $response['message']= "Name required";
			echo json_encode($response);
			exit;
        }
		if(empty($email)){
            $response['message']= "Email required";
			echo json_encode($response);
			exit;
        }
		if(empty($subject)){
            $response['message']= "subject required";
			echo json_encode($response);
			exit;
        }
		if(empty($comment)){
            $response['message']= "Description required";
			echo json_encode($response);
			exit;
        }
		$to = 'thesanjay00@gmail.com';
		$mail_subject = 'New mail from '. $name .' (raddhikarai.com)';
		$message = '<html>
		<head>
		<title>'. $subject .'</title>
		<body>
		<table>
		<tr><td><b>Name:</b> </td><td>'. $name .'</td></tr>
		<tr><td><b>Subject:</b> </td><td>'. $subject .'</td></tr>
		<tr><td><b>Email:</b> </td><td>'. $email .'</td></tr>
		</table>
		<p><b>Details:</b> '. $comment .'</p>
		</body>
		</head>
		</html>';
		$mailSend = $this->message->sendMail(trim($to), $message, $mail_subject);
		if(!$mailSend){
		  $response['status']= 'ok';
		  $response['message']= 'Message sent successfully!';
		}
		echo json_encode($response);
		exit;
	}
}
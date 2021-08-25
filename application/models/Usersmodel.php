<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersmodel extends CI_Model {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
	}
	
	public function login_user(){
	    $user_id= $this->session->userdata('user_id');
		
	    $this->db->select('ID as user_id, user_role, username, user_email, profile_pic, first_name, last_name, mobile_no, status, create_date');
	    $this->db->where('M.ID', $user_id);
	    $login_user_info = $this->db->get(TABLE_PREFIX . 'users M');
	    return $login_user_info->row();
	}
	
	public function login($username, $password){
	    
		if (empty($username)) {
            return;
        }
        if (empty($password)) {
            return;
        }
		
		$password = md5(utf8_encode(trim($password)));
		
	    $this->db->select('ID as user_id, user_role, username, user_email, profile_pic, first_name, last_name, mobile_no, status, create_date');
		$this->db->where("(username = '$username' OR user_email = '$username')");
	    $this->db->where('password', $password);
	    $result = $this->db->get(TABLE_PREFIX . 'users')->row_array();
		
		if(!empty($result)){
			return $result;
		}else{
			return FALSE;
		}
	}
	
	public function registration($param = array()){
	    
		if(empty($param['username'])){
            return;
        }else if(empty($param['password'])){
            return;
        }else if(empty($param['first_name'])){
            return;
        }else if(empty($param['last_name'])){
            return;
        }else if(empty($param['user_email'])){
            return;
        }else if(empty($param['mobile_no'])){
            return;
        }else if(empty($param['user_role'])){
            return;
        }
		$param['create_date'] = time();
		$param['password'] = md5(utf8_encode(trim($param['password'])));
		
		$this->db->insert(TABLE_PREFIX . 'users', $param);
		$param['user_id'] = $this->db->insert_id();
		return $param;
	}
	
	public function check_user_exist($username = null){
		
		$this->db->select('ID as user_id');
		$this->db->where('username', $username);
		$this->db->or_where('user_email', $username);
	    $data = $this->db->get(TABLE_PREFIX . 'users')->row_array();
		return $user_data = $data['user_id'];
	}
	
	public function get_user_by_id($user_id = null){
		$this->db->select('ID as user_id, user_role, username, user_email, profile_pic, first_name, last_name, mobile_no, status, create_date');
	    $this->db->where('M.ID', $user_id);
	    $login_user_info = $this->db->get(TABLE_PREFIX . 'users M');
	    return $login_user_info->row_array();
	}
	
	public function get_user_by($get_by=null, $value=null){
		if(empty($get_by)){ return; }
		
		if($get_by == 'id'){
		  $this->db->where('M.ID', $value);
		}else if($get_by == 'username'){
		  $this->db->where('M.username', $value);
		}else if($get_by == 'user_email'){
		  $this->db->where('M.user_email', $value);
		}else{ return; }
		
		$login_user_data = $this->db->get(TABLE_PREFIX . 'users M')->row_array();
	    return $login_user_data;
	}
	
	public function login_user_data($user_id = null){
		$this->db->select('ID as user_id, user_role, username, user_email, profile_pic, first_name, last_name, mobile_no, address, city, zip_code, country, status, create_date');
	    $this->db->where('M.ID', $user_id);
	    $login_user_info = $this->db->get(TABLE_PREFIX . 'users M');
	    return $login_user_info->row_array();
	}

	public function get_users($user_id=null, $page=null, $count=null){
		if ($page <= 0)  { $page = 1; }
        if ($count <= 0) { $count = 10; }
        $start = $count * ($page - 1);
        if ($count < 0) { $start = 0; }
		
		if(!empty($user_id)  && is_numeric($user_id)){
			$this->db->where('ID', $user_id);
		}
		$this->db->select('ID as user_id, user_role, username, user_email, profile_pic, first_name, last_name, mobile_no, status, create_date');
		$this->db->limit($count, $start);
		$results = $this->db->get(TABLE_PREFIX . 'users')->result_array();
		return $results;
	}
	
	public function update_user($user_id, Array $user){
	    $this->db->where('ID', $user_id)
	    		 ->update(TABLE_PREFIX . 'users', $user);
	}

	public function delete_user($user_id){
	    return $user=$this->db->delete(TABLE_PREFIX . 'users', ['ID'=>$user_id]);
	}
	
	public function save_user_meta($user_id, $param = array()){
	    if(empty($user_id)){ return; }
		if(empty($param)){ return;}
		foreach($param as $key => $value){
			$this->db->select('meta_id');
			$this->db->where(array('user_id' => $user_id, 'meta_key' => $key));
			$meta_data = $this->db->get(TABLE_PREFIX . 'users_meta')->num_rows();
			if(empty($meta_data)){
			  $data = array('user_id'=>$user_id, 'meta_key'=>$key, 'meta_value'=>$value, 'timestamp'=>time());
			  $this->db->insert(TABLE_PREFIX . 'users_meta', $data);	
			}else{
			  $data = array('user_id'=>$user_id, 'meta_key'=>$key, 'meta_value'=>$value, 'timestamp'=>time());
			  $this->db->where('user_id', $user_id);
			  $this->db->update(TABLE_PREFIX . 'users_meta', $data);
			}
		}
		return $param;
	}

}

?>
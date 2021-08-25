<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RestModel extends CI_Model {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
		$this->load->database();
	}
	
	public function  get_author_revenue($author_id){
		
		if(!empty($author_id)){
		  $this->db->where('author_id', $author_id);
		  return $details = $this->db->get(TABLE_PREFIX . 'plan_revenue_main')->row_array();
		}
	}
	
	public function  get_cart_products($user_id){
		
		if(empty($user_id)){
            return;
        }
		
		$this->db->select('P.*, C.qty, C.gross_total, C.net_amount');
		//$this->db->select("IFNULL(SUM(C.net_amount), 0) as subtotal",  FALSE );
		$this->db->where('order_id', 0);
		$this->db->where('user_id', $user_id);
		$this->db->join(TABLE_PREFIX . 'products as P', 'P.product_id = C.product_id');
		$this->db->group_by('cart_item_id');
		$data = $this->db->get(TABLE_PREFIX . 'cart_products as C')->result_array();
		
		$details = array();
		if(!empty($data)){
			$subtotal = '0.00';
			foreach ($data as $key=> $list){
				$subtotal = $subtotal + $list['gross_total'];
			}
			$details['subtotal'] = number_format((float)$subtotal, 2, '.', '');
			$details['list'] = $data;
		}
		return $details;
	}
	
	public function  get_current_order($user_id){
		
		if(empty($user_id)){
            return;
        }
		$this->db->where('user_id', $user_id);
		$this->db->where('order_status', 0);
		$this->db->order_by('order_id', 'DESC');
		$details = $this->db->get(TABLE_PREFIX . 'cart_orders')->row_array();
		return $details;
	}
	
	public function  confirm_order($user_id, $order_id, $order_status){
		
		if(empty($user_id)){
            return;
        }else if(empty($order_id)){
            return;
        }else if(empty($order_status)){
            return;
        }
		
		$data = array('order_status'=>$order_status,'modified_timestamp'=>time());
		$this->db->where(array('order_id'=>$order_id, 'user_id'=>$user_id));
		$update_data = $this->db->update(TABLE_PREFIX .'cart_orders', $data);
		if($update_data){
		  return 1;
		}
	}
	
	public function  add_plan($order_id){
		
		if(empty($order_id)){
            return;
        }
		$insert_id = 0;
		$date = date("Y-m-d");
		$year = intval($date);
		$timestamp = time();
		
		$this->db->select('t1.price, t1.qty, t1.user_id, t1.net_amount, t2.product_type, t2.product_id, t2.daily_payable');
		$this->db->where('order_id', $order_id);
		$this->db->join(TABLE_PREFIX . 'products as t2', 't2.product_id = t1.product_id');
		$cart_products = $this->db->get(TABLE_PREFIX .'cart_products as t1')->result_array();
		
		foreach($cart_products as $list){
			$this->db->where(array('product_id', $list['product_id']));
			$plan_details = $this->db->get(TABLE_PREFIX . 'products')->row_array();
			
			$plan_payable = $list['daily_payable'];
			$daily_payable = $plan_payable * $list['qty'];
			$total_amount = $list['net_amount'];
			$newDate = strtotime($date);
			$oldDate = strtotime('+1 year',$newDate);
			$end_date = date('Y-m-d', $oldDate);
			
			$insert_array = array(
			  'product_id' =>$list['product_id'],
			  'plan_type' =>$list['product_type'],
			  'plan_amount' =>$list['price'],
			  'total_amount' =>$list['net_amount'],
			  'daily_payable' =>$daily_payable,
			  'quantity' =>$list['qty'],
			  'user_id' =>$list['user_id'],
			  'start_date' =>$date,
			  'end_date' =>$end_date,
			  'status' =>'approved',
			  'timestamp' =>$timestamp,
			);
			
			$this->db->insert(TABLE_PREFIX . 'plan_list', $insert_array);
			$insert_id = $this->db->insert_id();
		}
		return $insert_id;
	}
}

?>
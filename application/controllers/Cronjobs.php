<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobs extends MY_Controller {
	
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
		
        $oauth_id = $this->input->get('oauth_id');
        $visit_from = $this->input->get('visit_from');
		
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
	
	/* ADD REVENUE */
    public function set_daily_plan_revenue() {
		$response['status'] = 'ok';
		$response['message'] = '';
        $response['details'] = array();
        
		$timestamp = time();
        $year = date("Y");
        $date = date("Y-m-d");
		
		/* CHECK HOLIDAY */
		$this->db->select('festival_id');
		$this->db->where('date', $date);
		$this->db->where('year', $year);
		$is_holyday = $this->db->get(TABLE_PREFIX . 'festivals')->num_rows();
		
		if($is_holyday > 0){
			$response['status'] = 'ok';
			$response['message'] = 'Sorry today is holiday';
			echo json_encode($response);
			exit;
		}
        

        $this->db->select('plan_id, daily_payable, author_id');
        $this->db->where('MAIN.plan_type', 'daily');
        $this->db->where('MAIN.is_active', 1);
        $this->db->where('MAIN.status', 'approved');
        $this->db->join(TABLE_PREFIX . 'users as U', 'U.ID = MAIN.author_id AND U.status = 1');
        $this->db->group_by('MAIN.plan_id');
        $plan_list = $this->db->get(TABLE_PREFIX . 'plan_list as MAIN')->result_array();
		//print_r($plan_list); exit;
		
        if (!empty($plan_list)) {
            foreach ($plan_list as $list) {
                $plan_id = $list['plan_id'];
                $author_id = $list['author_id'];
                $new_revenue = $list['daily_payable'];

                $this->db->where(array('author_id' => $author_id, 'revenue_type' => 1, 'day' => $date, 'object_id'=>$plan_id));
                $this->db->delete(TABLE_PREFIX . 'plan_revenue');

                $data = array(
                    'revenue' => $new_revenue,
                    'object_id' => $plan_id,
                    'author_id' => $author_id,
                    'revenue_type' => 1,
                    'day' => $date,
                    'timestamp' => $timestamp
                );
                $this->db->insert(TABLE_PREFIX . 'plan_revenue', $data);
            }
        }

        $response['status'] = 'ok';
        $response['message'] = count($plan_list) . ' data found';
        $response['details'] = $plan_list;
        echo json_encode($response);
        exit;
    }
	
	/* SET TOTAL REVENUE */
	public function set_total_revenue() {

        $timestamp = time();
        $date = date("Y-m-d");
        
        $this->db->select('SUM(revenue)as revenue, author_id');
        $this->db->where('day', $date);
        $this->db->group_by('MAIN.author_id');
        $author_revenue = $this->db->get(TABLE_PREFIX . 'plan_revenue as MAIN')->result_array();
		//print_r($author_revenue); exit;
		
        if (!empty($author_revenue)) {
            foreach ($author_revenue as $list) {
                $this->db->select('total_earning, available_revenue');
                $this->db->where('author_id', $list['author_id']);
                $details = $this->db->get(TABLE_PREFIX . 'plan_revenue_main')->row_array();

                if (!empty($details)) {
                    $data = array('total_earning' => $list['revenue'] + $details['total_earning'], 'available_revenue' => $list['revenue'] + $details['available_revenue']);
                    $this->db->where('author_id', $list['author_id']);
                    $this->db->update(TABLE_PREFIX . 'plan_revenue_main', $data);
					$response['details'] = 'Successfully update';
                } else {
                    $data = array(
                        'author_id' => $list['author_id'],
                        'total_earning' => $list['revenue'],
                        'available_revenue' => $list['revenue'],
                        'withdrawal' => 0,
                        'timestamp' => $timestamp
                    );
                    $this->db->insert(TABLE_PREFIX . 'plan_revenue_main', $data);
					$response['details'] = 'Successfully added';
                }
            }
        }

        $response['status'] = 'ok';
        echo json_encode($response);
        exit;
    }
	
	public function deactive_expire_plans() {
		$response['status'] = 'ok';
		$response['message'] = '';
        $response['details'] = array();
        
		$timestamp = time();
        $year = date("Y");
        $end_date = date("Y-m-d");
		
		/* CHECK HOLIDAY */
		$this->db->select('plan_id');
		$this->db->where('end_date', $end_date);
		$this->db->where('is_active', 1);
		$details = $this->db->get(TABLE_PREFIX . 'plan_list')->result_array();
		
		$count = 0;
		if(!empty($details)){
			foreach($details as $list){
				$count ++;
				$this->db->where('plan_id', $list['plan_id']);
				$this->db->update(TABLE_PREFIX . 'plan_list', array('is_active'=>0));
				
			}
		}
		
		$response['message'] = $count . ' Plans Deactive';
        $response['status'] = 'ok';
        echo json_encode($response);
        exit;
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genraloptions extends CI_Model 
{
	
	public function index($option_key = null){
		if(!empty($option_key)){
		$this->db->where('MAIN.option_key', $option_key);
		}
	    $result = $this->db->select('MAIN.option_key, MAIN.option_value');
	    $result = $this->db->get(TABLE_PREFIX . 'genraloptions MAIN')->result_array();
		$options = array();
		if(!empty($result)){
			foreach($result as $key=> $list){
			$options[$list['option_key']] = $list['option_value'];
			}
		}
		return $options;
	}
}

?>
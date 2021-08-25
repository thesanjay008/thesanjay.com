<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "libraries/SimpleImage.php");

class Mediamodel extends CI_Model {
	
	public function __construct(){
		date_default_timezone_set("Asia/Calcutta");
		parent::__construct();
	}
	
	public function upload_file($file=array()){
		$timestamp = time();
		if (!empty($file)) {
			$directory = $this->get_upload_directory();
			$image_name = md5($timestamp) . rand(11, 999);
			$image_type = '.jpg';
			$storage_name = $directory . $image_name . $image_type;
			$simple_image = new SimpleImage($file['tmp_name']);
			$simple_image->resizeToWidth(1024);
			$simple_image->save(FILES_PATH . $directory . $image_name . $image_type);
			
			$simple_image->square(150);
            $simple_image->save(FILES_PATH . $directory . $image_name . '150X150' . $image_type);
			
			return $storage_name;
        }
	}
	
	public function get_upload_directory(){
	    $year = date("Y");
		$month = date("d");
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
}

?>
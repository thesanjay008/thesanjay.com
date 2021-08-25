 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postmodel extends CI_Model {
	
	public function add_new($post_type){
		$date = date('Y-m-d');
		$timestamp = time();
		
		$data = array(
		 'post_author'=>$this->session->user_id,
		 'post_type'=>$post_type,
		 'post_status'=>'draft',
		 'post_date' =>	$date,
		 'post_modified'=>0,
		 'timestamp'=>$timestamp
		);
		$this->db->insert(TABLE_PREFIX . 'posts', $data);
		$post_id   = $this->db->insert_id();
		$post_slug = $this->generate_slug($post_id);
		return $post_id;
	}
	
	/* GENERATE SLUG */
	public function generate_slug($post_id, $post_slug=null){
		
		if(empty($post_id)){
			return;
		}
		if(!empty($post_slug)){
			$post_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post_slug)));
		}else
		{
			$post_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post_id)));
		}
		$data = array('post_slug' => $post_slug);
		$this->db->where('post_id', $post_id);
		$this->db->update(TABLE_PREFIX . 'posts', $data);
		return $post_slug;
	}
	
	/* INSERT POST */
	public function save_post($param = array()){
		
		/* DEFAULT VALUE */
		$is_admin = 0;
		$author_id = 0;
		$user_id = 0;
		$post_id = 0;
		$post_content = '';
		$date = date('Y-m-d');
		$timestamp = time();
		
		if (isset($param['post_id'])) {
            $post_id = $param['post_id'];
        }
		if (isset($param['post_title'])) {
            $post_title = $param['post_title'];
        }
		if (isset($param['post_slug'])) {
            $post_slug = $param['post_slug'];
        }else{
			$post_slug = $post_title;
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
		if (isset($param['post_status'])) {
            $post_status = $param['post_status'];
        }
		
		$insert_data = array(
			'post_type'		=>	$post_type,
			'post_title'	=>	$post_title,
			'post_content'	=>	$post_content,
			'post_author'	=>	$author_id,
			'post_status'	=>	$post_status,
			'post_date'		=>	$date,
			'timestamp'		=>	$timestamp,
		);
		
		$update_data = array(
			'post_title'	=>	$post_title,
			'post_content'	=>	$post_content,
			'post_status'	=>	$post_status,
		);
		
		if(!empty($post_id)){
			$this->db->where('post_id', $post_id);
			$results = $this->db->update(TABLE_PREFIX . 'posts', $update_data);
		}else{
			$results = $this->db->insert(TABLE_PREFIX . 'posts', $insert_data);
			$post_id = $this->db->insert_id();
			$post_slug = $this->generate_slug($post_id, $post_slug);
		}
		return $post_id;
	}
	
	/* INSERT POST META */
	public function save_meta($param = array()){
		
		/* DEFAULT VALUE */
		$post_id = 0;
		$parent_id = 0;
		$timestamp = time();
		
		if (isset($param['post_id'])) {
            $post_id = $param['post_id'];
        }
		if (isset($param['meta_name'])) {
            $meta_name = $param['meta_name'];
        }
		if (isset($param['tag_title'])) {
            $tag_title = $param['tag_title'];
        }
		if (isset($param['tag_slug'])) {
            $tag_slug = $param['tag_slug'];
        } else {
            $category_slug = $tag_title;
        }
		
		$insert_data = array(
			'post_id'	=>	$post_id,
			'meta_name'	=>	$meta_name,
			'meta_value'=>	$meta_value,
			'timestamp'	=>	$timestamp,
		);
		
		$results = $this->db->insert(TABLE_PREFIX . 'posts_meta', $insert_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	/* INSERT CATEGORY */
	public function save_category($param = array()){
		
		/* DEFAULT VALUE */
		$category_id = 0;
		$parent_id = 0;
		$timestamp = time();
		
		if (isset($param['post_type'])) {
            $post_type = $param['post_type'];
        } else {
            $post_type = "post";
        }
		if (isset($param['parent_id'])) {
            $parent_id = $param['parent_id'];
        }
		if (isset($param['category_id'])) {
            $category_id = $param['category_id'];
        }
		if (isset($param['category_title'])) {
            $category_title = $param['category_title'];
        }
		if (isset($param['category_slug'])) {
            $category_slug = $param['category_slug'];
        } else {
            $category_slug = $category_title;
        }
		
		$insert_data = array(
			'parent_id'	=>	$parent_id,
			'post_type'	=>	$post_type,
			'category_title' =>	$category_title,
			'category_slug'	=>	$category_slug,
			'timestamp'	=>	$timestamp,
		);
		
		if(!empty($category_id)){
			$results = $this->db->where('category_id', $category_id);
			$results = $this->db->update(TABLE_PREFIX . 'posts_categories', $insert_data);
			$insert_id = $category_id;
		}else{
			$results = $this->db->insert(TABLE_PREFIX . 'posts_categories', $insert_data);
			$insert_id = $this->db->insert_id();
		}
		return $insert_id;
	}
	
	/* INSERT TAG */
	public function save_tag($param = array()){
		
		/* DEFAULT VALUE */
		$tag_id = 0;
		$parent_id = 0;
		$timestamp = time();
		
		if (isset($param['post_type'])) {
            $post_type = $param['post_type'];
        } else {
            $post_type = "post";
        }
		if (isset($param['parent_id'])) {
            $parent_id = $param['parent_id'];
        }
		if (isset($param['tag_id'])) {
            $tag_id = $param['tag_id'];
        }
		if (isset($param['tag_title'])) {
            $tag_title = $param['tag_title'];
        }
		if (isset($param['tag_slug'])) {
            $tag_slug = $param['tag_slug'];
        } else {
            $category_slug = $tag_title;
        }
		
		$insert_data = array(
			'parent_id'	=>	$parent_id,
			'post_type'	=>	$post_type,
			'tag_title'	=>	$tag_title,
			'tag_slug'	=>	$tag_slug,
			'timestamp'	=>	$timestamp,
		);
		
		if(!empty($category_id)){
			$results = $this->db->where('tag_id', $tag_id);
			$results = $this->db->update(TABLE_PREFIX . 'posts_tags', $insert_data);
			$insert_id = $tag_id;
		}else{
			$results = $this->db->insert(TABLE_PREFIX . 'posts_tags', $insert_data);
			$insert_id = $this->db->insert_id();
		}
		return $insert_id;
	}
	
	/* GET POST */
	public function get_post($post_id){
		if(empty($post_id)){
			return;
		}
		$this->db->where('post_id', $post_id);
		$this->db->where('post_status != ', 'trash');
		$result = $this->db->get(TABLE_PREFIX . 'posts')->row_array();
		return $result;
	}
	
	/* GET POST */
	public function get_post_by_slug($post_slug){
		if(empty($post_slug)){
			return;
		}
		$this->db->where('post_slug', $post_slug);
		$this->db->where('post_status != ', 'trash');
		$result = $this->db->get(TABLE_PREFIX . 'posts')->row_array();
		return $result;
	}
	
	/* GET POST LIST */
	public function get_post_list($post_type, $page, $count){
		if ($page <= 0)  { $page = 1; }
        if ($count <= 0) { $count = 10; }
        $start = $count * ($page - 1);
        if ($count < 0) { $start = 0; }
		
		$this->db->select('MAIN.post_id, MAIN.post_author, MAIN.post_date, MAIN.post_title, MAIN.post_slug, MAIN.post_content, MAIN.post_status, MAIN.post_url, MAIN.post_type, MAIN.post_meta_title, MAIN.post_meta_keywords, MAIN.post_meta_description, MAIN.timestamp');
		$this->db->select('IF(MAIN.post_image = "","'. SITEURL .'/media/defoult/defoult.png",concat("'. SITEURL . '/media/", MAIN.post_image)) as post_image');
		$this->db->select('t2.first_name as author_name');
		$this->db->join(TABLE_PREFIX .'users t2', 'MAIN.post_author = t2.ID', 'LEFT');
		$this->db->where('MAIN.post_type', $post_type);
		$this->db->where('MAIN.post_status != ', 'trash');
		$this->db->order_by('MAIN.post_id', 'DESC');
		$this->db->limit($count, $start);
		$result = $this->db->get(TABLE_PREFIX . 'posts MAIN')->result_array();
		foreach($result as $key=>$list){
			$result[$key]['categories'] = array();
			$this->db->select('t2.category_id, t2.parent_id, t2.category_title, t2.category_slug');
			$this->db->join(TABLE_PREFIX .'categories t2', 't1.category_id = t2.category_id');
			$this->db->where(array('t2.is_active'=>1, 't2.is_deleted'=>0, 't1.post_id'=>$list['post_id']));
			$result[$key]['categories'] = $this->db->get(TABLE_PREFIX .'posts_categories t1')->result_array();
			$result[$key]['tag'] = array();
		}
		return $result;
	}
}

?>
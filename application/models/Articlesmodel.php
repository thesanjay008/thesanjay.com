<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articlesmodel extends CI_Model 
{
	
	public function articles_list()
	{
	    $this->db->select('ID, fname, lname, role');
	    $query = $this->db->get('users');

	    if($query->num_rows() > 0)
	    {
	        $results = $query->result();
	        return $results;
	    }
	    else
	    {
	        return FALSE;
	    }
	}
}

?>
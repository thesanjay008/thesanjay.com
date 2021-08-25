<?php
  $siteurl				= SITEURL;
  $library_url			= LIBRARY_URL;
  $media_url			= FILES_URL;
  $current_user_id		= $this->session->userdata('user_id');
  $current_user_role	= $this->session->userdata('user_role');
  $current_user_email	= $this->session->userdata('user_email');
  
  $this_user_data = $this->usersmodel->login_user_data($current_user_id);
  $genraloptions  = $this->genraloptions->index();
  //print_r($genraloptions); exit;
  

?>
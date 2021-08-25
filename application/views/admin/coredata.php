<?php

  $siteurl 		= SITEURL;
  $files_url	= FILES_URL;
  $library_url	= LIB_URL;
  
  $user_id		= $this->session->userdata('user_id');
  $this_user_data = $this->UsersModel->login_user_data($user_id);

?>
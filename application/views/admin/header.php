<header class="main-header">
    <!-- Logo -->
    <a class="logo" href="<?php echo $siteurl; ?>" target="_blank">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo $genraloptions['site_logo']; ?>" style="max-height:35px; max-width:35px;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo $genraloptions['site_logo']; ?>" style="max-width:145px;" alt="<?php echo $genraloptions['site_title']; ?>"></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $files_url . $this_user_data['profile_pic']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this_user_data['first_name'] .' '. $this_user_data['last_name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $files_url . $this_user_data['profile_pic']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this_user_data['first_name'] .' '. $this_user_data['last_name'] .' - '. ucfirst($this_user_data['user_role']); ?>
                  <small>Member since <?php echo date('M d Y', $this_user_data['create_date']); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="admin/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="admin/dashboard"><i class="fa fa-home"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
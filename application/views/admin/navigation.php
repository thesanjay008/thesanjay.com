  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $files_url . $this_user_data['profile_pic']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $login_user_info->first_name; ?> <?= $login_user_info->last_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu">
        <li class="dashboard_page">
          <a href="admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		<?php $nav_post_type = 'post'; ?>
		<li class="treeview" id="nav-<?php echo $nav_post_type; ?>">
          <a href="#">
            <i class="glyphicon glyphicon-pushpin"></i>
            <span>Posts</span>
          </a>
          <ul class="treeview-menu">
            <li class="nav-<?php echo $nav_post_type; ?>"><a href="admin/view"><i class="fa fa-circle-o"></i> All Posts</a></li>
            <li class="nav-add-<?php echo $nav_post_type; ?>"><a href="admin/add_new/<?php echo $nav_post_type; ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li class="nav-category-<?php echo $nav_post_type; ?>"><a href="admin/categories/<?php echo $nav_post_type; ?>"><i class="fa fa-circle-o"></i> Categories</a></li>
            <li class="nav-tag-<?php echo $nav_post_type; ?>"><a href="admin/tags/<?php echo $nav_post_type; ?>"><i class="fa fa-circle-o"></i> Tags</a></li>
          </ul>
        </li>
		
		<?php $nav_post_type = 'page'; ?>
		<li class="treeview" id="nav-<?php echo $nav_post_type; ?>">
          <a href="#">
            <i class="fa fa-clone"></i>
            <span>Pages</span>
          </a>
          <ul class="treeview-menu">
            <li class="nav-<?php echo $nav_post_type; ?>"><a href="admin/view/?post_type=<?php echo $nav_post_type; ?>"><i class="fa fa-circle-o"></i> All Pages</a></li>
            <li class="nav-add-<?php echo $nav_post_type; ?>"><a href="admin/add_new/<?php echo $nav_post_type; ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
          </ul>
        </li>
        <li class="treeview" id="nav-plans">
          <a href="#"><i class="fa fa-cubes"></i> <span>Plans</span>
		  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
		  <ul class="treeview-menu">
            <li class="nav-plans"><a href="admin/plans"><i class="fa fa-circle-o"></i> All Plans</a></li>
            <li class="nav-add-plans"><a href="admin/plans/add"><i class="fa fa-circle-o"></i> Add New</a></li>
          </ul>
        </li>
		<li class="treeview users">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="users_list"><a href="admin/users"><i class="fa fa-circle-o"></i> All Users</a></li>
            <li class="users_profile"><a href="admin/profile"><i class="fa fa-circle-o"></i> Your Profile</a></li>
          </ul>
        </li>
        <li class="treeview settings">
          <a href="#">
            <i class="fa fa-gear"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="settings_general"><a href="admin/settings/general"><i class="fa fa-circle-o"></i>General</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
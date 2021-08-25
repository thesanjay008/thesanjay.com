		<div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="<?php echo $siteurl; ?>">
                <img src="<?php echo $genraloptions['site_logo']; ?>" class="header-brand-img" alt="<?php echo $genraloptions['site_title']; ?>">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
				<a href="<?php echo $siteurl.'/cart'; ?>" class="nav-link icon">
                    <i class="fe fe-shopping-cart"></i>
				</a>
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(<?php echo $media_url .'/'. $this_user_data['profile_pic']; ?>)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default"><?php echo $this_user_data['first_name'] .' '. $this_user_data['last_name']; ?></span>
                      <small class="text-muted d-block mt-1"><?php echo ucfirst($this_user_data['user_role']); ?></small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="profile"><i class="dropdown-icon fe fe-user"></i> Profile</a>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="get_referralId();"><i class="dropdown-icon fa fa-sitemap"></i> My Referral ID</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="get_help();"><i class="dropdown-icon fe fe-help-circle"></i> Need help?</a>
                    <a class="dropdown-item" href="<?php echo $siteurl.'/logout'; ?>"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
		<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="<?php echo $siteurl; ?>" class="nav-link nav-dashboad"><i class="fe fe-home"></i> Dashboard</a>
                  </li>
				  <li class="nav-item">
                    <a href="<?php echo $siteurl; ?>/plans" class="nav-link nav-plans"><i class="fe fe-home"></i> Buy Plan</a>
                  </li>
                  <!--<li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Interface</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="cards.html" class="dropdown-item ">Cards design</a>
                      <a href="charts.html" class="dropdown-item ">Charts</a>
                      <a href="pricing-cards.html" class="dropdown-item ">Pricing cards</a>
                    </div>
                  </li>-->
                </ul>
              </div>
            </div>
          </div>
        </div>
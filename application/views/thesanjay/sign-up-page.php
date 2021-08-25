<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
if(!empty($current_user_id)){ return redirect(); }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<base href="<?php echo $siteurl.'/'; ?>">
	<title><?php echo $title; ?></title>
	
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    
	
	<!--<script src="<?php echo $library_url; ?>/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '<?php echo $library_url; ?>'
      });
    </script>
    <script src="<?php echo $library_url; ?>/assets/js/dashboard.js"></script>-->
	
    <link href="<?php echo $library_url; ?>/assets/css/dashboard.css" rel="stylesheet" />
    <!-- c3.js Charts Plugin -->
    <link href="<?php echo $library_url; ?>/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="<?php echo $library_url; ?>/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="<?php echo $library_url; ?>/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="<?php echo $library_url; ?>/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="<?php echo $library_url; ?>/assets/plugins/input-mask/plugin.js"></script>
    <!-- Datatables Plugin -->
    <script src="<?php echo $library_url; ?>/assets/plugins/datatables/plugin.js"></script>
	
	<!-- -->
	<script src="<?php echo $library_url; ?>/assets/js/vendors/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/core.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/jquery.sparkline.min.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/selectize.min.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/jquery.tablesorter.min.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/jquery-jvectormap-de-merc.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/jquery-jvectormap-world-mill.js"></script>
	<script src="<?php echo $library_url; ?>/assets/js/vendors/circle-progress.min.js"></script>
	<!-- -- >
	
	<!-- Extra -->
	<script src="<?php echo $library_url; ?>/extra/sweetalert2@8.js"></script>
	
	<!-- Custom -->
	<script src="<?php echo $library_url; ?>/custom.css"></script>
	<script src="<?php echo $library_url; ?>/custom.js"></script>
</head>

  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="demo/brand/tabler.svg" class="h-6" alt="">
              </div>
              <form id="register" class="card" action="javascript:void(0);" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Create new account</div>
                  <div class="form-group">
                    <label class="form-label">First name</label>
                    <input type="text" id="first_name" class="form-control" placeholder="Enter First name">
                  </div>
				  <div class="form-group">
                    <label class="form-label">Last name</label>
                    <input type="text" id="last_name" class="form-control" placeholder="Enter Last name">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter email">
                  </div>
				  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Enter Username">
                  </div>
				  <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter Password">
                  </div>
				  <div class="form-group">
                    <label class="form-label">Mobile No</label>
                    <input type="text" id="mobile_no" class="form-control" placeholder="Enter Mobile No">
                  </div>
				  <div class="form-group">
                    <label class="form-label">Referral ID</label>
                    <input type="text" id="referral_id" class="form-control" placeholder="Enter Referral id">
                  </div>
                  <!--<div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input id="accept_terms" type="checkbox" name="accept_terms" class="accept_terms"/>
                      <span class="custom-control-label">Agree the <a href="#">terms and policy</a></span>
                    </label>
                  </div>-->
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                Already have account? <a href="sign-in">Sign in</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  
	<script>
		$(document).ready(function () {
		  $('#register').submit(function(){
			register_user();
			return false;
		  })
		});
		
		var register_user = (function () {
			var data = new FormData();
			var accept_terms = 1;
			
			data.append('visit_from', 'web');
			data.append('first_name', $('#first_name').val());
			data.append('last_name', $('#last_name').val());
			data.append('user_email', $('#user_email').val());
			data.append('username', $('#username').val());
			data.append('password', $('#password').val());
			data.append('mobile_no', $('#mobile_no').val());
			data.append('referral_id', $('#referral_id').val());
			data.append('accept_terms', accept_terms);
			data.append('user_role', 'subscriber');
			
			$.ajax({
				url: "restapis/user_registration",
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					var htmlData = '';
					if (response.status == 'ok') {
						swal.fire({
							type: 'success',
							title: response.message,
						});
						setTimeout(function(){ 
						  window.location.href = "<?php echo $siteurl;?>";
						}, 3000);
						
					}else{
						swal.fire({
							type: 'error',
							title: response.message,
						});
						return false;
					}
				}
			});
			return false;
		});
	</script>
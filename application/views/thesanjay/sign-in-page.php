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
                <img src="<?php echo $genraloptions['site_logo']; ?>" class="" alt="">
              </div>
              <form id="sign-in" class="card" action="javascript:void(0);" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" id="exampleInputUsername" placeholder="Enter Username or Email id">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <a href="forgot-password" class="float-right small">I forgot password</a>
                    </label>
                    <input type="password" id="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                Don't have account yet? <a href="sign-up">Sign up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  
	<script>
		$(document).ready(function () {
		  $('#sign-in').submit(function(){
			sign_in_user();
			return false;
		  })
		});
		
		var sign_in_user = (function () {
			var data = new FormData();
			
			data.append('visit_from', 'web');
			data.append('username', $('#username').val());
			data.append('password', $('#password').val());
			
			$.ajax({
				url: "restapis/user_login",
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
							showConfirmButton: false,
							timer: 1500
						});
						setTimeout(function(){ 
						  window.location.href = "<?php echo $siteurl;?>";
						}, 2000);
						
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
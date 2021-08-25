    <section class="content-header">
      <h1>Profile Setting</h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
              <div class="box-body box-profile">
                <center>
                  <div class="user-panel">
                    <div class="profile-image">
                    <img class="profile-user-img img-responsive img-circle stc" src="<?php echo $files_url . $this_user_data['profile_pic']; ?>" alt="<?php echo $this_user_data['first_name'] .' '. $this_user_data['last_name']; ?>">
                    </div>
                  </div>
                </center>
                <h3 class="profile-username text-center"><?php echo $this_user_data['first_name'] .' '. $this_user_data['last_name']; ?></h3>
                <p class="text-muted text-center"></p>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <input type="file" id="profile_pic" name="profile_pic" required >
                    <input type="hidden" name="user_id" value="<?php echo $details['user_id']; ?>">
                  </li>
                </ul>
              </div>
            </div>
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">About Me</h3>
				</div>
				<div class="box-body box-profile">
				  <ul class="list-group list-group-unbordered">
					<li class="list-group-item">
					  <b>Email: </b> <a class="pull-right"><?php echo $this_user_data['user_email']; ?></a>  
					</li>
					<li class="list-group-item">
					  <b>IP ADD. : </b> <a class="pull-right">::1</a>  
					</li>
					<li class="list-group-item">
					  <b>Last Login : </b> <a class="pull-right">14-June-2017</a>
					</li>
					<li class="list-group-item">
					  <b>Member Since : </b> <a class="pull-right"><?php echo date('M d Y', $this_user_data['create_date']); ?></a>
					</li>
				  </ul>
				</div>
			</div>
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Profile Setting</a></li>
            </ul>
           <div class="tab-content">
              <div class="active tab-pane " id="activity">
                <form  id="save_profile" class="form-horizontal" method="POST" enctype="multipart/form-data" action="javascript:void(0)">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="first_name" value="<?php echo $details['first_name']; ?>" placeholder="Name">
                      <input type="hidden" id="user_id" value="<?php echo $details['user_id']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="last_name" value="<?php echo $details['last_name']; ?>" placeholder="Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="user_email" value="<?php echo $details['user_email']; ?>" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Mobile No.</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="mobile_no" value="<?php echo $details['mobile_no']; ?>" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Userame</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="username" value="<?php echo $details['username']; ?>" placeholder="Username" disabled>
                    </div>
                  </div>
				  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <a class="btn btn-primery" href="javascript:void(0);"><b>Change Password</b></a>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                      <button type="submit" class="btn btn-primary" name="save_profile">Save Profile</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- //Main content over-->
	
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.users').addClass('active');
			$('.users_profile').addClass('active');
			
			jQuery("#profile_pic").change(function () {
			  readURL(this);
			});
			jQbox({
			  //title: title,
			  //type: 'success',
			  //message: 'Data added',
			  //confirmButtonText: 'Submit',
			  //cancelButtonText: 'Cancel',
			  //showCancelButton: true,
			  //showConfirmButton: false,
			  //onConfirmbtn: function_name(),
			  width: '25%',
			  html: '<p>Lorem ipsom...</p>',
			});
		});
		
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					new_image = e.target.result;
					jQuery('.profile-user-img').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$( "#save_profile" ).on('submit', function(event) {
			event.preventDefault();
			var data = new FormData(this);
			data.append('visit_from', 'web');
			data.append('user_id', $('#user_id').val());
			data.append('first_name', $('#first_name').val());
			data.append('last_name', $('#last_name').val());
			data.append('username', $('#username').val());
			data.append('user_email', $('#user_email').val());
			data.append('mobile_no', $('#mobile_no').val());
			data.append('profile_pic', jQuery('#profile_pic')[0].files[0]);
			
			$.ajax({
				url: "restapis/save_profile",
				type: "POST",
				dataType: "json",
				async: true,
				cache:false,
				contentType: false,
				processData: false,
				data: data,
				success: function (response) {
					if (response.status == 'ok') {
						swal({
							type: 'success',
							title: response.message,
							showConfirmButton: false,
							timer: 1500,
							onClose: function () {
								location.reload('true');
							}
						});
						return false;
					}else{
						swal({
							type: 'error',
							title: response.message,
						});
						return false;
					}
				},
				error: function (jXHR, textStatus, errorThrown) {
					//alert(errorThrown);
					return false;
				}
			});
			return false;
		});
	</script>
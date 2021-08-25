<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');
?>

	<div class="my-3 my-md-5">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-4">
			<div class="card card-profile">
			  <div class="card-header" style="background-image: url(demo/photos/eberhard-grossgasteiger-311213-500.jpg);"></div>
			  <div class="card-body text-center">
				<img class="card-profile-img" src="<?php echo $media_url .'/'. $this_user_data['profile_pic']; ?>">
				<input type="file" id="profile_pic" class="profile_pic form-control" accept=".png, .jpg, .jpeg">
				<br>
				<h3 class="mb-3"><?php echo $this_user_data['first_name'] .' '. $this_user_data['last_name']; ?></h3>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-8">
			<form id="user-profile" class="card" action="javascript:void(0);">
			  <div class="card-body">
				<h3 class="card-title">Edit Profile</h3>
				<div class="row">
				  <div class="col-md-5">
					<div class="form-group">
					  <label class="form-label">First name</label>
					  <input type="text" id="first_name" class="form-control" placeholder="First Name" value="<?php echo $this_user_data['first_name']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-3">
					<div class="form-group">
					  <label class="form-label">Last name</label>
					  <input type="text" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo $this_user_data['last_name']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">Email address</label>
					  <input type="email" id="user_email" class="form-control" placeholder="Email" value="<?php echo $this_user_data['user_email']; ?>">
					</div>
				  </div>
				  <div class="col-md-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">Mobile No</label>
					  <input type="text" id="mobile_no" class="form-control" placeholder="Mobile No" value="<?php echo $this_user_data['mobile_no']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">City</label>
					  <input type="text" id="city" class="form-control" placeholder="City" value="<?php echo $this_user_data['city']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-3">
					<div class="form-group">
					  <label class="form-label">Postal Code</label>
					  <input type="number" id="zip_code" class="form-control" placeholder="ZIP Code" value="<?php echo $this_user_data['zip_code']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-3">
					<div class="form-group">
					  <label class="form-label">Country</label>
					  <input type="text" id="country" class="form-control" placeholder="Country" value="<?php echo $this_user_data['country']; ?>">
					</div>
				  </div>
				  <div class="col-md-12">
					<div class="form-group mb-0">
					  <label class="form-label">Address</label>
					  <textarea rows="5" id="address" class="form-control" placeholder="Here can be your description"><?php echo $this_user_data['address']; ?></textarea>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="card-footer text-right">
				<button type="submit" class="btn btn-primary">Update Profile</button>
			  </div>
			</form>
			
			<form id="bank-details" class="card" action="javascript:void(0);">
			  <div class="card-body">
				<h3 class="card-title">Edit Bank Details</h3>
				<div class="row">
				  <div class="col-md-5">
					<div class="form-group">
					  <label class="form-label">Bank Name</label>
					  <input type="text" class="form-control" id="bank_name" placeholder="Bank Name" value="">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-3">
					<div class="form-group">
					  <label class="form-label">Account No</label>
					  <input type="text" class="form-control" id="account_no" placeholder="Account No" value="">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">IFSC Code</label>
					  <input type="text" class="form-control" id="ifsc_code" placeholder="IFSC Code" value="">
					</div>
				  </div>
				  <div class="col-md-12">
					<div class="form-group mb-0">
					  <label class="form-label">About Me</label>
					  <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike"></textarea>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="card-footer text-right">
				<button type="submit" class="btn btn-primary">Update</button>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
	
	<script>
		$(document).ready(function () {
		  get_bankdetails();
		  
		  $('#user-profile').submit(function(){
			save_profile();
			return false;
		  })
		  $('#bank-details').submit(function(){
			save_user_bankdetails();
			return false;
		  })
		  
		  jQuery(".profile_pic").change(function () {
			readURL(this);
		  });
		});
		
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					new_image = e.target.result;
					jQuery('.card-profile-img').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		var get_bankdetails = (function () {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('user_id', '<?php echo $current_user_id; ?>');
			data.append('page', 1);
			data.append('count', 10);
			$.ajax({
				url: "restapis/get_user_bankdetails",
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					if (response.status == 'ok') {
						$.each(response.details, function( index, value ) {
						  $('#bank_name').val(response.details.bank_name);
						  $('#account_no').val(response.details.account_no);
						  $('#ifsc_code').val(response.details.ifsc_code);
						});
						
					}
				}
			});
		});
		var save_profile = (function () {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('user_id', '<?php echo $current_user_id; ?>');
			data.append('first_name', $('#first_name').val());
			data.append('last_name', $('#last_name').val());
			data.append('user_email', $('#user_email').val());
			data.append('mobile_no', $('#mobile_no').val());
			data.append('addressline2', $('#addressline2').val());
			data.append('city', $('#city').val());
			data.append('zip_code', $('#zip_code').val());
			data.append('country', $('#country').val());
			data.append('address', $('#address').val());
			data.append('profile_pic', jQuery('#profile_pic')[0].files[0]);
			
			$.ajax({
				url: "restapis/save_profile",
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
						  window.location.reload();
						}, 2000);
						
					}else{
						swal.fire({
							title: response.message,
							type: 'error',
						});
						return false;
					}
				}
			});
			return false;
		});
		
		var save_user_bankdetails = (function () {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('user_id', '<?php echo $current_user_id; ?>');
			data.append('bank_name', $('#bank_name').val());
			data.append('account_no', $('#account_no').val());
			data.append('ifsc_code', $('#ifsc_code').val());
			
			$.ajax({
				url: "restapis/save_user_bankdetails",
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
						  window.location.reload();
						}, 2000);
						
					}else{
						swal.fire({
							title: response.message,
							type: 'error',
						});
						return false;
					}
				}
			});
			return false;
		});
	</script>
<?php include_once('footer.php'); ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');

$order_data = $this->restModel->get_current_order($current_user_id);
if(empty($order_data)){ return redirect('plans'); }
?>
	<div class="my-3 my-md-5">
	  <div class="container">
		<div class="page-header">
		  <h1 class="page-title">Checkout</h1>
		</div>
		<div class="row">
		  <div class="col-lg-8">
			<form class="card" id="checkout">
			  <div class="card-body">
				<h3 class="card-title">Edit Profile</h3>
				<div class="row">
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">First Name</label>
					  <input type="text" class="form-control" placeholder="Company" id="first_name" value="<?php echo $order_data['first_name']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">Last Name</label>
					  <input type="text" class="form-control" placeholder="Last Name" id="last_name" value="<?php echo $order_data['last_name']; ?>">
					</div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">Username</label>
					  <input type="text" class="form-control" placeholder="Username" id="username" value="<?php echo $this_user_data['username']; ?>" disabled>
					</div>
				  </div>
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">Email address</label>
					  <input type="email" class="form-control" placeholder="Email" id="email" value="<?php echo $order_data['email']; ?>">
					</div>
				  </div>
				  <div class="col-md-12">
					<div class="form-group">
					  <label class="form-label">Address line 1</label>
					  <input type="text" class="form-control" placeholder="Flat no, area etc." id="addressline1" value="<?php echo $order_data['addressline1']; ?>">
					</div>
				  </div>
				  <div class="col-md-12">
					<div class="form-group">
					  <label class="form-label">Address line 2</label>
					  <input type="text" class="form-control" placeholder="Street, Landmark" id="addressline2" value="<?php echo $order_data['addressline2']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-4">
					<div class="form-group">
					  <label class="form-label">City</label>
					  <input type="text" class="form-control" placeholder="City" id="city" value="<?php echo $order_data['city']; ?>">
					</div>
				  </div>
				  <div class="col-sm-6 col-md-3">
					<div class="form-group">
					  <label class="form-label">Postal Code</label>
					  <input type="number" class="form-control" placeholder="ZIP Code" id="pincode" value="<?php echo $order_data['pincode']; ?>">
					</div>
				  </div>
				  <div class="col-md-5">
					<div class="form-group">
					  <label class="form-label">Country</label>
					  <select id="country" class="form-control custom-select">
						<option value="india">India</option>
					  </select>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="card-footer text-right">
			    <input type="hidden" class="form-control" id="order_id" value="<?php echo $order_data['order_id']; ?>">
				<button type="submit" class="btn btn-primary">Place Order</button>
			  </div>
			</form>
		  </div>
		  <div class="col-lg-4">
			<div class="card">
			  <div class="card-header">
				<h3 class="card-title">Details</h3>
			  </div>
			  <div class="card-body">
				<form>
				  <div class="row">
					<div class="col-auto">
					  <span class="avatar avatar-xl" style="background-image: url(demo/faces/female/9.jpg)"></span>
					</div>
					<div class="col">
					  <div class="form-group">
						<label class="form-label">Total Amount</label>
						<input class="form-control" value="<?php echo $order_data['subtotal']; ?>" disabled>
					  </div>
					</div>
				  </div>
				  <div class="form-group">
					<label class="form-label">Description</label>
					<textarea class="form-control" rows="5">Lorem ipsom dolor sit amet... Lorem ipsom dolor sit amet...</textarea>
				  </div>
				</form>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<script>
		$(document).ready(function () {
		  $('#checkout').submit(function(){
			checkout();
			return false;
		  })
		});
		var checkout = (function () {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('order_id', $('#order_id').val());
			data.append('user_id', '<?php echo $current_user_id; ?>');
			data.append('first_name', $('#first_name').val());
			data.append('last_name', $('#last_name').val());
			data.append('email', $('#email').val());
			data.append('addressline1', $('#addressline1').val());
			data.append('addressline2', $('#addressline2').val());
			data.append('city', $('#city').val());
			data.append('pincode', $('#pincode').val());
			data.append('country', $('#country').val());
			
			$.ajax({
				url: "restapis/checkout",
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					var htmlData = '';
					if (response.status == 'ok') {
						window.location.href = "<?php echo $siteurl.'/payment-process';?>";
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
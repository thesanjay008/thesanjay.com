<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('coredata.php');
include_once('header.php');
?>
	<div class="my-3 my-md-5">
	  <div class="container">
		<div class="page-header">
		  <h1 class="page-title">Select Plan</h1>
		</div>
		<div class="row" id="plan-list">
		  
		</div>
	  </div>
	</div>
	<script>
	  $(document).ready(function () {
		$('.nav-plans').addClass('active');
		get_product_list();
	  });
	  
	  var get_product_list = (function () {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('user_id', '<?php echo $current_user_id; ?>');
			data.append('page', 1);
			data.append('count', 10);
			$.ajax({
				url: "restapis/get_product_list",
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					if (response.status == 'ok') {
						var htmlData = '';
						$.each(response.details, function( index, value ) {
						  if(value.product_type != 'forth'){
						  htmlData+= '<div class="col-sm-6 col-lg-4">'+
										'<div class="card">'+
										  '<div class="card-body text-center">'+
											'<div class="card-category">'+ value.product_title +'</div>'+
											'<div class="display-3 my-4"> Rs. '+ value.price +'</div>'+
											'<ul class="list-unstyled leading-loose"> '+ value.product_description +' </ul>'+
											'<div class="text-center mt-6">'+
											  '<a href="javascript:void(0);" onclick="get_this_plan('+ value.product_id +');" class="btn btn-secondary btn-block">Choose plan</a>'+
											'</div>'+
										  '</div>'+
										'</div>'+
									'</div>';
						  }
						});
						$('#plan-list').html(htmlData);
					}
				}
			});
		});
		
	  var get_this_plan = (function (plan) {
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('user_id', '<?php echo $current_user_id; ?>');
			data.append('product_id', plan);
			data.append('qty', 1);
			$.ajax({
				url: "restapis/add_to_cart",
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
						  window.location.href = "<?php echo $siteurl.'/cart';?>";
						},1000);
					}else{
						swal.fire({
							title: response.message,
							type: 'error',
						});
					}
				}
			});
			return false;
		});
	</script>
<?php include_once('footer.php'); ?>
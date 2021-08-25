<!-- Main content -->
	<section class="content">
		<form id="standard_add" action="#" method="post">
			<div class="row">
				<div class="col-md-3">
					<div class="box-body">
						
						<div class="form-group">
							<label>Standard Name</label>
							<input type="text" name="standard_name" id="standard_name" value="" class="form-control" placeholder="Enter Name">
							<span></span>
						</div>
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="is_active" id="is_active" style="width: 100%;">
							 <option value="1">Active</option>
							 <option value="0">Inactive</option>
							</select>
						</div>
						<div class="form-group">							
							<button type="submit" name="standard_add" class="standard_add btn btn-primary">Submit</button>								
						</div>
					</div>	
				</div>
			</div>
		</form>
	</section>
    <!-- //Main content over-->
	
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.standard').addClass('active');
			
			$('#standard_add').submit(function(event){
				event.preventDefault();
				
				var data = {
					visit_from : "web",
					standard_name : $("#standard_name").val(),
					is_active : $("#is_active").val(),
				};
				
				$.ajax({
					url: "OAuth/standard_add",
					type: "POST",
					dataType: "json",
					async: true,
					data: data,
					success: function (response) {
						if (response.status == 1) {
							swal({
								title: 'Success!',
								text: response.message,
								type: 'success',
							});
							window.location.href = "admin/standard";
						}else{
							swal({
								title: 'Error!',
								text: response.message,
								type: 'error',
							});
							return false;
						}
					},
					error: function (jXHR, textStatus, errorThrown) {
						alert(errorThrown);
					}
				});
				return false;
			});
		});
	</script>
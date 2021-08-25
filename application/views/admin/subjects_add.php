<!-- Main content -->
	<section class="content">
		<form id="subject_add" action="#" method="post">
			<div class="row">
				<div class="col-md-3">
					<div class="box-body">
						<div class="form-group">
							<label>Select Standard</label>
							<select class="form-control" name="standard_id" id="standard_id" style="width: 100%;">
							 <option value="">-- Select --</option>
							</select>
						</div>
						<div class="form-group">
							<label>subject Name</label>
							<input type="text" name="subject_name" id="subject_name" value="" class="form-control" placeholder="Enter Name">
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
							<button type="submit" name="subject_add" class="subject_add btn btn-primary">Submit</button>								
						</div>
					</div>	
				</div>
			</div>
		</form>
	</section>
    <!-- //Main content over-->
	
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.subjects').addClass('active');
			$('.subjects_add').addClass('active');
			
			get_standardslist();
			
			$('#subject_add').submit(function(event){
				event.preventDefault();
				
				var data = {
					visit_from : "web",
					standard_id : $("#standard_id").val(),
					subject_name : $("#subject_name").val(),
					is_active : $("#is_active").val(),
				};
				
				$.ajax({
					url: "OAuth/subject_add",
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
							window.location.href = "admin/subjects";
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
		
		var get_standardslist = function (e) {
			var data = {
				visit_from : 'web',
				is_active : 1,
			};
			$.ajax({
				url: "OAuth/standardslist",
				type: "POST",
				dataType: "json",
				async: true,
				data: data,
				success: function (response) {
					if (response.status == 1) {
						var vHtml = '';
						var status = 'Inactive';
						if(response.details.length>0){
							$.each(response.details, function(key, value){
								var selected = '';
								if(value.is_active == 1){
									status = 'active';
								}
								if(value.standard_id == '<?php echo $standard_id; ?>'){
									selected = 'selected';
								}
								vHtml+='<option value="'+ value.standard_id +'" '+ selected +'>'+ value.standard_name +'</option>';
							});
							$('#standard_id').append(vHtml);
							return false;
						}
						return false;
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
		};
	</script>
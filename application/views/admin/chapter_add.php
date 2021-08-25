<!-- Main content -->
	<section class="content">
		<form id="chapter_add" action="#" method="post">
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
							<label>Select Subject</label>
							<select class="form-control" name="subject_id" id="subject_id" style="width: 100%;">
							 <option value="">-- Select --</option>
							</select>
						</div>
						<div class="form-group">
							<label>chapter Name</label>
							<input type="text" name="chapter_name" id="chapter_name" value="" class="form-control" placeholder="Enter Name">
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
							<button type="submit" name="chapter_add" class="chapter_add btn btn-primary">Submit</button>								
						</div>
					</div>	
				</div>
			</div>
		</form>
	</section>
    <!-- //Main content over-->
	
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.chapters').addClass('active');
			$('.chapters_add').addClass('active');
			
			get_standardslist();
			
			$('#standard_id').on('change', function(event){
				get_subjectslist();
			});
			
			$('#chapter_add').submit(function(event){
				event.preventDefault();
				var subject_id = $("#subject_id").val();
				if(subject_id == ''){
					swal({
						title: 'Error!',
						text: 'Selecr valid Subject',
						type: 'error',
					});
					return false;
				}
				
				var data = {
					visit_from : "web",
					subject_id : $("#subject_id").val(),
					chapter_name : $("#chapter_name").val(),
					is_active : $("#is_active").val(),
				};
				
				$.ajax({
					url: "OAuth/chapter_add",
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
							window.location.href = "admin/chapters";
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
								vHtml+='<option value="'+ value.standard_id +'">'+ value.standard_name +'</option>';
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
		
		var get_subjectslist = function (e) {
			
			var standard_id = $("#standard_id").val();
			
			if(standard_id == ''){
				return false;
			}
			
			var data = {
				visit_from : 'web',
				standard_id : standard_id,
				is_active : 1,
			};
			$.ajax({
				url: "OAuth/subjectslist",
				type: "POST",
				dataType: "json",
				async: true,
				data: data,
				success: function (response) {
					if (response.status == 1) {
						var vHtml = '<option value="">-- Select --</option>';
						if(response.details.length>0){
							$.each(response.details, function(key, value){
								vHtml+='<option value="'+ value.subject_id +'">'+ value.subject_name +'</option>';
							});
						}
						$('#subject_id').html(vHtml);
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
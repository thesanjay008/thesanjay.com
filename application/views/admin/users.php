    <section class="content-header">
      <h1><?php echo $page_title; ?> <small><a class="btn-sm btn-primary" href="javascript:void(0)" onclick="save_admins();">Add New<a></small></h1>
	  <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $page_title; ?></li>
      </ol>
    </section>
	
	<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
			<div class="box-header">
              <h3 class="box-title count_total"></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" id="search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <a id="search_publishers" class="btn btn-default"><i class="fa fa-search"></i></a>
                  </div>
                </div>
              </div>
            </div>
			<div class="box-body table-responsive no-padding">
			  <table class="table table-hover">
				<thead>
				  <tr class="table-head">
					<th>#</th>
					<th>Name</th>
					<th>Role</th>
					<th>Email Id.</th>
					<th>Staus</th>
					<th>Date</th>
					<th style="width:160px;" class="text-center">Action</th>
				   </tr>
				</thead>
				<tbody id="admins-list">
				</tbody>
			  </table>
            </div>
            <div class="box-footer nr-pagination clearfix">
              <a href="javascript:void(0);" class="next-page btn btn-sm btn-danger btn-flat pull-right">Next</a>
              <a href="javascript:void(0);" class="preview-page btn btn-sm btn-danger btn-flat pull-right">Preview</a>
            </div>
          </div>
        </div>
      </div>
    </section>
	
	<script>
		$('.users').addClass('active');
		$('.users_list').addClass('active');
		
		jQuery(document).ready(function () {
			var user_id = 0;
			var page = 1;
			var count = 7;
			
			get_users(user_id, page, count);
			
			$('#search_publishers').click(function(){
				var search = $('#search').val();
				get_users(user_id, page, count);
			});
			$('.next-page').click(function(){
				var page = parseInt($('.pagenow').attr('data-val'))+1;
				get_users(user_id, page, count);
			});
			$('.preview-page').click(function(){
				var page = parseInt($('.pagenow').attr('data-val'))-1;
				get_users(user_id, page, count);
			});
			
		});
		var get_users = (function (user_id=null, page=null, count=null) {
			
			var data = new FormData();
			data.append('visit_from', 'web');
			data.append('field_data1', user_id);
			data.append('field_data2', page);
			data.append('field_data3', count);
			data.append('field_data4', $('#search').val());

			//nr_main_loader('show');
			$.ajax({
				url: "restapis/get_users",
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					var htmlData = '';
					var count_total = 0;
					if (response.status == 'ok') {
						$('#admins-list').empty();
						if(response.details.length > 0){
							var uni_index = response.start;
							var pagenow = response.page;
							
							$.each(response.details, function( index, value ) {
								uni_index = uni_index + 1;
								
								var is_active_txt = 'Active';
								var is_active_btn = 'success';
								if(value.is_active == 0){
									is_active_txt = 'Deactive';
									is_active_btn = 'danger';
								}
								var date = moment.unix(value.create_date).format("DD-MMMM-YYYY");
								
								htmlData+= '<tr id="'+ value.user_id +'">'+
											'<td class="hide-this pagenow" data-val="'+ pagenow +'"></td>'+
											'<td>'+ uni_index +'</td>'+
											'<td><a href="javascript:void(0)" onclick="save_admins('+ value.user_id +');">'+ value.first_name +' '+ value.last_name +'</a></td>'+
											'<td>'+ value.user_role +'</td>'+
											'<td>'+ value.user_email +'</td>'+
											'<td><span class="lang-box label label-'+ is_active_btn +'">'+ is_active_txt +'</span></td>'+
											'<td>'+ date +'</td>'+
											'<td class="text-center">'+
											  '<a data-toggle="tooltip" title="View" href="javascript:void(0)" onclick="save_admins('+ value.user_id +');" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>'+
											'</td>'+
										  '</tr>';
							});
							$('#admins-list').append(htmlData);
							count_total = response.count_total;
							if(page > 1){
								$('.preview-page').show();
							}else{
								$('.preview-page').hide();
							}
							
							if(page < response.pages){
								$('.next-page').show();
							}else{
								$('.next-page').hide();
							}
						}else{
							$('.next-page').hide();
						}
						$('.count_total').text('Total ' + count_total+' records found');
					}else{
						swal.fire({
							title: response.message,
							type: 'error',
						});
					}
					//nr_main_loader('hide');
				},
			});
			return false;
		});
		
		var save_admins = (function (user_id=null) {
			//var admin_data = get_this_admin(user_id);
			var admin_data = null;
			var action = 'add';
			var username = '';
			var password = '';
			var user_email = '';
			var first_name = '';
			var last_name = '';
			var user_role = '';
			var profile_pic = '';
			var is_active = '';
			var create_date = '';
			var is_username_dsbl = '';
			var title = 'Add Admin';
			passwordHtml = '<label>Password</label><input type="password" id="password" class="form-control" value="" placeholder="Enter Temp password">';
			
			if(user_id != null && admin_data == null){
				swal.fire({
					title: '',
					title: 'Invalid admin',
					type: 'error',
				});
				return false;
			}
			
			if(admin_data != null){
				user_id = admin_data.user_id;
				username = admin_data.username;
				password = admin_data.password;
				user_email = admin_data.user_email;
				first_name = admin_data.first_name;
				last_name = admin_data.last_name;
				user_role = admin_data.user_role;
				profile_pic = admin_data.profile_pic;
				is_active = admin_data.is_active;
				create_date = admin_data.create_date;
				is_username_dsbl = 'disabled';
				title = 'Edit Admin';
				passwordHtml = '';
			}
			if(user_id == null){
				user_id = '';
			}
			var htmldata = '<form class="sav_admins" action="javascript:void(0)" method="POST">'+
							'<div class="box-body text-left">'+
							  '<div class="row">'+
								'<div class="col-md-4">'+
								  '<div class="form-group">'+
									'<label>Username</label>'+
									'<input type="text" id="username" class="form-control" value="'+ username +'" placeholder="Enter Username" '+ is_username_dsbl +'>'+
								  '</div>'+
								'</div>'+
								'<div class="col-md-4">'+
								  '<div class="form-group">'+
									'<label>First Name</label>'+
									'<input type="text" id="first_name" class="form-control" value="'+ first_name +'" placeholder="Enter first name">'+
								  '</div>'+
								'</div>'+
								'<div class="col-md-4">'+
								  '<div class="form-group">'+
									'<label>Last Name</label>'+
									'<input type="text" id="last_name" class="form-control" value="'+ last_name +'" placeholder="Enter lasr name">'+
								  '</div>'+
								'</div>'+
							  '</div>'+
							  '<div class="row">'+
								'<div class="col-md-6">'+
								  '<div class="form-group">'+
									'<label>Email Id</label>'+
									'<input type="text" id="user_email" class="form-control" value="'+ user_email +'" placeholder="Enter email id">'+
								  '</div>'+
								'</div>'+
								'<div class="col-md-6">'+
								  '<div class="form-group">'+ passwordHtml +'</div>'+
								'</div>'+
							  '</div>'+
							  '<div class="row">'+
								  '<div class="col-md-4">'+
									  '<div class="form-group">'+
										'<label>Select Role</label>'+
										'<select id="user_role" class="form-control">'+
											'<option value="">-- Selecrt role --</option>'+
											'<option value="superadmin">Superadmin</option>'+
											'<option value="editor">Editor</option>'+
											'<option value="developer">Developer</option>'+
											'<option value="graphic_designer">Graphic Designer</option>'+
											'<option value="web_designer">Web designer</option>'+
										 '</select>'+
									  '</div>'+
								  '</div>'+
								  '<div class="col-md-4">'+
								    '<div class="form-group">'+
									  '<label>Status</label>'+
									  '<select id="is_active" class="is_active form-control">'+
										'<option value="1">Active</option>'+
										'<option value="0">Deactive</option>'+
									  '</select>'+
								    '</div>'+
								  '</div>'+
								  '<div class="col-md-4">'+
								    '<input type="hidden" id="user_id" value="'+ user_id +'">'+
								  '</div>'+
								'</div>'+
							'</div>'+
							'</form>';
			jQbox({
				title: title,
				onConfirmbtn: 'saveuser();',
				width: '55%',
				html: htmldata,
			});
			
			if(user_id != ''){
				$("#user_role option[value='"+user_role+"']").attr("selected", true);
				$("#is_active option[value='"+is_active+"']").attr("selected", true);
			}
		});
		
		
		var saveuser = (function (){
			nr_main_loader('show');
			var data = new FormData();
			data.append('user_id', $('.sav_admins #user_id').val());
			data.append('username', $('.sav_admins #username').val());
			data.append('password', $('.sav_admins #password').val());
			data.append('first_name', $('.sav_admins #first_name').val());
			data.append('last_name', $('.sav_admins #last_name').val());
			data.append('user_email', $('.sav_admins #user_email').val());
			data.append('user_role', $('.sav_admins #user_role').val());
			data.append('is_active', $('.sav_admins #is_active').val());
			
			
			jQuery.ajax({
				url: 'restapi/user_registration',
				type: 'POST',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				data: data,
				cache: false,
				success: function (response) {
					nr_main_loader('hide');
					if(response.status == 'ok'){
						Swal.fire({
						  type: 'success',
						  title: response.message,
						  showConfirmButton: false,
						  timer: 1500
						})
						setTimeout(function(){
							location.reload();
						},2000)
					}else{
						Swal.fire({
						  type: 'error',
						  title: response.message,
						})
					}
					return false;
				}
			});
			return false;
		});
	</script>
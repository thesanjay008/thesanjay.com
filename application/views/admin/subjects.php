    <section class="content-header">
      <h1><?php echo $page_title; ?> <a class="btn btn-sm btn-default" href="admin/subjects/add">Add New</a></h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title; ?></li>
      </ol>
    </section>
	<style>
	 .drd-action {text-align: center;}
	 .drd-action button{border-radius: 50%;}
	</style>
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>Subject Name</th>
                  <th>Standard</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody id="standardslist">
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>Subject Name</th>
                  <th>Standard</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	
	<script type="text/javascript">
		/* DataTable */
		$(function () {
			
			/*
				$('#example2').DataTable({
				  'paging'      : true,
				  'lengthChange': false,
				  'searching'   : false,
				  'ordering'    : true,
				  'info'        : true,
				  'autoWidth'   : false
				})
			*/
		})
		$(document).ready(function(e) {
			$('.subjects').addClass('active');
			$('.subjects_all').addClass('active');
			
			/* STANDARDS LIST */
			get_standardslist();
			
		});
		
		var get_standardslist = function (e) {
			var data = {
				visit_from : 'web',
			};
			$.ajax({
				url: "OAuth/subjectslist",
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
								if(value.is_active == 1){
									status = 'active';
								}
								vHtml+='<tr>'+
										  '<td class="drd-action">'+
												'<div class="btn-group">'+
												  '<div class="btn-group">'+
													'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
													  '<span class="caret"></span>'+
													'</button>'+
													'<ul class="dropdown-menu">'+
													  '<li><a href="javascript:void(0);">Update</a></li>'+
													  '<li><a href="javascript:void(0);">Delete</a></li>'+
													'</ul>'+
												  '</div>'+
												'</div>'+
										  '</td>'+
										  '<td>'+ value.subject_name +'</td>'+
										  '<td>'+ value.standard_name +'</td>'+
										  '<td>'+ status +'</td>'+
										  '<td>'+ moment(value.timestamp * 1000).format('MMM DD, YYYY'), +'</td>'+
										'</tr>';
							});
							$('#standardslist').html(vHtml);
							$('#example1').DataTable({
								  "columnDefs": [
									{ "width": "10%", "targets": 0 }
								  ]
								});
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
	<section class="content-header">
      <h1>Instalments List</h1>
      <ol class="breadcrumb">
        <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php if($feedback= $this->session->flashdata('feedback')): $feedback_class=$this->session->flashdata('feedback_class'); ?>
          <div class="col-md-6 col-lg-offset-3">
            <div class="alert alert-dismissible <?= $feedback_class; ?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?= $feedback; ?>
            </div>
          </div>
          <?php endif ?>
        </div>
        <div class="col-md-12">
          <div class="box box-primary">
          <div class="box-body no-padding">
            <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody>
                <tr>
                  <td class="select-tab"><a class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></a></td>
                  <td class="tab"><b>Member Name</b></td>
                  <td class="tab"><b>Instalment Price</b></td>
                  <td class="tab"><b>Status</b></td>
                  <td class="tab"><b class="pull-right">Action</b></td>
                </tr>
                <?php foreach($results as $data){ ?>
                <tr>  
                  <td class="select-tab"><a class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></a></td>
                  <td><a href="javascript:void(0);"><b><?php echo $data['fname']." ".$data['lname']; ?></b></a></td>
                  <td><?php echo $data['instalment_price']; ?></td>
				  <?php
				  $class="warning";
				  $status="Pending";
				  if($data['status'] == 1){ 
					$class="success";
					$status="success";
				  }
				  ?>
                  <td><span class="label label-<?php echo $class; ?>"><?php echo $status; ?></span></td>
                  <td>
                    <span class="pull-right">
					<?php if($data['status'] == 1){ ?>
					<a href="javascript:void(0)" class="btn btn-default btn-sm label-success" disabled><i class="fa fa-ban"></i></a>
					<?php }else{ ?>
					<a data-toggle="tooltip" title="Complete Instalment"  href="javascript:void(0)" onClick="update_instalment(<?php echo $data['instalment_id']; ?>);" class="btn btn-default btn-sm label-danger"><i class="fa fa-check"></i></a>
					<?php } ?>
                    
					</span>
                  </td>
                </tr>
				<?php } ?>
              </tbody>
            </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
    <!-- //Main content over-->
	
	<script src="support/admin/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(e) {
		$('.finance_list').addClass('active');
		$('.finance_<?php echo$finance_type; ?>').addClass('active');
	});
	
	var update_instalment = function (instalment_id) {
		if (confirm("Click OK to continue")){
			var data = {
				instalment_id : instalment_id,
			};
			
			$.ajax({
				url: "secrets/update_instalment",
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
							onClose: function () {
								location.reload('true');
							}
						});
						location.reload('true');
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
		}
	};
	</script>